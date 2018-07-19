<?php
  require_once "check.php";
  require_once "config.php";
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
 
  <link href="../css/style.css" rel="stylesheet">
    <link href="../css/compiled.min.css" rel="stylesheet">
    <!-- <link href="../css/materialize.min.css" rel="stylesheet"> -->        
        <link rel="stylesheet" href="lib/bootstrap-table-master/src/bootstrap-table.css">
        <link rel="stylesheet" href="lib/bootstrap-table-master/src/extensions/sticky-header/bootstrap-table-sticky-header.css">
        <link rel="stylesheet" type="text/css" href="lib/bootstrap-table-filter-master/src/bootstrap-table-filter.css">

         <link rel="stylesheet" href="lib/excel-bootstrap-table-filter-master/dist/excel-bootstrap-table-filter-style.css" />
       <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" /> -->
      <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

       -->
<link rel="stylesheet" href="lib/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css">
    <style type="text/css"> 
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
.multiselect-container input[type=checkbox]{
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
  

 
<div  class=" mt-5 ml-4 mr-4 pt-4">
  <div class="row justify-content-between" >
    <div class="col">
     
    </div>
    
    </div>



    <div class="container-fluid">

<button type="button" class="btn btn-default" data-toggle="popover" data-placement="top" title="popover on top" 
>popover on top</button>



   <div id="toolbar">
   </div>
        

     <table id="table" class="exampleTable table table-hover table-striped" 

        data-toolbar="#toolbar" 
        data-show-export="true"
         data-show-columns="true"
          data-filter-control="true"
         data-show-filter="true"
            data-show-toggle="true"
           data-mobile-responsive="true"
           data-check-on-init="true" 
           data-export-types="['excel']"
        >
        </table>
</div>

</div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
          <p class="heading lead">Настройка фильтров</p>
  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>
            <div class="modal-body">
       <!--Grid row-->
              <div class="row">
              <!--Grid column-->
              <div class="col-md-6 mb-4">
                  <div class="md-form">
                  <!--The "from" Date Picker -->
                  <input placeholder="Выберите начало периода" type="text" id="startingDate" class="form-control datepicker">
                  <label for="startingDate">Начало</label>
                  </div>
              </div>
              <div class="col-md-6 mb-4">
                  <div class="md-form">
                  <!--The "to" Date Picker -->
                  <input placeholder="Выберите конец периода" type="text" id="endingDate" class="form-control datepicker">
                  <label for="endingDate">Конец</label>
                  </div>
              </div>
              </div>
              <div id="statuses">  
              </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="saveFilter" >Применить фильтры</button>
            </div>
        </div>
    </div>
</div>

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
        <script src="lib/bootstrap-table-master/src/extensions/filter/bootstrap-table-filter.js"></script>
  <script src="lib/bootstrap-table-filter-master/src/bootstrap-table-filter.js"></script>
        <script src="lib/bootstrap-table-filter-master/src/ext/bs-table.js"></script>

            <script src="lib/excel-bootstrap-table-filter-master/dist/excel-bootstrap-table-filter-bundle.js"></script>




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
     <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
        <script type="text/javascript" src="lib/bootstrap-table-master/src/extensions/select2-filter/bootstrap-table-select2-filter.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="lib/TableFilter-master/dist/tablefilter/tablefilter.js"></script>   



    <script src="js/spin.min.js"></script>
    <script src="js/extensions.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('#toolbar').bootstrapTableFilter({
                                    connectTo: '#tableWorkflow',
                                    onAll: function(name, args) {
                                        var d = new Date();
                                  //      $('#log').prepend(d.toLocaleString() + ': ' + name + "\n");
                                    },
                                    onSubmit: function(data) {
                                        var data = $('#toolbar').bootstrapTableFilter('getData');
                                        var d = new Date();
                                     //   $('#log').prepend(d.toLocaleString() + ': ' + JSON.stringify(data) + "\n");
                                    }
                                });

         //   $('[data-toggle="popover"]').popover()
      //  $('#example-getting-started').multiselect();


          //  });
          //    $('.mdb-select').material_select();
  });
//       $('.selectpicker').selectpicker({
 
// });

    </script>
<script>

   function getColumns() {
    columns = [ 
    <?php
        if ($userdata['user_login'] != 'admin') echo ' {
            field: "number",
            title: "№",
            sortable: "true"
                //    formatter:formatter
        }
        , '?>
         {
            field: "name",
            title: "ФИО клиента",
            class: "fio",
            // width: "270",
          //  filterControl: "input"
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
            class: "managerCell",
            // width: "180",
            sortable: "true",
          //  filterControl:"select"
             filter: {
              type: "select",
              data: []
            }
        }, ';
          if ($userdata['user_login'] == 'OyLi') echo '
        {
              field: "rop",
              title: "РОП",
            class: "managerCell",
            // width: "180",
            sortable: "true",
            filterControl:"select"
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
            class: "typeCell",
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
              filterTable(dateFrom, dateTo);

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
             $('.mdb-select li').on("click", function() {
        alert('something');
});
        }
    })
};

 //    function initDatePicker() {
 //     $('.input-daterange').datepicker({
 //         language: "ru",
 //         todayBtn: "linked",
 //         assumeNearbyYear: "true",
 //         enableOnReadonly: "true"
 //     }).datepicker().on('changeDate', function(e) {
 //      //  alert("dd");
 //         var dates = $(this).data().datepicker.dates;
 //         if (dates.length > 1) {
 //             var start = dates[0]
 //             start.setHours(0);
 //             var end = dates[1];
 //             if (dates.length > 0 && start.getTime() != end.getTime()) {
 //                 end.setDate(end.getDate() + 1);
 //                 end.setHours(0);
 //                 //   alert(dates);
 //                 filterTable(start, end);
 //                 totalSum();
 //             }
 //         }
 //     });
 // }

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
      var $table = $table.bootstrapTable({
         url: "getData.php",
         columns: columns,
          minWidth: 1000,
          // stickyHeader: true,
          // stickyHeaderOffsetY:'60px',
       //   stickyHeaderOffsetY:stickyHeaderOffsetY + 'px',

         height: setHeight(),
        //   filter: true,
        // filterTemplate: {
        //   input: function(bootstrapTable, column, isVisible) {
        //     return '<input type="text" class="form-control input-sm" data-filter-field="' + column.field + '" style="width: 100%; visibility:' + isVisible + '">';
        //   }
        // }
     });
    //   $table.bootstrapTable("setSelect2Data", "manager", ["", "Березова Татьяна","Сергеев Борис"]);
     var result = 0;
     $(window).resize(function() {
         resize();
     })
    // $("#textPeriod").text("Итого: " + result.toLocaleString() + " руб");
     $table.on('load-success.bs.table', function(data) {



var multiselect ='<select class="mdb-select" multiple>'
        +'<option value="" disabled selected>Choose your country</option>'
        +'<option value="Лузанов Денис">Лузанов Денис</option>'
        +'<option value="2">Germany</option>'
        +'<option value="3">France</option>'
        +'<option value="4">Poland</option>'
        +'<option value="5">Japan</option>'
    +'</select>';

      $('[data-toggle="popover"]').popover({ 
    html : true,
    content: function() {

      return $('#popover_content_wrapper').html();
    }
  });
   // $(data.target).find("th[data-field='manager'] .fht-cell").append(multiselect);

     $('.mdb-select').material_select();
    //   var filtersConfig = {
    //     base_path: '../lk/lib/TableFilter-master/dist/tablefilter/',
    //     // col_1: 'select',
    //     col_4: 'checklist',
    //     // col_8: 'none',
    //     popup_filters: true,
    //     auto_filter: {
    //         delay: 1100 //milliseconds
    //     },
    //     alternate_rows: true,
    //     rows_counter: true,
    //     btn_reset: true,
    //     status_bar: true,
    //     msg_filter: 'Filtering...',
    //     // col_widths:[
    //     //     '125px', '90px', '100px',
    //     //     '90px', '90px', '90px',
    //     //     '90px', '90px', '90px'
    //     // ]
    // };
    // var tf = new TableFilter('table', filtersConfig);
    // tf.init();

         Data = $table.bootstrapTable('getData');
         analyze(DataStatus.status);
         filterTable(start, end);
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
// function chartPie(labels,dataset, colors,name){
//   var ctx = document.getElementById("myChart").getContext('2d');
// var myPieChart = new Chart(ctx, {
//     type: 'pie',
//     data: {
//         labels: labels,
//         datasets: [{
//          //   label: '# of Votes',
//             data: dataset,
//             backgroundColor: colors,         
//             borderWidth: 1
//         }]
//     },
//     options: {
//        responsive: true,
//        legend: {
//            display: true,
//     position: 'right',
//     fullWidth: true, 
//     reverse: true,
//         }
//     }      
// });
//   //document.getElementById("legendDiv").innerHTML = myPieChart.generateLegend();
// };
function resetCanvas($chart,$parent) {
  $parent.empty();
  //$chart.remove(); // this is my <canvas> element
  var id=$chart.attr("id");
  $parent.append('<canvas id="'+id+'" class="chartjs-render-monitor"><canvas>');
  canvas = document.querySelector('#'+id); // why use jQuery?
  ctx = canvas.getContext('2d');
  ctx.canvas.width = $parent.width(); // resize to parent width
//  ctx.canvas.height = $('#chart').height(); // resize to parent height
  ctx.canvas.width = "600"; // resize to parent width
//  ctx.canvas.height = 500 ; // resize to parent height

  var x = canvas.width/2;
  var y = canvas.height/2;
  ctx.font = '10pt Verdana';
  ctx.textAlign = 'center';
 // ctx.fillStyle = "white";
// ctx.fill = 'rgba(255, 0, 255, 0.5)';
//ctx.fillStyle = "white";
//ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
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
 $(function() {
   loadFilter();
    
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
  jQuery.extend( jQuery.fn.pickadate.defaults, {
    monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
    monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
    weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
    weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
    today: 'сегодня',
    clear: 'удалить',
    close: 'закрыть',
    firstDay: 1,
    format: 'd mmmm yyyy г.',
    formatSubmit: 'dd.mm.yyyy'

});
  
function loadFilter(){

    start = setBeginYear();
      end = new Date();
      formatDate(start, end);
  //    $('#startingDate').val(start.toLocaleDateString());
   //   $('#endingDate').val(end.toLocaleDateString());

 // $('#exampleModal').openModal();
   
    from_picker = $('#startingDate').pickadate({container: 'body',
          closeOnSelect: "true",
  closeOnClear: true,

     }).pickadate('picker');
    from_picker.set('select', start);
     to_picker = $('#endingDate').pickadate({container: 'body',}).pickadate('picker');
      to_picker.set('select', end);

    
      // Check if there’s a “from” or “to” date to start with and if so, set their appropriate properties.
      if ( from_picker.get('value') ) {
          to_picker.set('min', from_picker.get('select'))
      }
      if ( to_picker.get('value') ) {
          from_picker.set('max', to_picker.get('select'))
      }

      // Apply event listeners in case of setting new “from” / “to” limits to have them update on the other end. If ‘clear’ button is pressed, reset the value.
      from_picker.on('set', function(event) {
          if ( event.select ) {
              to_picker.set('min', from_picker.get('select'))
          }
          else if ( 'clear' in event ) {
              to_picker.set('min', false)
          }
      })
      to_picker.on('set', function(event) {
          if ( event.select ) {
              from_picker.set('max', to_picker.get('select'))
          }
          else if ( 'clear' in event ) {
              from_picker.set('max', false)
          }
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
