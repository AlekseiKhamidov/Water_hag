<?php
  require_once "check.php";
  require_once "../config.php";
  require_once "mysql.php";

  if (checkLogin() == -1) {
    header("Location: login.php"); exit();
  };
  $userdata = getUserdata(intval($_COOKIE['id']));
?>
<html>
 <head>
    <title>
        Статистика
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
    </style>

</head>
 <body>
  <header>

    <nav id="menu" class="navbar fixed-top navbar-expand-lg navbar-dark black scrolling-navbar">
        <a class="navbar-brand" href="https://vk.com/aleksei_khamidov"><strong>AMOBIRD</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <?php if ($userdata[ 'user_login']!='admin' ) echo '
                 <li class="nav-item">
                    <a class="nav-link" onclick="reLoad()">Обновить данные <span class="sr-only">(current)</span></a>
                </li>
                '?>
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
 <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-filter mr-1"></i> Фильтры</button> -->

  <button class="btn btn-primary " data-toggle="modal" data-target="#chartModal"><i class="fa fa-bar-chart"></i> Диаграммы</button>

       <input type="text" id="start" required name="start" class="validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
       <input type="text" id="end" name="end"  class=" validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">

    </div>


     <table id="table" class="exampleTable table table-hover table-striped"

        data-toolbar="#toolbar"
        data-show-export="true"
         data-show-columns="true"
          data-filter-control="true"

            data-show-toggle="true"
           data-mobile-responsive="true"
           data-check-on-init="true"
           data-export-types="['excel']"

        >
        </table>
        <div id="ulContainer"></div>
</div>

</div>
</main>


<!-- Modal -->
<div class="modal fade" id="chartModal" tabindex="-1" role="dialog" aria-labelledby="chartModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
          <p class="heading lead">Диаграммы</p>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>
            <div class="modal-body">
 <div class="row d-flex"  >
                <!--Grid column-->
                <div class="col-md-6 mb-4 d-flex">



                           <canvas id="chartCount" height="500px"  ></canvas>

                    </div>
                    <!--/.Card-->

                <!--Grid column-->
  <div class="col-md-6 mb-4 d-flex">


                         <canvas id="chartSum"   height="500px"></canvas>

                    </div>
                    <!--/.Card-->

                </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>





 <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script src="lib/bootstrap-table-master/src/bootstrap-table.js"></script>
           <script src="lib/bootstrap-table-master/src/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <script src="lib/bootstrap-table-master/src/locale/bootstrap-table-ru-RU.js"></script>
    <script type="text/javascript" src="lib/moment-master/min/moment.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.ru.min.js"></script>
    <script type="text/javascript" src="js/filter.js"></script>
    <script type="text/javascript" src="js/util-table.js"></script>
    <script type="text/javascript" src="lib/bootstrap-table-master/src/extensions/export/bootstrap-table-export.js"></script>
    <script type="text/javascript" src="js/tableExport.js"></script>
       <script type="text/javascript" src="lib/bootstrap-table-master/src/extensions/mobile/bootstrap-table-mobile.js"></script>
        <script type="text/javascript" src="lib/bootstrap-table-master/src/extensions/sticky-header/bootstrap-table-sticky-header.js"></script>
    <script src="js/spin.min.js"></script>
    <script src="js/extensions.js"></script>
       <script type="text/javascript" src="../js/jquery.maskedinput.min.js"></script>
       <script src="js/multiselect.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
    $('.mdb-select').material_select();
    $(".datepickerMask").mask("99.99.9999", {placeholder: "ДД.ММ.ГГГГ" });
  });
    </script>
<script>
var Data;
    var filterContainer = "#ulContainer";
    var $table = $("table");

   function getColumns() {
    columns = [
    <?php
        if ($userdata['user_login'] != 'admin') echo ' {
            field: "number",
            title: "№",
            sortable: "true",
            class:"number"
        }
        , '?>
         {
            field: "name",
            title: "ФИО клиента",
            class: "fio",
            // width: "270",
            filterControl: "input"
                //   formatter:formatter
        }, {
            field: "phone",
            title: "Телефон",
            class: "contact",
            // width: "140",
            filterControl:"input"
            //     formatter:durationFormat
        }, {
            field: "createdAt",
            title: "Дата создания",
            class: "dateTo",
            // width: "140",
            sortable: "true",
            sorter: "dateSorter",
            formatter: dateFormat
        },
         <?php if ($userdata['user_login'] != 'admin') echo '
        {
            field: "manager",
            title: "Менеджер '.$userdata['user_login'].'",
            class: "managerCell excel-filter",
            // width: "180",
            sortable: "true",

        }, ';
          if ($userdata['user_login'] == 'OyLi') echo '
        {
              field: "rop",
              title: "РОП",
            class: "managerCell excel-filter",
            // width: "180",
            sortable: "true",

        }, '
         ?>
        {
            field: "price",
            title: "Сумма",
            formatter: priceFormatter,
            align: "right",
            class: "sumCell",
            // width: "120",
            sortable: "true",
        }, {
            field: "status",
            title: "Этап воронки",
            formatter: roundButtonFormatter,
            // width: "240",
            class: "typeCell excel-filter",
            align: "center",
            sortable: "true",
        }, {
            field: "context",
            title: "Примечание",
            //      formatter:formatter
        }
    ];
    console.log(columns);
    return columns;
}

var managers = {};
var stages = {};
var DataStatus={};
function getStatuses() {
    $.ajax({
        url: "getStatuses.php",
        success: function(data) {
          var $div = $("#statuses");
            var pipelines = JSON.parse(data);
            for (index in pipelines){
              console.log(pipelines[index]);
              var pipeline = pipelines[index];
              if (pipeline.is_main){
                addSwitch($div, pipeline.name, pipeline.status);
                DataStatus = pipelines[index]
              }
              else
                if ('<?php echo $userdata['user_login'] ?>'== 'Gard'){

                addSwitch($div, pipeline.name, pipeline.status);
                 DataStatus = pipelines[index]

              }

            }
            $("#saveFilter").on('click', function() {

              console.log("saveFilter");
              dateFrom = toDate(from_picker.get("valueSubmit"))
              dateFrom.setHours(0);
              console.log(dateFrom);
              dateTo = toDate(to_picker.get("valueSubmit"));
              dateTo.setDate(dateTo.getDate() + 1);
              dateTo.setHours(0);
               console.log(dateTo);
          //    filterTable(dateFrom, dateTo);

              var switches = $(".switch.round.blue-white-switch").find("input[type='checkbox']");
              var statusList=[];
              for (var i=0; i<switches.length;i++){
                console.log(switches[i])
                var switch_div = $(switches[i]).parents(".switch.round.blue-white-switch");
                var idGroup = switch_div.attr("for");
                var pipeline = switch_div.attr("pipeline");



                if ($(switches[i]).prop("checked")){
                   var status = $("#"+idGroup).find("input[type='checkbox']:checked").each(saveFilter);
                }
                else {
                 // var status = $("#"+idGroup).find("input[type='checkbox']").each(saveFilter);
                 //statusList.push("");
                }
              }
              function saveFilter(){
                var color = $(this).parent().attr("color")
                statusList.push(pipeline+'^'+$(this).parent().attr("value")+'^'+color)
              };
              console.log(statusList);
              var values = [{
                name: "status",
                values: statusList
              }];
              filterBy($("#table"), values);

              //var data = $table.bootstrapTable('getData');
              if (statusList.length>0){
                analyze(statusList);
              }
              else {
                analyze(DataStatus.status);
              }


              $('#exampleModal').modal("hide");
              totalSum();
            });


            initTable($("#table"), getColumns());
        }
    })
};
 var Data;
 function initTable($table, columns) {
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
         url: "getData.php",
         columns: columns,
          minWidth: 1000,
          // stickyHeader: true,
          // stickyHeaderOffsetY:'60px',
       //   stickyHeaderOffsetY:stickyHeaderOffsetY + 'px',

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
         Data = $table.bootstrapTable('getData');
        tableFilter(Data);
         analyze(DataStatus.status);
      //   filterTable(start, end);
          totalSum();
         //  alert('o');
     });

     $table.on('refresh.bs.table', function(e, arg1, arg2) {
         clearFilter();
     });

     $('.mdb-select').material_select();
 };
 function loadDate(){
   initTable($("#table"), getColumns());
 };
function analyze(statuses){
  var data = $("#table").bootstrapTable('getData');
  //var statuses = statuses.status;
  var colors = [];
  var datasetCount = [];
  var datasetSum = [];
  var labels = [];
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
    labels.push(parseStatus(statuses[i]).val);

      datasetSum.push(sum);
      datasetCount.push(count);
  }
  console.log(datasetCount);
  console.log(datasetSum);
  //chartPie(labels, datasetCount, colors)
  chartBar(document.getElementById("chartCount"),labels, datasetCount, colors, 'Количество заявок',function(value, index, values) {
   //return value.toLocaleString()+" руб";
     var num = parseInt(value);
      return num;
  },);
   chartBar(document.getElementById("chartSum"),labels, datasetSum, colors, "Сумма заявок",function(value, index, values) {
   //return value.toLocaleString()+" руб";
     var num = parseInt(value)/1000000;
      return num.toLocaleString()+" млн руб";
  },
    function(tooltipItem, data){
      return tooltipItem.xLabel.toLocaleString()+" руб";
    })
};

function resetCanvas($chart,$parent) {
  $parent.empty();
  var id=$chart.attr("id");
  $parent.append('<canvas id="'+id+'" class="chartjs-render-monitor"><canvas>');
  canvas = document.querySelector('#'+id); // why use jQuery?
  ctx = canvas.getContext('2d');
  ctx.canvas.width = $parent.width(); // resize to parent width
  ctx.canvas.width = "600"; // resize to parent width
  var x = canvas.width/2;
  var y = canvas.height/2;
  ctx.font = '10pt Verdana';
  ctx.textAlign = 'center';
  ctx.fillText('Данные загружены не полностью, обновите страницу', x, y);
  return ctx;
};


function chartBar(chart, labels,dataset, colors, name, callbackX=null, callbackTooltip){
  if (!callbackX) {
    callbackX = function(value, index, values) {return value; }
  }
  if (!callbackTooltip) {
    callbackTooltip = function(tooltipItem, data) {return tooltipItem.xLabel; }
  }
  var ctx = resetCanvas($(chart), $(chart).parent());
  //var ctx = chart.getContext('2d');
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
    type: 'horizontalBar',
    data: {
        labels: labelsMultiLines,
      //  labels: labels,
        datasets: [{
            label: name,
            data: dataset,
            backgroundColor:colors,
            borderWidth: 1
        }]
    },
    options: {
       tooltips: {
        callbacks: {
          label: callbackTooltip,
          // afterLabel: otherLabels.bind(this)
        }
      },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,

                }
            }],
            xAxes: [{
                      ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 0,
                        callback: callbackX
                      }
                    }]
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
    var from = getTimePHP(from);
    var to = getTimePHP(to);
    $("#textPeriod").text("Период: "+start.toLocaleDateString()+" - "+end.toLocaleDateString());
   $("#table").bootstrapTable('refreshOptions',{
 //  data:Data,
         queryParams:function(p){
      //  return {start:start.getTime()/1000|0, end:end.getTime()/1000|0}
        return {start:from, end:to}
      }
      //    url:"getStatistics1.php" ,
       // data:Data
      });
  }


 $(function() {

     start = setBeginMonth();
     end = new Date();
     $("#start").val(start.toLocaleDateString());
     $("#end").val(end.toLocaleDateString());
     $("#start").attr("max", end.toLocaleDateString() );
     $("#end").attr("min", start.toLocaleDateString() );
      // $('[name="start"]').val(start.toLocaleDateString());
      // $('[name="end"]').val(end.toLocaleDateString());


      getStatuses();
      loading();

      $('.collapse').on('hidden.bs.collapse', function() {
          resize();
      })
      $('.collapse').on('shown.bs.collapse', function() {
          resize();
      })
  });
 function resize() {
    $("#table").bootstrapTable('resetView', {
        height: getHeightState()
    });
  };



function addSwitch($div,name, statuses){
  var idGroup = guid();
  var html =   '<div class="row mb-4">'
              +'  <div class="switch round blue-white-switch" for="'+idGroup+'" pipeline="'+name+'">'
              +'    <label>'
              +'      <input type="checkbox" >'
              +'        <span class="lever"></span>'
              +         name
              +'    </label>'
              +'  </div>'

              +'<div id="'+idGroup+'" data-toggle="buttons" style="display:none">'
              +'</div>'
               +'</div>';

  $div.append(html);
   $('.switch input[type="checkbox"]').on('change', function() {
    console.log('Yaay, I was changed');
    var idGroup = $(this).parents(".switch.blue-white-switch").attr("for");
    if ($(this).prop("checked")){
      $("#"+idGroup).fadeIn();
    }
    else {
     $("#"+idGroup).fadeOut();

    }
});
var $group = $("#"+idGroup);

  for (var i=0;i<statuses.length;i++){
    var status = parseStatus(statuses[i]);
    addCheckBox($group, status.val, status.color);
  }

  $group.find('input[type="checkbox"]').on('change', function() {
    console.log('poooo');
    if ($(this).prop("checked")){
      var color = $(this).parent().attr("color");
      $(this).parent().css("background-color",color);
    }
    else {
      $(this).parent().css("background-color","");

    }
});
}
  function addCheckBox($group, text, color) {
    var html=  '<label class="btn btn-rounded active btn-checkbox" color="'+color+'" style="background-color:'+color+'" value="'+text+'">'
              +'  <input type="checkbox" checked autocomplete="off" >'
              +     text
              +'</label>';
    $group.append(html);
    // body...
  };
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
  }
function setHeight(){
 var height = 0;
 height += $('.navbar.fixed-top').outerHeight();
 height += $('#toolbar').outerHeight();
 return window.innerHeight- height;
}
</script>
</body>
</html>
