/**
 * Created by jmd-m on 3/30/2016.
 */

var $ = require('jquery');
//import * as SomeTest from 'Somewhere';

var TestObject = function() {
    //this.SomeTest = new SomeTest.SomeTest();
};

$(function() {
    var tests = new TestObject();
    for (var test in tests) {
        tests[test].run();
    }
});


