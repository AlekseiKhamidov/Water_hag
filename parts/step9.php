<div stepindex="9" class="divHide">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title" style="margin-bottom: 0px">
        <?php echo step[9]?>
      </h5>
    </div>
  </div>
  <div class="mt-5 ml-2">
    <div class="row justify-content-left">
      <label for="photo_passport" data-error="<?php echo error["all"]?>"
        data-success="<?php echo success["all"]?>"><?php echo anketa['photo_passport']?></label>
    </div>
  </div>
  <div class="row justify-content-left">
    <div class="md-form" style="margin-top: 0rem;">
      <div class="file-field">
        <div class="btn btn-primary btn-sm float-left">
          <span>
            <?php echo file["text"]?>
          </span>
          <input required id="photo_passport" name="photo_passport" type="file" data-error="<?php echo error["photo_passport"]?>"
          accept='<?php echo file["accept"]["photo_passport"]?>' pipeline="poscredit">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate readonly"  name="photo_passport_text" type="text" required >
          <label for="photo_passport_text" data-error="<?php echo error["photo_passport"]?>"
            data-success="<?php echo success["all"]?>" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-5 ml-2">
    <div class="row justify-content-left">
      <label for="photo_passport_reg"><?php echo anketa['photo_passport_reg']?></label>
    </div>
 </div>
 <div class="row justify-content-left">
   <div class="md-form" style="margin-top: 0rem;">
     <div class="file-field">
       <div class="btn btn-primary btn-sm float-left">
         <span>
           <?php echo file["text"]?>
         </span>
         <input type="file" required id="photo_passport_reg" name="photo_passport_reg" data-error="<?php echo error["photo_passport"]?>"
         accept='<?php echo file["accept"]["photo_passport"]?>' pipeline="poscredit">
       </div>
       <div class="file-path-wrapper">
         <input class="file-path validate readonly"  name="photo_passport_reg_text" type="text" required  >
         <label for="photo_passport_reg_text" data-error="<?php echo error["photo_passport_reg"]?>"
           data-success="<?php echo success["all"]?>" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
       </div>
     </div>
   </div>
 </div>
 <div class="mt-5 ml-2">
   <div class="row justify-content-left">
     <label for="photo_selfi"><?php echo anketa['photo_selfi']?></label>
   </div>
 </div>
  <div class="row justify-content-left">
    <div class="md-form" style="margin-top: 0rem;">
      <div class="file-field">
        <div class="btn btn-primary btn-sm float-left">
          <span>
            <?php echo file["text"]?>
          </span>
          <input type="file" required id="photo_selfi" name="photo_selfi" data-error="<?php echo error["photo_passport"]?>"
          accept='<?php echo file["accept"]["photo_passport"]?>' pipeline="poscredit">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate readonly"  name="photo_selfi_text" type="text" required  ="">
          <label for="photo_selfi_text" data-error="<?php echo error["photo_selfi"]?>"
            data-success="<?php echo success["all"]?>" class="active"
            style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        </div>
      </div>
    </div>
  </div>
</div>
