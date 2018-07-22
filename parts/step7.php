<div stepindex="7" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px">
        <?php echo step[7]?>
      </h5>
    </div>
  </div>
  <div class="mt-4 ml-2">
    <div class="row justify-content-left">
      <label for="address_same" ><?php echo anketa['address_same']?></label>
    </div>
    <div class="row justify-content-left">
      <div class="switch">
        <label for="address_same">
          Нет
          <input id="address_same" name="address_same" checked type="checkbox">
          <span class="lever"></span>
          Да
        </label>
      </div>
    </div>
    <div def="address_same">
      <div class="md-form ">
        <input type="text" id="city_loc" name="city_loc" required class="form-control validate">
        <label for="city_loc" data-error="<?php echo error["all"]?>"
          data-success="<?php echo success["all"]?>"><?php echo anketa['city_loc']?></label>
      </div>
      <div class="md-form ">
        <input type="text" id="street_loc" name="street_loc" required class="form-control validate">
        <label for="street_loc" data-error="<?php echo error["all"]?>"
          data-success="<?php echo success["all"]?>"><?php echo anketa['street_loc']?></label>
      </div>
      <div class="md-form ">
        <input type="text" id="house_loc" name="house_loc" required class="form-control validate">
        <label for="house_loc" data-error="<?php echo error["all"]?>"
          data-success="<?php echo success["all"]?>"><?php echo anketa['house_loc']?></label>
      </div>
      <div class="md-form ">
        <input type="number" id="flat_loc" min="0" step="1" name="flat_loc" class="form-control validate">
        <label for="flat_loc" data-error="<?php echo error["all"]?>"
          data-success="<?php echo success["all"]?>"><?php echo anketa['flat_loc']?></label>
      </div>
    </div>
  </div>
</div>
