/** Created by John on 3/5/2016. */

global.jQuery = require('jquery');
var $ = require('jquery');
var bootstrap = require('bootstrap');
var moment = require('moment');
var datepicker = require('bootstrap-datepicker');
var typeahead = require('typeahead.js');

$(function () {
    $('#AdvSearch__datepicker_from').datepicker({});
    $('#AdvSearch__datepicker_to').datepicker({});

    $('#AdvSearch__datepicker_from2').datepicker({});
    $('#AdvSearch__datepicker_to2').datepicker({});

    $('.typeahead').typeahead({
        highlight: true,
        minLength: 1
    }, {
        name: 'states',
        source: substringMatcher(states)
    });
});

var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substrRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

//Kevin Wayne
$('.edit').hover(function() {
    $(this).find('img').fadeTo(500, 0.5);
}, function() {
    $(this).find('img').fadeTo(500, 1);
});

//Kevin Wayne
$('div.alert-success').delay(4000).slideUp();
