<div stepindex="6" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px">
        <?php echo step[6]?>
      </h5>
    </div>
  </div>
  <div class="md-form ">
    <input type="text" id="city" name="city" required class="form-control validate">
    <label for="city" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['city']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="street" name="street" required class="form-control validate">
    <label for="street" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['street']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="house" name="house" required class="form-control validate">
    <label for="house" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['house']?></label>
  </div>
  <div class="md-form ">
    <input type="number" id="flat" min="0" step="1" name="flat" class="form-control validate">
    <label for="flat" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['flat']?></label>
  </div>
</div>
