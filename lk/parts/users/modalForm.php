<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formReg" class="mb-0">
          <div style='display:none;'>
            <input type="text" id="user_id" name="user_id">
          </div>
          <div class="md-form mt-2">
            <input type="text" id="user_login" name="user_login" required class="form-control validate" minlength="3" maxlength="30">
            <label for="user_login">Логин*</label>
          </div>
          <div class="form-check md-form mt-4">
            <input class="form-check-input filled-in" type="checkbox" id="is_admin" name="is_admin">
            <label for="is_admin">Администратор</label>
          </div>
          <div class="md-form mt-4 mb-1">
            <select id="partner_id" name="partner_id" required class="mdb-select">
              <option value="" disabled selected></option>
                <?php
                  require_once 'amoconn.php';
                    require_once "../config.php";
                  $data = getLeadCustomFieldEnums(AMO_CFID_PARTNER);
                  foreach ($data as $key => $value) {
                    echo "<option value=".$key.">$value</option>";
                  }
                ?>
            </select>
            <label for="partner_id">Принадлежит организации-партнеру</label>
          </div>
          <div class="form-check md-form mb-1 mt-1">
            <input class="form-check-input filled-in" type="checkbox" id="leasing" name="leasing">
            <label for="leasing">Лизинг</label>
          </div>
          <div class="form-check md-form mb-1 mt-1">
            <input class="form-check-input filled-in" type="checkbox" id="active" name="active">
            <label for="active">Активный пользователь</label>
          </div>
          <div class="form-check md-form mb-1 mt-1">
            <input class="form-check-input filled-in" type="checkbox" id="changePass" name="changePass">
            <label for="changePass">Изменить пароль</label>
            <div id="divPass" style="display:none;">
              <div class="md-form mt-4">
                <input type="password" id="password" name="password" class="form-control ">
                <label for="password">Пароль*</label>
              </div>
              <div class="md-form mt-4">
                <input type="password" id="confirm" name="confirm" class="form-control ">
                <label for="confirm" data-error="Пароли не совпадают" data-success="Пароли совпадают">Повторите пароль*</label>
              </div>
            </div>
          </div>
          <div class="text-center mt-4">
            <p id="error" class="red-text"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <div>
          <button type="button" id="deleteButton" data-toggle="modal" data-target="#modalConfirmDelete" class="btn btn-elegant">Удалить</button>
        </div>
        <div>
          <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Закрыть</button>
          <button type="button" onclick="save()" class="btn btn-primary">Сохранить</button>
        </div>
      </div>
    </div>
  </div>
</div>
