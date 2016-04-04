/** Created by John on 3/5/2016. */
/*jshint esversion: 6 */

global.jQuery = require('jquery');
var $ = require('jquery');
var bootstrap = require('bootstrap');
var moment = require('moment');
var datepicker = require('bootstrap-datepicker');
var typeahead = require('typeahead.js-browserify');
var Bloodhound = require('typeahead.js-browserify').Bloodhound;
var suggest = require('./suggest.js');

$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#search').suggest({
        identifier: 'blah',
        default: [
            {'title': 'Gravity',
             'thumb': 'http://i.imgur.com/fbm4rs0.png'},
            {'title': 'Frozen',
             'thumb': 'http://i.imgur.com/lmase6g.jpg'},
            {'title': 'Taxi Driver', 
             'thumb': 'http://i.imgur.com/5xxudih.png'},
        ],
        searchKey: 'title',
        minLength: 1,
        prefetchUrl: '/search/mock',
        remoteUrl: '/search/mock/WILDCARD',
        remoteWildcard: 'WILDCARD',
        rateLimit: 0,
    });


    typeahead.loadjQueryPlugin();

    $('#AdvSearch__datepicker_from').datepicker({});
    $('#AdvSearch__datepicker_to').datepicker({});

    $('#AdvSearch__datepicker_from2').datepicker({});
    $('#AdvSearch__datepicker_to2').datepicker({});

    $('#jsonTest-submit-post').on('click', function() {
        var content = $('#jsonTest-input-post').val();
        $.ajax({
           type: 'POST',
            url: '/search/suffix',
            data: { 'term': content },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                console.log('failure: ', xhr);
            }
        });
    });

    $('#jsonTest-submit-get').on('click', function() {
        var query = $('#jsonTest-input-get').val();
        $.ajax({
            type: 'GET',
            url: '/search/suffix/' + query,
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                console.log('failure: ', xhr);
            }
        });
    });

    var engine = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/search/suffix/%QUERY',
            wildcard: '%QUERY'
        }
    });

    engine.initialize();

    $('.typeahead').typeahead({
        highlight: false,
    }, {
        name: 'typeahead',
        displayKey: 'title',
        source: engine.ttAdapter(),
    });
});


//Kevin Wayne
$('#Userpage__avatar__edit').hover(function() {
    $(this).find('img').fadeTo(500, 0.5);
}, function() {
    $(this).find('img').fadeTo(500, 1);
});

//Kevin Wayne
$('div.Userpage__messages').delay(4000).slideUp();

$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var listTitle = $(e.relatedTarget).data('title');
        $('#listModal').text(listTitle);
        var listId = $(e.relatedTarget).data('id');
        document.getElementById('list_id').value = listId;
    });
});
