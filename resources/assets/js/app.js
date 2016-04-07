/** Created by John on 3/5/2016. */
/*jshint esversion: 6 */

global.jQuery = require('jquery');
var $ = require('jquery');
var bootstrap = require('bootstrap');
var moment = require('moment');
var datepicker = require('bootstrap-datepicker');
var suggest = require('./suggest.js');

$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#MenubarSearch__input').suggest({
        searchKey: 'title',
        identifier: 'MenubarSearch',
        template: function(suggestion) {
            return `<div class="MenubarSearch__suggestion">
                        <img src="${suggestion.imgpath}/thumbs/${suggestion.imgname}.${suggestion.imgext}">
                        <a href="#">${suggestion.title}</a>
                    </div>`;
        },
        remoteUrl: '/search/suffix/WILDCARD',
        remoteWildcard: 'WILDCARD',
        maxSuggestions: 6,
    });

    $('#AdvSearch__datepicker_from').datepicker({});
    $('#AdvSearch__datepicker_to').datepicker({});

    $('#AdvSearch__datepicker_from2').datepicker({});
    $('#AdvSearch__datepicker_to2').datepicker({});

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
