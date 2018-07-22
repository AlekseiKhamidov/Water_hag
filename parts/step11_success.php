<div stepindex="11" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title"><?php echo step[11]["title"]?></h5>
      <p class="card-text">
        <?php require_once '../bundles.php';
          if (isset($GLOBALS['PAGE'])){
            $page = $GLOBALS['PAGE'];
            switch ($page) {
              case 'like':
                echo  step[11]["like"];
                break;
              default:
                echo step[11]["all"];
                break;
            }
          }
         ?>
      </p>
    </div>
  </div>
  <div class="row justify-content-center md-form">
    <button type="button"  dir="reload" class="btn btn-primary">
      <?php echo button['reload']?>
    </button>
  </div>
</div>
