/**
 * Created by jmd-m on 3/30/2016.
 */

/*jshint esversion: 6 */


(function ( $ ) {

    $.fn.suggest = function( options ) {

        var settings = $.extend({

            /**
             * Uniquely identifies this instance of suggest.
             * Creates id attributes on the suggest-created divs
             * using this identifier.
             * @optional No unique id attributes will be created.
             * @type {string}
             */
            identifier: '',

            /**
             * Key used to test whether a particular object in
             * the suggestion set is a valid suggestion.
             * @type {String}
             */
            searchKey: '',

            /**
             * Default data set for suggestions.
             * @optional Should be defined unless prefetch is defined.
             * @type {Array}
             */
            default: [],

            /**
             * Specifies where to asynchronously pull the initial
             * data set from.
             * @optional Defaults to the default data set.
             * @type {string}
             */
            prefetchUrl: '',

            /**
             * Specifies where to asynchronously pull any uncached
             * requests from.
             * Note: A remoteWildcard must be defined with a remoteUrl.
             * @optional All suggestions are based on the default 
             * or prefetched data sets when not defined.
             * @type {string}
             */
            remoteUrl: '',

            /**
             * Specifies how to fit an input query into a remoteUrl.
             * E.g. if remoteUrl is defined as:
             *     'foo.com/bar/QUERY'
             * with the wildcard: 'QUERY', and the user typed 'hello'
             * into the input field, then the remoteUrl would be
             * translated to:
             *     'foo.com/bar/hello'
             * @optional Only used if remoteUrl is defined.
             * @type {String}
             */
            remoteWildcard: '',

            /**
             * HTML template for displaying an individual suggestion. 
             * @optional The default template displays the first property in the 
             * suggestion inside of a paragraph tag.
             * @param  {Object} suggestion Item to pull display information from.
             * @return {string}            HTML string that renders the suggestion.
             */
            template: function(suggestion) {
                for (let first in suggestion)
                    return `<p>${suggestion[first]}</p>`;
            },

            /**
             * Minimum length of a query required to display suggestions.
             * @optional Defaults to 1.
             * @type {Number}
             */
            minLength: 1,

            /**
             * Maximum number of suggestions that can be displayed.
             * @optional Defaults to 7.
             * @type {Number}
             */
            maxSuggestions: 7,

            /**
             * The minimum time (ms) between remote requests.
             * @optional Defaults to 0 ms.
             * @type {Number}
             */
            remoteRateLimit: 0,

        }, options);

        /** 
         * ---------------------------------------------------
         * Set up initial parameters by rendering the frame, 
         * setting the query to null, setting up the data set, 
         * and gathering prefetch data if it is defined.
         * ---------------------------------------------------
         */

        /** @type {Object.<Object.<jQuery>>} Holds DOM node references as jQuery objects */
        var frame = render(this, settings.identifier);

        /** @type {string} Query coming from user input */
        var query = '';

        /** @type {Object} Data set */
        var data = settings.default;

        /** @type {Boolean} Whether a remote request can be sent */
        var remoteReady = true;

        if (settings.prefetchUrl) 
            remoteFetch(settings.prefetchUrl, false);

        /** 
         * -----------------------------------------------------------
         * Define event handlers for interaction with the input field.
         * -----------------------------------------------------------
         */

        /**
         * @event When input frame gains focus, if a query exists,
         * display suggestions.
         */
        frame.input.on('focusin', function() {
            if (query)
                frame.wrapper.addClass('open');
        });

        /**
         * @event When input frame loses focus, if the user is not
         * hovering over the suggestions, close the suggestions.
         */
        frame.input.on('focusout', function() {
            // jQuery's .is(':hover') is unreliable.
            if ($(frame.contentWrapper.selector+':hover').length === 0)
                frame.wrapper.removeClass('open');
        });

        /**
         * @event When the user moves the mouse out of the 
         * suggestions area, if the input frame does not have 
         * focus, close the suggestions.
         */
        frame.contentWrapper.on('mouseleave', function() {
            if (!frame.input.is(':focus'))
                frame.wrapper.removeClass('open');
        });

        /**
         * @event Reveals suggestions for the given user input based
         * on the parameters specified in settings. Can also close
         * the suggestions if the query does not meet the minimum
         * length requirement.
         */
        frame.input.on('keyup', function() {
            var queryDelta = $(this).val().trim();
            if (queryDelta.localeCompare(query)) {
                query = queryDelta;

                if (query.length >= settings.minLength) {
                    var numSuggestions = repopSuggestions();
                    if (numSuggestions < settings.maxSuggestions) {
                        var url = replaceWildcard(settings.remoteUrl, settings.remoteWildcard, query);
                        remoteFetch(url, true);
                    }
                } else frame.wrapper.removeClass('open');
            }            
        });

        function repopSuggestions() {
            frame.content.empty();
            frame.wrapper.addClass('open');

            var tokens = tokenize(query);
            var regexp = tokenSearchRegExp(tokens);
            var hits = filter(data, settings.searchKey, regexp);

            if (hits.length > 0) {
                var i = 1;
                for (let hit of hits) {
                    frame.content.append(settings.template.call(this, data[hit]));
                    i++;
                    if (i > settings.maxSuggestions) break;
                }
            } else frame.content.append('No results found');

            return hits.length;
        }

        function remoteFetch(url, repop) {
            if (remoteReady) {
                remoteReady = false;
                setTimeout(() => { remoteReady = true; }, settings.remoteRateLimit);

                ajax({
                    type: 'GET', url: url
                }).then(
                    (result) => {
                        data = union(data, result);
                        if (repop && query)
                            repopSuggestions();
                    },
                    (xhr) => { console.error(`Suggest Remote Error: GET ${url} ${xhr.status} ${xhr.statusText}`); }
                ).catch(
                    (error) => { console.error(error); }
                );
            }
        }

        return this;
    };

    /**
     * Finds the indexes where the key of the data element fits the 
     * given regular expression.
     * @param  {Array.<Object>} data   Contains elements to be filtered.
     * @param  {string}         key    Element key to be tested.
     * @param  {RegExp}         regexp Regular expression for testing keys.
     * @return {Array.<number>}        Indexes of data elements.
     */
    var filter = function(data, key, regexp) {
        var indexes = [];
        $.map(data, (item) => {
            if(regexp.test(item[key]))
                indexes.push(data.indexOf(item));
        });
        return indexes;
    };

    /**
     * Takes the set union of two arrays, meaning the
     * arrays are merged with any duplicates removed.
     * @param  {Array} a1 
     * @param  {Array} a2 
     * @return {Array}    The union of a1 and a2.
     */
    function union(a1, a2) {
        var merge = a1.concat(a2);
        var union = [];
        var hash = {};
        merge.forEach((item) => {
            var serialized = JSON.stringify(item);
            if (!hash[serialized]) {
                hash[serialized] = true;
                union.push(item);
            }
        });
        return union;
    } 

    /**
     * Builds a regular expression that matches all of the given tokens
     * regardless of order. For example, given the tokens:
     *     ['foo', 'bar baz', 'qux']
     * The following would test true:
     *     'zzzbar bazzfoozzx quxzz'
     * @param  {Array.<string>} tokens Keywords for searching.
     * @return {RegExp}                Regular expression for searching.
     */
    var tokenSearchRegExp = function(tokens) {
        /** maps: 'TOKEN' to '(?=.*?\bTOKEN.*?\b)' */
        tokens = $.map(tokens, (token) => {
            return '(?=.*?\\b.*?' + token + '.*?\\b)';
        });
        /**
         * joins mapping to make:
         * /^(?=.*?\bTOKEN_1.*?\b)(?=.*?\bTOKEN_2.*?\b)...(?=.*?\bTOKEN_n.*?\b).*?/i
         */
        return new RegExp('^' + tokens.join('') + '.*$', 'i');
    };

    /**
     * Tokenizes the given string by splitting on white space, 
     * but also respecting quotations. For instance, given:
     *     'foo "bar baz" qux'
     * The string would be tokenized as follows:
     *     ['foo', 'bar baz', 'qux']
     * @param  {[type]} str [description]
     * @return {[type]}     [description]
     */
    var tokenize = function(str) {
        return $.map(str.match(/"(.*?)"|[^ ]+/g), (term) => {
            term = term.replace(/(["])/g, '');
            return term;
        });
    };

    /**
     * Returns the promise of executing an jQuery ajax
     * call with the given options.
     * @param  {Object} options The ajax options.
     * @return {Promise}        
     */
    var ajax = function(options) {
        return new Promise(function (resolve, reject) {
            $.ajax(options).done(resolve).fail(reject);
        });
    };

    /**
     * Replaces the given wildcard in string with the replacement.
     * @param  {string} string      String to operate on.
     * @param  {string} wildcard    Where to replace.
     * @param  {string} replacement What to replace with.
     * @return {string}             New string with replacement.
     */
    var replaceWildcard = function(string, wildcard, replacement) {
        var regexp = new RegExp(wildcard, 'g');
        return string.replace(regexp, replacement);
    };

    /**
     * Renders a suggestion frame with the following dom structure around
     * the given input class:
     * ...
     *   <div class="dropdown Suggest__wrapper" 
     *        id=id+"__wrapper">
     *     <input class="Suggest__input">
     *     <div class="dropdown-menu Suggest__content-wrapper" 
     *          id=id+"__content-wrapper">
     *       <div class="Suggest__content" 
     *            id=id+"__content">
     *       </div>
     *     </div>
     *   </div>
     * ...
     * Note: If id is null then the id attributes are not rendered.
     * @param  {Node}   input Input field with type text.
     * @param  {string} id    The custom identifier for the id attributes.
     * @return {Object}       Contains uid of frame and node references.
     */
    var render = function(input, id) {
        /** Turn off browser-based autocompelete functionality. */
        $(input).attr('autocomplete', 'off');

        $(input).wrap($('<div>', {class: 'dropdown Suggest__wrapper'}));
        $(input).addClass('Suggest__input');

        var wrapper = $(input).parent();
        var contentWrapper = $('<div>', {class: 'dropdown-menu Suggest__content-wrapper'});
        var content = $('<div>', {class: 'Suggest__content'});

        if (id) {
            wrapper.attr('id', id+'__wrapper');
            contentWrapper.attr('id', id+'__content-wrapper');
            content.attr('id', id+'__content');
        }

        $(contentWrapper).append(content);
        $(wrapper).append(contentWrapper);

        return {
            /** @type {Object.<jQuery>} Containing div of the frame. */
            wrapper: wrapper, 

            /** @type {Object.<jQuery>} Containing div of the content div. */
            contentWrapper: wrapper.find('.Suggest__content-wrapper'), 

            /** @type {Object.<jQuery>} Div where content should live. */
            content: wrapper.find('.Suggest__content'),

            /** @type {Object.<jQuery>} Input field. */
            input: wrapper.find('.Suggest__input'),
        };
    };

}( jQuery ));

