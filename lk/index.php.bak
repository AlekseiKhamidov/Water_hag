<?php require_once 'parts/check-login.php'	?>
<html>
  <head>
    <title>
        Личный кабинет
    </title>
    <?php require_once 'parts/css.php'	?>
    <?php require_once 'parts/style.php'	?>
  </head>
  <body>
    <?php require_once '../parts/preloader.php'	?>
    <?php require_once 'parts/nav-bar.php'	?>
    <main>
      <?php require_once 'parts/table.php'	?>
      <?php require_once 'parts/chart.php'	?>
    </main>
    <?php require_once 'parts/script-lib.php'	?>
    <?php require_once 'parts/script-dateMask.php'	?>

<script>
  var Data;
  var filterContainer = "#ulContainer";
  var $table = $("table");
  var managers = {};
  var stages = {};
  var DataStatus={};


function clearFilter(){
     $table.bootstrapTable('filterBy', {});
     $(".filter-show-clear").click()
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
        $(".filter-show-clear").hide();
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
	$('#chartModal').modal('show');
		$('#chartModal').show();
	$("#chartDiv").show();

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
 ctx.canvas.width = $("#chartDiv").width(); // resize to parent width
  ctx.canvas.height = $("#chartDiv").height() ; // resize to parent height
};
 var start, end;
 var firstDate = new Date(2017,0,1)

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
      initTable($("#table"));
      loading();
  })

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
  };
function setHeight(){
 var height = 0;
 height += $('.navbar.fixed-top').outerHeight();
 height += $('#toolbar').outerHeight();
 return window.innerHeight- height;
}
</script>
</body>
</html>
