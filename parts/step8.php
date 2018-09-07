<div stepindex="8" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px"><?php echo step[8]["title"]?></h5>
      <p class="card-text"><?php echo step[8]["text"]?></p>
    </div>
  </div>
  <div class="md-form ">
    <input type="text" id="work_name" name="work_name" required class="form-control validate">
    <label for="work_name" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['work_name']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="city_work" name="city_work" required class="form-control validate">
    <label for="city_work" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['city_work']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="street_work" name="street_work" required class="form-control validate">
    <label for="street_work" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['street_work']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="house_work" name="house_work" required class="form-control validate">
    <label for="house_work" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['house_work']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="flat_work" name="flat_work"  class="form-control validate">
    <label for="flat_work" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['flat_work']?></label>
  </div>
  <?php  if (isset($GLOBALS['PAGE'])){
      $page = $GLOBALS['PAGE'];
    //  $type =  main[$page]['type'];
       if ($page == "oyli" || $page == "voronin.systems") { ?>
        <div class="md-form ">
          <input type="text" id="site_work" name="site_work" class="form-control validate">
          <label for="site_work" data-error="<?php echo error["all"]?>"
            data-success="<?php echo success["all"]?>"><?php echo anketa['site_work']?></label>
        </div>
  <?php  }}  ?>
  <div class="md-form">
    <input type="tel" id="phone_work" name="phone_work" required class="form-control validate phoneMask" value="+7"  >
    <label for="phone_work" data-error="<?php echo error["phone_work"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['phone_work']?></label>
  </div>
  <div class="md-form ">
    <input type="text" id="post_work" name="post_work" required class="form-control validate">
    <label for="post_work" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['post_work']?></label>
  </div>
  <div class="md-form ">
    <input type="number" min="0" step="1"  id="count_work" name="count_work" required class="form-control validate"/>
    <label for="count_work" data-error="<?php echo error["count_work"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['count_work']?></label>
  </div>
  <div class="md-form ">
    <i class="fa fa-rub prefix grey-text"></i>
    <input type="text" min="0"  id="income_work" name="income_work" required class="form-control validate currency"/>
    <label for="income_work" data-error="<?php echo error["all"]?>"
      data-success="<?php echo success["all"]?>"><?php echo anketa['income_work']?></label>
  </div>
</div>
