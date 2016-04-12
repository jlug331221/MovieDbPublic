/** Created by John on 3/5/2016. */
/*jshint esversion: 6 */

global.jQuery = require('jquery');
var $ = require('jquery');
var bootstrap = require('bootstrap');
var moment = require('moment');
var datepicker = require('bootstrap-datepicker');
var lightbox = require('lightbox2');
var suggest = require('./suggest.js');
var albumloader = require('./albumloader.js');


$(function () {

    // Set up jQuery ajax headers to allow POSTing ajax data using csrf tokens.
    // This is a global setting and only needs to be applied once.
    // Note that the page must have a meta tag including a generated csrf token.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Set up the menu bar search suggestions.
    $('#MenubarSearch__input').suggest({
        searchKey: 'name',
        identifier: 'MenubarSearch',
        template: function(suggestion) {
            var path;

            if (suggestion.type === 'm') {
                return `<div class="MenubarSearch__suggestion">
                            <a href="/movies/${suggestion.id}">
                                <img src="${suggestion.img}">
                                ${suggestion.name}
                            </a>
                            <p>(${suggestion.year})</p>
                        </div>`;
            } else {
                var html = `<div class="MenubarSearch__suggestion">
                                <a href="/people/${suggestion.id}">
                                    <img src="${suggestion.img}">
                                    ${suggestion.name}
                                </a>`;
                if (suggestion.yob)
                    html += `<p>Born ${suggestion.yob}</p>`;
                if (suggestion.yod)
                    html += `<p>Died ${suggestion.yod}</p>`;
                html += `</div>`;
                return html;
            }

        },
        remoteUrl: '/search/json/WILDCARD',
        remoteWildcard: 'WILDCARD',
        maxSuggestions: 6,
    });

    // Set up the datepickers for the advanced search pages.
    $('#AdvSearch__datepicker_from').datepicker({});
    $('#AdvSearch__datepicker_to').datepicker({});
    $('#AdvSearch__datepicker_from2').datepicker({});
    $('#AdvSearch__datepicker_to2').datepicker({});

    // Set up bootstrap tooltips. This is opt-in and must be enabled here explicitely.
    $('[data-toggle="tooltip"]').tooltip();

    // Set up album image loading.
    if($('.Album').length) {
        $('.Album').albumloader({
            url: '/album/json/' + $('.Album').data('id'),
            imagesPerLoad: 24,
        });
    }

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
