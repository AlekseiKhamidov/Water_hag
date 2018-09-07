<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Анкета
      <?php require_once '../bundles.php';
      if (isset($GLOBALS['PAGE'])){
        $page = $GLOBALS['PAGE'];
        echo  main[$page]['name'];
      }
     ?>
  </title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/mdb.min.css" rel="stylesheet">
  <link href="../css/compiled.min.css" rel="stylesheet">
  <style type="text/css">
    .md-form label{
      width: 100%!important;
    }
    .form-gradient .header {
      border-top-left-radius: .3rem;
      border-top-right-radius: .3rem;
    }
    .form-gradient input[type=text]:focus:not([readonly]) {
      border-bottom: 1px solid #fd9267;
      -webkit-box-shadow: 0 1px 0 0 #fd9267;
      box-shadow: 0 1px 0 0 #fd9267;
    }
    .form-gradient input[type=text]:focus:not([readonly]) + label {
      color: #4f4f4f;
    }
    .form-gradient input[type=password]:focus:not([readonly]) {
      border-bottom: 1px solid #fd9267;
      -webkit-box-shadow: 0 1px 0 0 #fd9267;
      box-shadow: 0 1px 0 0 #fd9267;
    }
    .form-gradient input[type=password]:focus:not([readonly]) + label {
      color: #4f4f4f;
    }
    .picker__footer{
        display: none!important
    }
  	.divHide{
  		display: none;
  	}
  </style>
</head>
