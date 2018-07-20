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
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="lib/bootstrap-table-master/src/bootstrap-table.css">

    <link rel="stylesheet" href="css/switcher.css" />
    <link rel="stylesheet" href="css/table.css" />
    <link rel="stylesheet" href="lib/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
    <script src="js/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="lib/bootstrap-table-master/src/bootstrap-table.js"></script>
    <script src="lib/bootstrap-table-master/src/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <script src="lib/bootstrap-table-master/src/locale/bootstrap-table-ru-RU.js"></script>
    <script type="text/javascript" src="lib/moment-master/min/moment.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.ru.min.js"></script>
    <script type="text/javascript" src="js/filter.js"></script>
    <script type="text/javascript" src="js/util-table.js"></script>
    <script type="text/javascript" src="js/bootstrap-table-export.js"></script>
    <script type="text/javascript" src="js/tableExport.js"></script>
    <script src="js/spin.min.js"></script>
    <script src="js/extensions.js"></script>
</head>
 <body>
 <nav id="menu" class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://vk.com/aleksei_khamidov">AMOBIRD</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if ($userdata[ 'user_login']=='admin' ) echo '
                   <li class="dropdown">
                      <a href="register.php" style="cursor: pointer;"  role="button" >              
                          Зарегистрировать нового партнера </a>
                    </li>
                '?>
                <li class="dropdown">
                    <a onclick="reLoad()" style="cursor: pointer;" role="button">Обновить данные </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       <?php echo "{$userdata['user_login']}"; if ($userdata[ 'partner_name']) { echo " ({$userdata['partner_name']})"; } ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">Выйти</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
  <div id="mainTable" class="well well-lg">
    <div id="panelFilter" class="panel panel-primary" style="margin-bottom: 5px;">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" class="accordion-toggle" href="#collapse1">Фильтры</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <div>
                    <div class="inline textPeriod">
                        <h4>Выберите период: </h4>
                    </div>
                    <div class="inline" id="sandbox-container">
                        <div class="input-group date">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control datepicker" name="start" />
                                <span class="input-group-addon">по</span>
                                <input type="text" class="input-sm form-control datepicker" name="end" />
                            </div>
                        </div>
                    </div>
                    <div id="check-group"></div>
                    <div id="chip-group"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div id="toolbar">
            <div class="divSum">
                <h4><span id="textPeriod"></span> </h4>
            </div>
        </div>
        <table id="table" class="exampleTable table table-hover table-striped" 
        data-toolbar="#toolbar" 
        data-show-export="true"
         data-show-columns="true"
          data-filter-control="true"
        >
        </table>
    </div>
</div>

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
            width: "270",
            filterControl: "input"
                //   formatter:formatter
        }, {
            field: "phone",
            title: "Телефон",
            class: "contact",
            width: "140",
            filterControl:"input"
            //     formatter:durationFormat
        }, {
            field: "createdAt",
            title: "Дата создания",
            class: "dateTo",
            width: "140",
            sortable: "true",
            sorter: "dateSorter",
            formatter: dateFormat
        },
         <?php if ($userdata['user_login'] != 'admin') echo '
        {
            field: "manager",
            title: "Менеджер '.$userdata['user_login'].'",
            class: "managerCell",
            width: "180",
            sortable: "true",
            filterControl:"select"
        }, ';
          if ($userdata['user_login'] == 'OyLi') echo '
        {
	            field: "rop",
	            title: "РОП",
            class: "managerCell",
            width: "180",
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
            width: "120",
            sortable: "true",
        }, {
            field: "status",
            title: "Этап воронки",
            formatter: cheapFormatter,
            width: "240",
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

function getStatuses() {
    $.ajax({
        url: "getStatuses.php",
        success: function(data) {
            data = JSON.parse(data);
            data = data.data["Потребительский кредит"];
            var newdata = {
                data: {
                    "Потребительский кредит": data
                }
            };
            loadCheckbox(newdata);
            initDatePicker();
            initTable($("#table"), getColumns());
        }
    })
};
    function initDatePicker() {
     $('.input-daterange').datepicker({
         language: "ru",
         todayBtn: "linked",
         assumeNearbyYear: "true",
         enableOnReadonly: "true"
     }).datepicker().on('changeDate', function(e) {
      //  alert("dd");
         var dates = $(this).data().datepicker.dates;
         if (dates.length > 1) {
             var start = dates[0]
             start.setHours(0);
             var end = dates[1];
             if (dates.length > 0 && start.getTime() != end.getTime()) {
                 end.setDate(end.getDate() + 1);
                 end.setHours(0);
                 //   alert(dates);
                 filterTable(start, end);
                 totalSum();
             }
         }
     });
 }

 var Data;
 function initTable($table, columns) {
     var from = getTimePHP(start);
     var to = getTimePHP(end);
     $table.bootstrapTable({
         url: "getData.php",
         columns: columns,
         height: getHeightState()
     });
     var result = 0;
     $(window).resize(function() {
         resize();
     })
     $("#textPeriod").text("Итого: " + result.toLocaleString() + " руб");
     $table.on('load-success.bs.table', function(data) {
         Data = $table.bootstrapTable('getData');
         filterTable(start, end);
          totalSum();
         //  alert('o');
     });
     $table.on('refresh.bs.table', function(e, arg1, arg2) {
         clearFilter();
     });
 };
 function loadDate(){
 	  $("#table").bootstrapTable('refreshOptions',{
   //  data:Data,
           queryParams:function(p){
        //  return {start:start.getTime()/1000|0, end:end.getTime()/1000|0}
        //  return {start:from, end:to}
        }
        //    url:"getStatistics1.php" ,
         // data:Data
        });
 };

 var start, end;
 $(function() {
      start = setBeginYear();
      end = new Date();
      formatDate(start, end);
      $('[name="start"]').val(start.toLocaleDateString());
      $('[name="end"]').val(end.toLocaleDateString());

    
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
  }
 </script>
</body> 
</html>
