var stepIndex=0;
var stepSuccess = 11;
var stepAgeError = 13;
var stepAccessError =12;
var stepAccess = 10;
var stepAge = 0;
var stepError = 14;
var maxSize = 8000000;
var stepDoc = 9;
$(function() {
  var id = guid();
  init_anketa(id, partner, pipeline, group);
  $("[stepindex]:not([stepindex=" + stepIndex + "])").hide();
  $("[def]").hide();
});
