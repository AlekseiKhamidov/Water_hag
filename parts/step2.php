<div stepindex="2" class="divHide">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">
          <?php echo step[2]?>
        </h5>
    </div>
  </div>
  <div class="md-form ">
      <input type="text" id="name" name="name" required class="form-control validate">
      <label for="name" data-error="<?php echo error["all"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['name']?></label>
  </div>
  <div class="md-form ">
    <select name="education" id="education" required class="mdb-select validate">
      <option value="" disabled selected></option>
      <option value="<?php echo anketa['education']['select'][0]?>">
          <?php echo anketa['education']['select'][0]?>
      </option>
      <option value="<?php echo anketa['education']['select'][1]?>">
        <?php echo anketa['education']['select'][1]?>
      </option>
      <option value="<?php echo anketa['education']['select'][2]?>">
        <?php echo anketa['education']['select'][2]?>
      </option>
      <option value="<?php echo anketa['education']['select'][3]?>">
        <?php echo anketa['education']['select'][3]?>
      </option>
      <option value="<?php echo anketa['education']['select'][4]?>">
        <?php echo anketa['education']['select'][4]?>
      </option>
    </select>
    <label for="education"  data-error="<?php echo error["education"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['education']['label']?></label>
  </div>
  <div class="md-form">
    <input type="tel" id="phone" name="phone" required class="form-control validate phoneMask" value="+7"  >
    <label for="phone" data-error="<?php echo error["phone"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['phone']?></label>
  </div>
  <div class="md-form">
    <input type="email" id="email" name="email" required class="form-control validate">
    <label for="email" data-error="<?php echo error["email"]?>" data-success="<?php echo success["all"]?>"><?php echo anketa['email']?></label>
  </div>
</div>
