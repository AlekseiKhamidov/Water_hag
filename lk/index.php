<?php
  require_once "check.php";
  require_once "../config.php";
  require_once "../mysql.php";
  if (checkLogin() == -1) {
    header("Location: login.php"); exit();
  };
  $userdata = getUserdata(intval($_COOKIE['id']));
?>
<html>
 <head>
    <title>
        Личный кабинет
    </title>
       <link rel="stylesheet" href="../css/bootstrap.min.css">
       <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../css/compiled.min.css" rel="stylesheet">
    <!-- <link href="../css/materialize.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="lib/bootstrap-table-master/src/bootstrap-table.css">
          <link rel="stylesheet" href="css/table.css" />
        <link rel="stylesheet" href="lib/bootstrap-table-master/src/extensions/sticky-header/bootstrap-table-sticky-header.css">
    <style type="text/css">
    .btn{
          padding: .375rem .75rem;
    }
    table td {
    font-size: .8rem;
  }
    .btn-checkbox {
  background: #f1f1f1 ;

color:#999999;
   }
  .btn-checkbox:hover, .btn-checkbox:focus, .btn-checkbox:active {
   /* background-color: #c0c2c5 !important; */
  }
  .btn-checkbox.active {
color:#676767;    }
      .switch.round label .lever {
    width: 54px;
    height: 34px;
    border-radius: 10em;
}

.switch.round label .lever:after {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    left: 4px;
    top: 4px;
}
/*.switch.blue-white-switch label .lever  {
    background-color: #ccc;
}*/
.switch.blue-white-switch label input[type=checkbox]:checked + .lever {
    background-color: #2196f3;
}
.switch.blue-white-switch label input[type=checkbox]:checked + .lever:after{
/*.switch.blue-white-switch label .lever:after {*/
    background-color: #fff;
}
#legendDiv ul {
            text-align: center;
            margin-top: 2rem;
        }
        #legendDiv ul li {
           display:inline-block;
           margin-right: 10px;
        }
        #legendDiv ul li span {
            padding: 5px 10px;
            color: #fff;
        }
        .d-flex {
    display:flex;
}
.dropdown-item>input[type=checkbox]{
  visibility:visible;
      position: relative;
    left: auto;
}
.dateType{
  width: 110px;
text-align: center;
border: 1px solid #ced4da;
border-radius: .25rem;
}
.input-group-append{
  margin-right: -1;
}
.input-group-text{
  border-radius: 0px;
}
#start{
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
}
#end{
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
}
#chartDiv{
  height: 50vh;
  width: 90vw;
}
    </style>

</head>
 <body>
   <?php require_once '../parts/preloader.php'	?>
  <header>

    <nav id="menu" class="navbar fixed-top navbar-expand-lg navbar-dark black scrolling-navbar">
        <a class="navbar-brand" href="https://vk.com/aleksei_khamidov"><strong>AMOBIRD</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                 <li class="nav-item ">
                    <a class="nav-link" href="logout.php" id="navbarDropdownMenuLink" >
                       <?php echo "{$userdata['user_login']}"; if ($userdata[ 'partner_name']) { echo " ({$userdata['partner_name']})"; } ?> (Выйти)
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</header>
<main>
  <div class="container-fluid">


<div  class=" mt-5 ml-4 mr-4 pt-4">
  <div class="row justify-content-between" >
    <div class="col">

    </div>

    </div>

    <div id="toolbar">
   <button class="btn btn-primary " data-toggle="modal" onclick="analyze()" data-target="#chartModal"><i class="fa fa-bar-chart"></i> Диаграммы</button>
   <div class="btn-group">
     <input type="text" id="start" required name="start" class="dateType validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
     <div class="input-group-append">
       <span class="input-group-text" id="basic-addon2">по</span>
     </div>
     <input type="text" id="end" name="end"  class="dateType validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
   </div>


  </div>


     <table id="table" class="exampleTable table table-hover table-striped"
      data-toolbar="#toolbar"
      data-show-export="true"
      data-show-columns="true"
      data-filter-control="true"
      data-check-on-init="true"
      data-export-types="['excel']">
        <thead>
          <tr>
            <?php if ($userdata['user_login'] == 'admin') echo '
            <th data-field="source" class="managerCell excel-filter" data-sortable="true" data-formatter="textFormat" data-search-formatter="textFormat" >Источник</th>
            ' ?>
            <th data-field="contact_name" class="fio" data-filter-control="input">ФИО клиента</th>
            <th data-field="contact_phone" class="contact" data-formatter="textFormat" data-filter-control="input">Телефон</th>
            <th data-field="created_at" class="dateTo" data-sortable="true" data-sorter="dateSorter" data-formatter="dateFormat">Дата создания</th>
             <?php if ($userdata['user_login'] != 'admin') echo '
             <th data-field="manager" class="managerCell excel-filter" data-sortable="true" >Менеджер '.$userdata['user_login'].'</th>
             <th data-field="chief" class="managerCell excel-filter" data-formatter="textFormat" data-search-formatter="textFormat"  data-sortable="true" >РОП</th>
             ' ?>
            <th data-field="price" class="sumCell" data-align="right" data-sortable="true" data-formatter="priceFormatter">Сумма</th>
            <th data-field="status" class="typeCell excel-filter" data-align="center" data-sortable="true" data-formatter="roundButtonFormatter" data-search-formatter="statusFormatterSelect">Этап воронки</th>
            <th data-field="note_text" >Примечание</th>
          </tr>
        </thead>
      </table>
        <div id="ulContainer"></div>
</div>

</div>
</main>


<!-- Modal -->
<div class="modal fade" id="chartModal" tabindex="-1" role="dialog" aria-labelledby="chartModalLabel"  aria-hidden="true">
    <!-- <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document"> -->
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
          <p class="heading lead">Диаграмма</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row d-flex justify-content-center align-items-center"  >
                  <div id="chartDiv" >
                    <canvas id="comboChart" width="100%" height="100%"></canvas>
                </div>
              </div>
            </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script src="lib/bootstrap-table-master/src/bootstrap-table.js"></script>
<script src="lib/bootstrap-table-master/src/extensions/filter-control/bootstrap-table-filter-control.js"></script>
<script src="lib/bootstrap-table-master/src/locale/bootstrap-table-ru-RU.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
<script type="text/javascript" src="js/util-table.js"></script>
<script type="text/javascript" src="lib/bootstrap-table-master/src/extensions/export/bootstrap-table-export.js"></script>
<script type="text/javascript" src="js/tableExport.js"></script>
<script type="text/javascript" src="lib/bootstrap-table-master/src/extensions/sticky-header/bootstrap-table-sticky-header.js"></script>
<script src="js/spin.min.js"></script>
<script src="js/extensions.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput.min.js"></script>
<script src="js/multiselect.js"></script>
<script src="js/jquery.color.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    //$('.mdb-select').material_select();
    $(".datepickerMask").mask("99.99.9999", {placeholder: "ДД.ММ.ГГГГ" });
  });
</script>
<script>
  var Data;
  var filterContainer = "#ulContainer";
  var $table = $("table");
  var managers = {};
  var stages = {};
  var DataStatus={};
  function getStatuses() {
    $.ajax({
        url: "getStatuses.php",
        success: function(data) {
          var $div = $("#statuses");
            var pipelines = JSON.parse(data);
            initTable($("#table"));
        }
    })
};
function clearFilter(){
     $table.bootstrapTable('filterBy', {});
      $(filterContainer).find(".select_all").each(function(){
          $(this).prop("checked","")
        $(this).click()
      })
}
 var Data;
 function initTable($table) {
  var stickyHeaderOffsetY=0;
     if ( $('.navbar.fixed-top').css('height') ) {
              stickyHeaderOffsetY = +$('.navbar.fixed-top').css('height').replace('px','');
          }
      if ( $('.navbar.fixed-top').css('margin-bottom') ) {
        //  stickyHeaderOffsetY += +$('.navbar.fixed-top').css('margin-bottom').replace('px','');
      }
     var from = getTimePHP(start);
     var to = getTimePHP(end);
     $table.bootstrapTable({
         url: "../getData.php",
         queryParams:function(p){
          return {start:from, end:to}
        },
         height: setHeight(),
         exportOptions: {
                onCellHtmlData: function (cell, rowIndex, colIndex, htmlData) {
                  if (cell.hasClass("sumCell")){
                    return htmlData.replace('&nbsp;', '')
                  }
                 return (htmlData.startsWith('<div') ? $(htmlData).html() : htmlData);

                }
            },
     });
     var result = 0;
     $(window).resize(function() {
         resize();
     })
    // $("#textPeriod").text("Итого: " + result.toLocaleString() + " руб");
     $table.on('load-success.bs.table', function(data) {
       $table.bootstrapTable('filterBy', {})
         Data = $table.bootstrapTable('getData');
        tableFilter(Data);
        $("#mdb-preloader").hide();

        var btnClearFilter = '<button class="btn btn-secondary" title="Очистить фильтр"  onclick="clearFilter()" >'
    //    +'<span class="fa-stack">'
        +'<i class="fa fa-filter fa-2x"></i>'
        +'<i class="fa fa-ban"></i>'
        //+'</span>'
        +'</button>';
        $(".columns").prepend(btnClearFilter);
    //     analyze(DataStatus.status);
      //   filterTable(start, end);
          totalSum();
         //  alert('o');
     });



     // $table.on('refresh.bs.table', function(e, arg1, arg2) {
     //     clearFilter();
     // });

     $('.mdb-select').material_select();
 };
 // function loadDate(){
 //   initTable($("#table"), getColumns());
 // };

function isModalShow(){
  return ($("#chartModal").data('bs.modal') || {})._isShown ? true : false
}
function analyze(){
  var data = $("#table").bootstrapTable('getData');
  //var statuses = statuses.status;
  var colors = [];
  var dataCount = [];
  var dataSum = [];
  var labels = [];
  var statuses = [];

  $("#filter-status [type='checkbox']:checked:not(.select_all)").each(function(){
    statuses.push(this.value);
  })
  for (var i=0;i<statuses.length;i++){
    var count =0;
    var sum = 0;
    for (var j=0;j<data.length;j++){
      var status = data[j].status;
      if (status == statuses[i]){
        sum += parseInt(data[j].price);
        count++;
      }
    }
   colors.push(parseStatus(statuses[i]).color);
    labels.push(statusFormatterSelect(statuses[i]));

      dataSum.push(parseInt(sum)/1000000);
  //    dataSum.push(sum);
      dataCount.push(count);
  }
  console.log(dataCount);
  console.log(dataSum);
  var backgroundColors =[];
   colors.forEach(function(color){
    backgroundColors.push(jQuery.Color(color).transition("transparent", 0.5).toRgbaString())
    //color.alpha(0.5).rgbString()
  });

  var datasets = [{
    label: "Сумма заявок",
    data: dataSum,
    backgroundColor:backgroundColors,
    borderColor : colors,
    borderWidth: 2,
    yAxisID: 'y-axis-1'
  },{
    label: "Количество заявок",
    data: dataCount,
    type: 'line',
    borderColor: 'red',
    fill: false,
    yAxisID: 'y-axis-2'
  }]
  chartBar(document.getElementById("comboChart"),labels, datasets, colors);
};
// Chart.pluginService.register({
//     afterDraw: function(chartInstance) {
//         var ctx = chartInstance.chart.ctx;
//
//         // render the value of the chart above the bar
//         ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
//         ctx.textAlign = 'center';
//         ctx.textBaseline = 'bottom';
//         ctx.fillStyle =chartInstance.chart.options.defaultFontColor;
//
//         chartInstance.data.datasets.forEach(function (dataset) {
//             for (var i = 0; i < dataset.data.length; i++) {
//                 var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
//                 ctx.fillText(dataset.data[i], model.x, model.y - 2);
//             }
//         });
//   }
// });
function resetCanvas($chart,$parent) {
  $parent.empty();
  var id=$chart.attr("id");
  $parent.append('<canvas id="'+id+'" class="chartjs-render-monitor"><canvas>');
  canvas = document.querySelector('#'+id); // why use jQuery?
  ctx = canvas.getContext('2d');
  ctx.canvas.width = $parent.width(); // resize to parent width
  ctx.canvas.height = $parent.height() ; // resize to parent height
  var x = canvas.width/2;
  var y = canvas.height/2;
  ctx.font = '10pt Verdana';
  ctx.textAlign = 'center';
  ctx.fillText('Данные загружены не полностью, обновите страницу', x, y);
  return ctx;
};


function chartBar(chart, labels,datasets, colors){
  var ctx = resetCanvas($(chart), $(chart).parent());
  const maxTooltipLength = 24;
    var wordsToArray = function(words) {
       var lines = [];
       var str = '';
       words.forEach(function (word) {
         if ((str.length + word.length + 1) <= maxTooltipLength) {
           str += word + ' ';
         } else {
           lines.push(str);
           str = word + ' ';
         }
       });
       lines.push(str);
       return lines;
    }

    var breakLabels = function(label) {
      var words = label.split(' ');
       return wordsToArray(words);
    }

    var labelsMultiLines = [];
    for (var i=0;i<labels.length;i++){
      labelsMultiLines.push(breakLabels(labels[i]));
    }

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelsMultiLines,
         datasets: datasets,
    },
    options: {
      responsive:true,
      maintainAspectRatio:false,
       tooltips: {
         mode:'index',
         intersect: false,
        callbacks: {
          label: function(tooltipItem, data){
            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ';

                        label += tooltipItem.yLabel.toLocaleString('ru', {maximumFractionDigits: 1})

                        if (tooltipItem.datasetIndex==0){
                          label += " млн. руб"
                            }
                        }

                //        label += Math.round(tooltipItem.yLabel * 100) / 100;
                        return label;
          },
          // afterLabel: otherLabels.bind(this)
        }
      },
      scales: {
          xAxes: [{
                   // gridLines: {
                   //   display: true,
                   //   tickMarkLength: 10,
                   //   color: 'rgba(50,50,50,0.1)',
                   //   // offsetGridLines:true
                   //   drawTicks: false,
                   // },
                   ticks: {
                     padding:10,
                    autoSkip: false,
                    maxRotation: 90,
                    minRotation: 0,
                  }
            }],
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
              scaleLabel: {
                 display: true,
                 labelString: 'Сумма заявок, млн. руб'
               }

						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
              scaleLabel: {
                 display: true,
                 labelString: 'Количество заявок'
               },
							gridLines: {
								drawOnChartArea: false
							}
						}],
					},
        legend: {
          display: false,
          position: 'right',
          fullWidth: true,
          reverse: true,
        },
           title: {
            display: true,
            text: name
        }
    }
});
}
 var start, end;
 var firstDate = new Date(2017,0,1)
// $("#start").keyup(function(){
//   console.log($(this).val());
// });

$("#end").change(function(){
  end = $(this).val() ? toDate($(this).val()) : setBeginMonth();
  start = $("#start").val() ? toDate($("#start").val()) : new Date();
  end = (end>new Date()) ?new Date(): end;
  end = (start >end) ? start.addDays(1) : end;

  $(this).val(end.toLocaleDateString()) ;
  $("#start").val(start.toLocaleDateString());

  loadDate(start, end);
})
$("#start").change(function(){
  start = $(this).val() ? toDate($(this).val()) : setBeginMonth();
  end = $("#end").val() ? toDate($("#end").val()) : new Date();
  start = (start<firstDate) ? setBeginMonth(): start;
  start = (start >end || start<firstDate) ? end.addDays(-1) : start;

  $(this).val(start.toLocaleDateString()) ;
  $("#end").val(end.toLocaleDateString());


  loadDate(start, end);
})
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

function loadDate(from, to){
    $("#mdb-preloader").show();
    var from = getTimePHP(from);
    var to = getTimePHP(to);
  //  $("#textPeriod").text("Период: "+start.toLocaleDateString()+" - "+end.toLocaleDateString());
    $("#table").bootstrapTable('refreshOptions',{
      queryParams:function(p){
        return {start:from, end:to}
      }
    });

  }


 $(function() {

     start = setBeginMonth();
     end = new Date();
     $("#start").val(start.toLocaleDateString());
     $("#end").val(end.toLocaleDateString());
      getStatuses();
      loading();

      // $('.collapse').on('hidden.bs.collapse', function() {
      //     resize();
      // })
      // $('.collapse').on('shown.bs.collapse', function() {
      //     resize();
      // })


  });
  function parseStatus(text) {
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
  };
  function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + s4();
}
function resize() {
    $("#table").bootstrapTable('resetView', {
        height: setHeight()
    });
  //   if (isModalShow()){
  //     $("#comboChart").height($("#chartDiv").height())
  //     $("#comboChart").width($("#chartDiv").width())
  //     $("#comboChart")[0].height=$("#chartDiv").height()
  //       $("#comboChart")[0].width=$("#chartDiv").width()
  // //    analyze()
  //   }
  }
function setHeight(){
 var height = 0;
 height += $('.navbar.fixed-top').outerHeight();
 height += $('#toolbar').outerHeight();
 return window.innerHeight- height;
}

$('#table').on('reset-view.bs.table', function (e) {
 //  Data = $table.bootstrapTable('getData');
 // tableFilter(Data);
});
</script>
</body>
</html>
