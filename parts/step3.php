<div stepindex="3" class="divHide">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">
          <?php echo step[3]?>
        </h5>
    </div>
  </div>
  <div class="mt-4 ml-2">
    <div class="row justify-content-left">
     <label for="change_name"><?php echo anketa['change_name']?></label>
   </div>
   <div class="row justify-content-left">
     <div class="switch">
       <label for="change_name">
          Нет
          <input id="change_name" name="change_name" type="checkbox">
          <span class="lever"></span>
          Да
      </label>
      </div>
    </div>
    <div def="change_name">
      <div class="md-form ">
        <input type="text" id="old_name" name="old_name" required class="form-control validate">
        <label for="old_name" data-error="<?php echo error["all"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['old_name']?></label>
      </div>
    </div>
  </div>
</div>
