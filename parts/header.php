<div class="header blue-gradient">
  <div class="row d-flex justify-content-center">
    <h3 class="white-text mb-3 pt-3 font-weight-bold" style="text-align: center;">
      <?php require_once '../bundles.php';
      if (isset($GLOBALS['PAGE'])){
        $page = $GLOBALS['PAGE'];
        echo title[$page];
      }
      ?>
    </h3>
  </div>
</div>
