<div stepindex="0">
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">
        <?php echo step[0]?>
      </h5>
      <p class="card-text">
        <?php require_once '../bundles.php';
          if (isset($GLOBALS['PAGE'])){
            $page = $GLOBALS['PAGE'];
            echo hello[getPage($page)];
          }
         ?>
      </p>
    </div>
  </div>
  <div class="mt-4 ml-2">
    <div class="row justify-content-center">
      <label for="age" >
        <?php echo anketa['age']?>
      </label>
    </div>
    <div class="row justify-content-center">
      <div  data-toggle="buttons">
        <label class="btn btn-primary">
          <input type="radio" required name="age" value="true" autocomplete="off" >Да
        </label>
        <label class="btn btn-outline-primary waves-effect">
          <input type="radio" required name="age" value="false" autocomplete="off">Нет
        </label>
      </div>
    </div>
  </div>
</div>
