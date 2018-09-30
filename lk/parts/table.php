<div class="container-fluid">
  <div class=" mt-5 ml-4 mr-4 pt-4">
    <div id="toolbar">
      <button class="btn btn-primary " data-toggle="modal" onclick="analyze()" data-target="#chartModal"><i class="fa fa-bar-chart"></i> Диаграммы</button>
      <div class="btn-group">
        <input type="text" id="start" required name="start" class="dateType validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2">по</span>
        </div>
        <input type="text" id="end" name="end" class="dateType validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
      </div>
      <div class="inline ml-3">
        <h5 >Количество заявок: <span id="totalCount" class="badge badge-primary"></span></h5>
     </div>
    </div>
    <table id="table" class="exampleTable table table-hover table-striped"
     data-toolbar="#toolbar"
     data-show-export="true"
     data-show-columns="true"
     data-filter-control="true"
     data-check-on-init="true"
     data-filter-show-clear="true"
     data-export-types="['excel']">
     <thead>
       <tr>
         <?php if ($userdata['user_login'] == 'admin') echo '
         <th data-field="source" class="managerCell excel-filter" data-sortable="true" data-formatter="textFormat" data-search-formatter="textFormat" >Источник</th>
         ' ?>
         <th data-field="contact_name" class="fio" data-filter-control="input">ФИО клиента</th>
         <th data-field="contact_phone" class="contact" data-formatter="textFormat" data-filter-control="input">Телефон</th>
         <th data-field="created_at" class="dateTo" data-sortable="true" data-sorter="dateSorter" data-formatter="dateFormat">Дата создания</th>
          <?php if ($userdata['user_login'] != 'admin') echo '
          <th data-field="manager" class="managerCell excel-filter" data-sortable="true" >Менеджер '.$userdata['user_login'].'</th>
          <th data-field="chief" class="managerCell excel-filter" data-formatter="textFormat" data-search-formatter="textFormat"  data-sortable="true" >РОП</th>
          ' ?>
         <th data-field="price" class="sumCell" data-align="right" data-sortable="true" data-formatter="priceFormatter">Сумма</th>
         <th data-field="status" class="typeCell excel-filter" data-align="center" data-sortable="true" data-formatter="roundButtonFormatter" data-search-formatter="statusFormatterSelect">Этап воронки</th>
         <th data-field="note_text" >Примечание</th>
       </tr>
     </thead>
   </table>
   <div id="ulContainer"></div>
</div>

</div>
