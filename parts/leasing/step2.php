<div stepindex="2" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px"><?php echo step["2_leasing"]?></h5>
    </div>
  </div>
    <div class="md-form ">
        <input type="text" id="name" name="name" required class="form-control validate">
        <label for="name" data-error="<?php echo error["friend_name"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['friend_name']?></label>
    </div>
    <div class="md-form">
      <input type="tel" id="phone" name="phone" required class="form-control validate phoneMask" value="+7"  >
      <label for="phone" data-error="<?php echo error["friend_phone"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['friend_phone']?></label>
    </div>
    <div class="md-form ">
        <input type="text" id="manager" name="manager" class="form-control validate">
        <label for="manager" data-error="<?php echo error["manager"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['manager']?></label>
    </div>
</div>
