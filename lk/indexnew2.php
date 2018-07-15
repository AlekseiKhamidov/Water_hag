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
.dropdown-item>input[type=checkbox]{
  visibility:visible;
      position: relative;
    left: auto;
}
    </style>

</head>
 <body>
<div  class=" mt-5 ml-4 mr-4 pt-4">

<div class="dropdown" >
<!--   <button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
  <!--  <a type="button" class="btn-floating btn-sm purple-gradient  dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" aria-hidden="true"></i></a> -->
 
   <a type="button" class=" icons-sm fb-ic"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter" aria-hidden="true"></i></a>
    <!-- <i class="fa fa-toggle-down"></i> -->
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <div>
      <label class="dropdown-item">
        <input type="checkbox" value="Select All" checked="checked" class="dropdown-filter-menu-item select-all" data-column="0" data-index="0"> 
        Select All
      </label>
      <label class="dropdown-item">
        <input type="checkbox" value="blog" checked="checked" class="dropdown-filter-menu-item item" data-column="0" data-index="0">
         blog
       </label>
       <label class="dropdown-item">
        <input type="checkbox" value="bootstrap-show-password" checked="checked" class="dropdown-filter-menu-item item" data-column="0" data-index="0">
         bootstrap-show-password
       </label>
       <label class="dropdown-item">
        <input type="checkbox" value="bootstrap-table" checked="checked" class="dropdown-filter-menu-item item" data-column="0" data-index="0"> 
          bootstrap-table
        </label>
        <label class="dropdown-item">
          <input type="checkbox" value="multiple-select" checked="checked" class="dropdown-filter-menu-item item" data-column="0" data-index="0"> 
          multiple-select
        </label>
        <label class="dropdown-item">
          <input type="checkbox" value="scutech-redmine" checked="checked" class="dropdown-filter-menu-item item" data-column="0" data-index="0"> 
          scutech-redmine
        </label>
      </div>
    </div>
</div>
<!--Dropdown primary-->
 <div class="dropdown">

     <!--Trigger-->
     <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>


     <!--Menu-->
   <!--   <div class="dropdown-menu dropdown-primary">
         <a class="dropdown-item" href="#">Action</a>
         <a class="dropdown-item" href="#">Another action</a>
         <a class="dropdown-item" href="#">Something else here</a>
         <a class="dropdown-item" href="#">Something else here</a>
      </div> -->

   <div class="dropdown-menu">
    <div>
      <label class="dropdown-item">
        <input type="checkbox"  value="0" > №
      </label>
      <label class="dropdown-item">
        <input type="checkbox" data-field="name" value="1" checked="checked"> ФИО клиента
      </label>
      <label class="dropdown-item">
        <input type="checkbox" data-field="phone" value="2" checked="checked"> Телефон
      </label>
    </div>
    </div>
 </div>
 <!--/Dropdown primary-->

    <div class="container-fluid">
<div id="filter-bar"></div>
    <table id="table"  data-toolbar="#filter-bar" 
    data-show-toggle="true" data-show-columns="true" data-show-filter="true" data-search="true">
      <thead>
      <tr>
        <th data-field="name" class="excel-filter">Name</th>
        <th data-field="stargazers_count" >Stars</th>
        <th data-field="forks_count" class="excel-filter">Forks</th>
        <th data-field="description">Description</th>
      </tr>
      </thead>
    </table>
    
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
  <script src="lib/bootstrap-table-filter-master/src/bootstrap-table-filter.js"></script>
        <script src="lib/bootstrap-table-master/src/extensions/filter/bootstrap-table-filter.js"></script>
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



    <script src="js/spin.min.js"></script>
    <script src="js/extensions.js"></script>
    <script type="text/javascript">
    var data = [
    {
      "name": "bootstrap-table",
      "stargazers_count": "526",
      "forks_count": "122",
      "description": "An extended Bootstrap table with radio, checkbox, sort, pagination, and other added features. (supports twitter bootstrap v2 and v3) ",
      'id':5
    },
    {
      "name": "multiple-select",
      "stargazers_count": "288",
      "forks_count": "150",
      "description": "A jQuery plugin to select multiple elements with checkboxes :)",
      'id':4
    },
    {
      "name": "bootstrap-show-password",
      "stargazers_count": "32",
      "forks_count": "11",
      "description": "Show/hide password plugin for twitter bootstrap.",
      'id':3
    },
    {
      "name": "blog",
      "stargazers_count": "13",
      "forks_count": "4",
      "description": "my blog",
      'id':2
    },
    {
      "name": "scutech-redmine",
      "stargazers_count": "6",
      "forks_count": "3",
      "description": "Redmine notification tools for chrome extension.",
      'id':1
    }
  ];
    
    $(function() {
      $('#table').bootstrapTable({data: data});
       $('#table').excelTableFilter();
    });
    </script>
<script>
</script>
</body> 
</html>
