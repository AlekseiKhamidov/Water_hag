<div stepindex="5" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px"><?php echo step[5]["title"]?></h5>
      <p class="card-text"><?php echo step[5]["text"]?></p>
    </div>
  </div>
  <?php require_once '../bundles.php';
    if (isset($GLOBALS['PAGE'])){
      $page = $GLOBALS['PAGE'];
      $friendCount = main[$page]['friendCount'];
    if ($friendCount == 1) { ?>

    <div class="md-form ">
        <input type="text" id="friend_name" name="friend_name" required class="form-control validate">
        <label for="friend_name" data-error="<?php echo error["friend_name"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['friend_name']?></label>
    </div>
    <div class="md-form">
      <input type="tel" id="friend_phone" name="friend_phone" required class="form-control validate phoneMask" value="+7"  >
      <label for="friend_phone" data-error="<?php echo error["friend_phone"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['friend_phone']?></label>
    </div>

  <?php
} else {?>

  <div class="md-form ">
    <input type="text" id="friend_name1" name="friend_name1" required class="form-control validate">
    <label for="friend_name1" data-error="<?php echo error["friend_name1"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['friend_name1']?></label>
  </div>
  <div class="md-form">
    <input type="tel" id="friend_phone1" name="friend_phone1" required class="form-control validate phoneMask" value="+7"  >
    <label for="friend_phone1" data-error="<?php echo error["friend_phone1"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['friend_phone1']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="friend_name2" name="friend_name2" required class="form-control validate">
    <label for="friend_name2" data-error="<?php echo error["friend_name2"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['friend_name2']?></label>
  </div>
  <div class="md-form">
    <input type="tel" id="friend_phone2" name="friend_phone2" required class="form-control validate phoneMask" value="+7"  >
    <label for="friend_phone2" data-error="<?php echo error["friend_phone2"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['friend_phone2']?></label>
  </div>

<?php }}  ?>
</div>
