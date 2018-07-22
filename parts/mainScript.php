$(function() {
  var id = guid();
  init_anketa(id, partner, pipeline);
  $("[stepindex]:not([stepindex=" + stepIndex + "])").hide();
  $("[def]").hide();
});
