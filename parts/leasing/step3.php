<div stepindex="3">
   <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">  <?php echo step[9]?></h5>
    </div>
  </div>
    <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="commercial" data-error="<?php echo error["all"]?>"
             data-success="<?php echo success["all"]?>"><?php echo anketa['commercial']?></label>
         </div>
     </div>
    <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">
            <div class="file-field">

                <div class="btn btn-primary btn-sm float-left">
                    <span><?php echo file["text"]?></span>
                    <input required id="commercial" name="commercial" type="file" number="0" pipeline="leasing"
                    accept='<?php echo file["accept"]["commercial"]?>' data-error="<?php echo error["commercial"]?>">
                </div>

                <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="commercial_text" type="text" required >
                    <!-- <input class="file-path validate" id="tmp" type="text" required  readonly> -->
                    <label for="commercial_text" data-error="<?php echo error["commercial"]?>"
                      data-success="<?php echo success["all"]?>" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>
        </div>
    </div>
   <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="info_card"><?php echo anketa['info_card']?></label>
         </div>
     </div>
   <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">

            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span><?php echo file["text"]?></span>
                    <input type="file" required id="info_card" name="info_card" number="1"
                    accept='<?php echo file["accept"]["info_card"]?>' data-error="<?php echo error["info_card"]?>">

                </div>
                  <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="info_card_text" type="text" required  >
                    <label for="info_card_text" data-error="<?php echo error["info_card"]?>"
                      data-success="<?php echo success["all"]?>" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>

        </div>
    </div>
   <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="statement"><?php echo anketa['statement']?></label>
         </div>
     </div>
    <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">

            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span><?php echo file["text"]?></span>
                    <input type="file" required id="statement" name="statement" number="2" data-error="<?php echo error["info_card"]?>"
                    accept='<?php echo file["accept"]["statement"]?>'>
                </div>
                <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="statement_text" type="text" required>
                    <label for="statement_text" data-error="<?php echo error["statement"]?>"
                      data-success="<?php echo success["all"]?>" class="active"
                      style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>
        </div>
    </div>
    <div class="md-form">
    <textarea type="text" id="comment" class="form-control md-textarea" rows="2"></textarea>
    <label for="comment"><?php echo anketa['comment']?></label>
</div>
</div>
