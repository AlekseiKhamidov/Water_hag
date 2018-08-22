<php
?>
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
	
<script>
	var $table = $('#tableUsers');
	 function initTable() {
      $table.bootstrapTable({
        height: getHeight(),
      });

     
    }
     $(function() {
      initTable();
     
    });


</script>
</body>      
</html>