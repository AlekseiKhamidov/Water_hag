<div stepindex="4" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px">
        <?php echo step[4]?>
      </h5>
    </div>
  </div>
  <div class="mt-4 ml-2">
    <div class="row justify-content-left">
     <label for="is_married" ><?php echo anketa['is_married']?></label>
    </div>
    <div class="row justify-content-left">
      <div class="switch">
        <label for="is_married">
          Нет
          <input id="is_married" name="is_married" type="checkbox">
          <span class="lever"></span>
          Да
        </label>
      </div>
    </div>
    <div def="is_married">
       <div class="md-form ">
          <input type="text" id="spouse_name" name="spouse_name" required class="form-control validate">
          <label for="spouse_name" data-error="<?php echo error["all"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['spouse_name']?></label>
      </div>
      <div class="md-form ">
          <input type="text" id="spouse_birth" name="spouse_birth" required class="form-control validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
          <label for="spouse_birth" data-error="<?php echo error["spouse_birth"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['spouse_birth']?></label>
      </div>
    </div>
  </div>
</div>
