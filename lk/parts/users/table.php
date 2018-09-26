<div class=" mt-5 ml-4 mr-4 pt-4">
  <div id="toolbar">
    <button class="btn btn-primary " data-toggle="modal" data-target="#userModal"><i class="fa fa-plus"></i> Добавить пользователя</button>
  </div>
  <table id="table" class="exampleTable table table-hover table-striped" data-toolbar="#toolbar">
    <thead>
      <tr>
        <th data-field="user_id" data-visible='false' data-sortable="true">ID</th>
        <th data-field="user_login" data-formatter="linkFormat">Логин</th>
        <th data-field="active" data-visible='false'>Активный</th>
        <th data-field="leasing" data-align="center" data-formatter="checkFormat">Лизинг</th>
        <th data-field="partner_name">Партнер</th>
        <th data-field="is_admin" data-formatter="checkFormat">Администратор</th>
      </tr>
    </thead>
  </table>
</div>
