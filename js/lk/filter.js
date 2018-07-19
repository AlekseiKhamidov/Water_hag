var $table = $("#table");
function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
}


function loadCheckbox(json) {
  for (var idata in json.data) {
    console.log(idata);
    createCheckbox(idata);
    var mas = json.data[idata];
    loadChips(idata, mas);

  }
}

function loadChips(name, chips) {
  var id = guid();
  var group = '<div id="' + id + '" name="' + name + '" ></div';
  var header = '<h5 style="    font-weight: bold;">' + name + '</h5>'

  $("#chip-group").append(group);
  $("#" + id).append(header);

  for (var i = 0; i < chips.length; i++) {
    loadChip(chips[i], id);
  }
  //при первой загрузке скрываем все чипсы
  $("#" + id).hide();
}

function loadChip(chip, idGroup) {
  chip = parseChip(chip);
  if (chip) {
    var id = guid();
    var div = '<div id="' + id + '" class="chip chipButton" pipeline="' + chip.pipeline + '" onclick="clickChip(this)" isClicked=true color="' + chip.color + '">' + chip.val + '</div>';
    $('#' + idGroup).append(div);
    setColor($("#" + id), chip.color);
  }

}

function parseChip(text) {
  var mas = text.split('^');
  if (mas.length > 1) {
    var obj = {
      pipeline: mas[0],
      val: mas[1],
      color: mas[2]
    };
    return obj
  }
  return null;
}

function setColor(chip, color) {
  chip.css("background-color", color);
}

function createCheckbox(name) {
  var id = guid();
  var checkbox = '<div class="inline">' +
    '<label class="form-switch">' +
    '  <input type="checkbox" name="' + id + '" id="' + id + '" chips="' + name + '"  onclick="clickCheckbox(this)" >' +
    '  <i></i>' + name + '</label>' +
    '</div> ';
  $("#check-group").append(checkbox);
}

function clickCheckbox(current) {
  var name = $(current).attr("chips");
  if (current.checked) {
    $("[name='" + name + "']").show();
  } else {
    $("[name='" + name + "']").hide();
  }
  var statusList = checkStatus();
  var values = [{
    name: "status",
    values: statusList
  }];
  filterBy($("#table"), values);
  totalSum();
   // $("#table").bootstrapTable('resetView', {
   //              height: getHeight(heightBody)
   //          });
}

function clickChip(chip) {
  var isClicked = !$.parseJSON($(chip).attr("isClicked")); //при нажатии меняем на акутальное состояние
  $(chip).attr("isClicked", isClicked);
  //стало неактивным
  if (!isClicked) {
    $(chip).css("background-color", "#f1f1f1");
    $(chip).css("color", "#999999");

  } else { //если активно, то фильтруем таблицу
    var color = $(chip).attr("color");
    $(chip).css("background-color", color);
    $(chip).css("color", "");
    //Фильтрация!
  }

  var statusList = checkStatus();
  var values = [{
    name: "status",
    values: statusList
  }];
  filterBy($("#table"), values);
  totalSum();
}

function checkStatus() {
  var statusList = [];
  var chips = $("#chip-group").find("[isClicked='true']:visible");
  for (var i = 0; i < chips.length; i++) {
    var pipeline = $(chips[i]).attr("pipeline");
    var color = $(chips[i]).attr("color");
    var val = $(chips[i]).text();
    statusList[i] = pipeline + '^' + val + '^' + color;
  }
  if (statusList.length == 0 && checkPipeline().length > 0) {
    statusList[0] = "";
  }
  return statusList;
}

function checkPipeline() {
  var checked = $("#check-group :checked");
  var pipelineList = [];
  for (var i = 0; i < checked.length; i++) {
    pipelineList[i] = $(checked[i]).attr("chips");
  };
  return pipelineList;
}

function filterBy($table, values) {
  var params = {};
  for (var i = 0; i < values.length; i++) {
    if (values[i].values.length > 0) {
      params[values[i].name] = values[i].values;
    }
  }
  $table.bootstrapTable('filterBy', params);
}
function getHeightState(heightBody) {
  if (!heightBody){
    heightBody = document.body.clientHeight;
  }
  return heightBody- $("#panelFilter").outerHeight(true) - $("#menu").outerHeight(true)-50;
  //return 500;
}
function getHeight(heightBody) {
  if (!heightBody){
    heightBody = $(window).height();
  }
  return heightBody- $("#panelFilter").outerHeight(true) - $("#menu").outerHeight(true)-20;
  //return 500;
}
function clearFilter(){
  clearDatePicker();
  clearCheckBox();
  clearChip();
  $table.bootstrapTable('resetView', {
                height: getHeight()
            });
}
function clearDatePicker(){
  $('.input-daterange input').each(function (){
      $(this).datepicker("clearDates");
  });
}
function clearCheckBox(){
  var checked = $("#check-group :checked");
    var pipelineList = [];
    for (var i = 0; i < checked.length; i++) {
      $(checked[i]).prop('checked', false);
      name = $(checked[i]).attr("chips");
       $("[name='" + name + "']").hide();
    };
    
}
function clearChip(){
  var chips = $("#chip-group").find("[isClicked='false']:hidden");
  for (var i = 0; i < chips.length; i++) {
      var chip = chips[i];
    $(chip).attr("isClicked", "true");
  
    var color = $(chip).attr("color");
    $(chip).css("background-color", color);
    $(chip).css("color", "");
    }
}
