<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <div class="modal-content text-center">
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Вы уверены, что хотите удалить пользователя?</p>
      </div>
      <div class="modal-body">
        <i class="fa fa-times fa-4x animated rotateIn"></i>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn  btn-outline-danger" data-dismiss="modal">Нет</button>
        <button type="button" id="deleteButton" onclick="deleteUser()" class="btn btn-danger">Да</button>
      </div>
    </div>
  </div>
</div>
