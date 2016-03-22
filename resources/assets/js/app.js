/** Created by John on 3/5/2016. */

global.jQuery = require('jquery');
var $ = require('jquery');
var bootstrap = require('bootstrap');
var moment = require('moment');
var datepicker = require('bootstrap-datepicker');
var typeahead = require('typeahead.js-browserify');
var Bloodhound = require('typeahead.js-browserify').Bloodhound;

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
        var content = $('#jsonTest-input-get').val();
        $.ajax({
            type: 'GET',
            url: '/search/suffix/' + content,
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
$('.edit').hover(function() {
    $(this).find('img').fadeTo(500, 0.5);
}, function() {
    $(this).find('img').fadeTo(500, 1);
});

//Kevin Wayne
$('div.alert-success').delay(4000).slideUp();
