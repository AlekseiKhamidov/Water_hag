<div stepindex="1" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px">
        <?php
          require_once '../bundles.php';
          if (isset($GLOBALS['PAGE'])){
            $page = $GLOBALS['PAGE'];
            $type = type[$page];
            echo  step[1][$type];
          }  ?>
      </h5>
    </div>
  </div>
  <div class="md-form ">
    <input type="text" id="course" name="course" required class="form-control validate">
    <label for="course" data-error="<?php
        require_once '../bundles.php';
        if (isset($GLOBALS['PAGE'])){
          $page = $GLOBALS['PAGE'];
          $type = type[$page];
          echo  error["course"][$type];
        }
       ?>"  data-success="<?php echo success["all"]?>"><?php
        require_once '../bundles.php';
        if (isset($GLOBALS['PAGE'])){
          $page = $GLOBALS['PAGE'];
          $type = type[$page];
          echo  anketa["course"][$type];
        }  ?></label>
  </div>
  <?php  if (isset($GLOBALS['PAGE'])){
      $page = $GLOBALS['PAGE'];
      $type = type[$page];
      if ($page == "like") { ?>
        <div class="md-form ">
            <input type="text" id="city_like" name="city_like" required class="form-control validate">
            <label for="city_like" data-error="<?php echo error["all"]?>"
              data-success="<?php echo success["all"]?>"><?php echo anketa["city_like"]?></label>
        </div>
    <?php  }}  ?>
  <div class="md-form ">
    <i class="fa fa-rub prefix grey-text"></i>
    <input type="text" min="0"  id="price" name="price" required class="form-control validate currency"/>
    <label for="price" data-error="<?php require_once '../bundles.php';
     if (isset($GLOBALS['PAGE'])){
        $page = $GLOBALS['PAGE'];
        $type = type[$page];
        echo  error["price"][$type];
      }
     ?>"  data-success=
     "<?php echo success["all"]?>"><?php
      require_once '../bundles.php';
      if (isset($GLOBALS['PAGE'])){
        $page = $GLOBALS['PAGE'];
        $type = type[$page];
        echo  anketa["price"][$type];
      }
    ?></label>
  </div>
  <?php  if (isset($GLOBALS['PAGE'])){
      $page = $GLOBALS['PAGE'];
      $type = type[$page];
      if ($page != "like") { ?>
  <div class="md-form ">
    <input type="number" min="6" max="36"  id="credit_term" name="credit_term" required class="form-control validate"/>
    <label for="credit_term" data-error="<?php echo error["credit_term"]?>"  data-success="<?php echo success["all"]?>"
      ><?php echo anketa['credit_term']?></label>
  </div>
  <?php  }}  ?>
</div>
