var branch =<?php require_once '../bundles.php';
  if (isset($GLOBALS['PAGE'])){
    $page = $GLOBALS['PAGE'];
    echo main[$page]["branch"];
  }
 ?>;
 var partnerName = '<?php require_once '../bundles.php';
    if (isset($GLOBALS['PAGE'])){
      $page = $GLOBALS['PAGE'];
      echo main[$page]['name'];
    }?>';
var partner = <?php require_once '../bundles.php';
  if (isset($GLOBALS['PAGE'])){
    $page = $GLOBALS['PAGE'];
    echo main[$page]['id'];
  }?>;
var pipeline = '<?php require_once '../bundles.php';
  if (isset($GLOBALS['PAGE'])){
    $page = $GLOBALS['PAGE'];
    echo main[$page]['pipeline'];
  }?>';
  //"pos-credit";
 var group = <?php require_once '../bundles.php';
   if (isset($GLOBALS['PAGE'])){
     $page = $GLOBALS['PAGE'];
     echo main[$page]['group'];
   }?>;
$(".readonly").on('keydown paste', function(e){
  e.preventDefault();
});
