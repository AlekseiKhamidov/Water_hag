<?php
  require_once "check.php";
  require_once "config.php";
  require_once "mysql.php";

  if (checkLogin() == -1) {
    header("Location: login.php"); exit();
  };
  $userdata = getUserdata(intval($_COOKIE['id']));
<html> 
 <head> 
      <title> 
           Фортуна | Cделки
      </title>
        <link rel="stylesheet" href="css/bootstrap.min.css"  crossorigin="anonymous">
        <link rel="stylesheet" href="lib/bootstrap-table-master/src/bootstrap-table.css">

        <link rel="stylesheet" href="css/switcher.css" />
        <link rel="stylesheet" href="css/table.css" />
        <link rel="stylesheet" href="lib/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
        <script src="js/jquery.min.js"></script>
       
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="lib/bootstrap-table-master/src/bootstrap-table.js"></script>
        <script src="lib/bootstrap-table-master/src/locale/bootstrap-table-ru-RU.js"></script>
        <script type="text/javascript" src="lib/moment-master/min/moment.min.js"></script>
        <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.ru.min.js"></script>
        <script type="text/javascript" src="js/filter.js"></script>
        <script type="text/javascript" src="js/util-table.js"></script>
        <script type="text/javascript" src="js/bootstrap-table-export.js"></script>
        <script type="text/javascript" src="js/tableExport.js"></script>
        
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
        	
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">            	
                <?php 
                  
                  echo "{$userdata['user_login']}";
                  if ($userdata['partner_name']) {
                    echo " ({$userdata['partner_name']})";
                  }
                ?>
                 <span class="caret"></span></a>
            <ul class="dropdown-menu">
            	<li><a href="#" onclick="loadUsers()">Таблица пользователей</a></li>


              <?php
                if ($userdata['is_admin']) {
                  echo "<li><a href='register.php'>Зарегистрировать пользователя</a></li>";
                }
              ?>
              <li><a href="logout.php">Выйти</a></li>
              
            </ul>


          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
  <div id="mainTable" class="well well-lg">
    <div id="panelFilter" class="panel panel-primary">
      <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" class="accordion-toggle collapsed" href="#collapse1" >Фильтры</a>
          </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">


          <div >
            <div class="inline textPeriod">
              <h5>Выберите период: </h5>
            </div>

            <div class="inline" id="sandbox-container">
              <div class="input-group date">
                <div class="input-daterange input-group" id="datepicker">
                  <input type="text" class="input-sm form-control" name="start" />
                  <span class="input-group-addon">по</span>
                  <input type="text" class="input-sm form-control" name="end" />

                </div>
              </div>
            </div>
          </div>
          <div id="check-group"></div>
          <div id="chip-group" ></div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div id="toolbar">
          <div class="divSum">
              <h5 style="    font-weight: bold;">Итого: <span id="Sum"></span> </h5>
            </div>
      </div>
      <table id="table" 
        data-toolbar="#toolbar" 
        data-url="getLeads.php" 
         data-show-refresh="true" 
        data-show-columns="true"
        data-show-export="true" 
       >
        <thead>
            <tr>
                <th data-field="name" data-sortable="true" data-width="310" class="namePartner">Наименование сделки</th>
                <th data-field="phone" data-sortable="true" data-width="130" class="contact">Контакты</th>
                <th data-field="date_create" data-align="center"  data-width="140" data-sortable="true" data-sorter="dateSorter" class="dateTo" >Дата создания</th>
                <th data-field="last_modified" data-align="center" data-width="140"  data-sortable="true" data-sorter="dateSorter"  class="dateTo">Последнее изменение</th>
                <th data-field="price" data-align="right" data-width="120" data-formatter="priceFormatter" data-sortable="true" class="sumCell">Сумма</th>
                <th data-field="pipeline" data-sortable="true" data-width="240" class="typeCell">Воронка</th>
                <th data-field="status" data-formatter="cheapFormatter" data-sortable="true" >Этап воронки</th>
            </tr>
            </thead>
      </table>
    </div>
  </div>
  <div id="users" class="well well-lg" style="display: none;">
  	<div class="panel panel-default">
  		
  <div id="divUsers">
  	<div id="toolbarUsers">
        <button id="remove" class="btn btn-danger" disabled>
            <i class="glyphicon glyphicon-remove"></i> Delete
        </button>
    </div>
		<table id="tableUsers" 
 		 data-toolbar="#toolbarUsers"
        data-url="getUsers.php" 
         data-show-refresh="true" 
        data-show-columns="true"
        data-show-export="true" 
       >
        <thead>
            <tr>
            	
                <th data-field="user_login"  data-sortable="true">user_login</th>
                <th data-field="is_admin" data-sortable="true">is_admin</th>
                <th data-field="partner_name" data-align="center"  data-sortable="true"  >partner_name</th>
                <th data-field="operate" data-align="center" data-events="operateEvents" data-formatter="operateFormatter">Операции</th>
            </tr>
            </thead>
      </table>
  </div>
</div>
<div class="modal fade" id="viewMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Редактировать данные
                </h4>
           
            </div>
            <div class="modal-body">
                 <form class="form-horizontal" role="form">
                  <div class="form-group">
                  	 <div class="col-sm-offset-1 col-sm-9">
                    <label  class=" control-label"
                              for="inputUser_login">Логин</label>
                        <input type="text" class="form-control" required="required" name="user_login" 
                        id="inputuser_login" />
                    </div>                   
                  </div>
                  <div class="form-group">
                 <div class="col-sm-offset-1 col-sm-9">
                      <div class="checkbox">
                        <label>
                            <input type="checkbox" id="inputIsAdmin" name="isAdmin"/> Администратор
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  	 <div class="col-sm-offset-1 col-sm-9">
                    <label for="partnerSelect">Принадлежит организации-партнеру:</label>
                  <select class="form-control" id="partnerSelect" name="partnerSelect">
    			        <?php
    			        	include_once 'amoconn.php';
    			        	$data = getPartnersList();
    			        	foreach ($data as $value) {
    			        		echo "<option>$value</option>";
    			        	}
    			        ?>
    		      </select>
    		  </div>
                  </div>
	<div class="form-group">
                   <div class="col-sm-offset-1 col-sm-9">
                      <div class="checkbox">
                        <label>
                            <input type="checkbox" id="inputIsPassword" onchange="isPasswordClick(this);" name="isPassword"/> Поменять пароль?
                        </label>
                      </div>
                  
                 
                  <div id="panelPassword" class="panelPassword" style="display: none;">
                  	<div class="form-group">
                  		<div class="col-sm-offset-0 col-sm-12">
                    <label for="password">Новый пароль</label>
                    <input type="password" class="form-control" name="password" placeholder="Пароль">
                </div>
                  </div>

                  <div class="form-group">
                  	<div class="col-sm-offset-0 col-sm-12">
                    <label for="confirm">Повторите пароль</label>
                    <input type="password" class="form-control" name="confirm" placeholder="Повторите пароль">
                </div>
                  </div>
              </div>
          </div>
  </div>
 </div>

                </form>
          
             <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Закрыть
                </button>
                <button type="button" onclick="saveUser()" class="btn btn-primary">
                    Сохранить
                </button>
            </div>
             </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
  <script>
     var $maintable = $('#table');
     var $tableUsers = $("#tableUsers");
     var heightBody;

     function saveUser(){
     	validate();
     }


     function isPasswordClick(checkbox){
     	if ($(checkbox).prop("checked")){
     		$("#panelPassword").show();
     	} else {
     		$("#panelPassword").hide();
     	}
     }


     function loadUsers(){
     	$("#users").show();
     	$("#mainTable").hide();
     	
     }

      function operateFormatter(value, row, index) {
        return [
            '<a class="edit" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-heart"></i>',
            '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove"></i>',
            '</a>'
        ].join('');
    }
    window.operateEvents = {
        'click .edit': function (e, value, row, index) {
        	$('#viewMemberModal').find("#inputUser_login").val(row.user_login);
        	$('#viewMemberModal').find("#inputIsAdmin").prop( "checked", (row.is_admin) );
        	$('#viewMemberModal').find("#partnerSelect").val(row.partner_name)
            $('#viewMemberModal').modal('show')
      /*  	.find('.modal-body').html('<pre>' + 
            JSON.stringify(row, null, 4) + '</pre>');*/
        },
        'click .remove': function (e, value, row, index) {
        	alert('remove');
            $tableUsers.bootstrapTable('remove', {
                field: 'user_login',
                values: [row.user_login]
            });
        }
    };
    function passValidate(idPanel){
    	var password = $("#"+idPanel+" input[type='password']");
    	if (password.length>1){
    		
    	}


    }
     function validate(){
        var formValid = true;
      //перебрать все элементы управления input 
       $('#viewMemberModal input[required]').each(function() {
      //найти предков, которые имеют класс .form-group, для установления success/error
      var formGroup = $(this).parents('.form-group');
      //для валидации данных используем HTML5 функцию checkValidity
      if (this.checkValidity()) {
        //добавить к formGroup класс .has-success, удалить has-error
        formGroup.addClass('has-success').removeClass('has-error');
      } else {
        //добавить к formGroup класс .has-error, удалить .has-success
        formGroup.addClass('has-error').removeClass('has-success');
       //отметить форму как невалидную 
        formValid = false;  
      }
    });
    //если форма валидна, то
    if (formValid) {
      //сркыть модальное окно
      $('#viewMemberModal').modal('hide');
      //отобразить сообщение об успехе
      $('#success-alert').removeClass('hidden');
    }
     }


    function initTable($table) {
      $table.bootstrapTable({
        height: getHeight(),
      });

      $(window).resize(function() {
        $table.bootstrapTable('resetView', {
          height: getHeight()
        });
      });
       setTimeout(function () {
            $table.bootstrapTable('resetView');
        }, 200);
      $table.on('load-success.bs.table', function(e, arg1, arg2) {
        Data = $table.bootstrapTable('getData');
        totalSum();
      });
      $table.on('refresh.bs.table', function(e, arg1, arg2) {
        clearFilter();
      });
    }

    function initDatePicker() {
      $('.input-daterange').datepicker({
        language: "ru",
        todayBtn: "linked",
        assumeNearbyYear:"true",
        enableOnReadonly:"true"
       }).datepicker().on('changeDate', function(e) {
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


  //     $('.datepicker').datepicker('method', arg1, arg2);
    }

    function initFilter() {
      $.ajax({
        url: "getStatuses.php",
        success: function(data) {
          data = JSON.parse(data);
          loadCheckbox(data);
        }
      });
      $('#panelFilter').on('shown.bs.collapse', function(e) {
        // getHeight(heightBody)
        $maintable.bootstrapTable('resetView', {
                height: getHeight(heightBody)
            });
      })
      $('#panelFilter').on('show.bs.collapse', function(e) {
         heightBody = $(window).height();
      })
      $('#panelFilter').on('hidden.bs.collapse', function(e) {
     //    getHeight(heightBody)
     $maintable.bootstrapTable('resetView', {
                height: getHeight(heightBody)
            });
      })
    };

    $(function() {
      initTable($("#table"));
      initDatePicker();
      initFilter();
       initTable($("#tableUsers"));
     
      $("#tableUsers").on('editable-init.bs.table',function(e){
      	alert('o');
      });
  });

    </script>
 </body> 
 </html>
