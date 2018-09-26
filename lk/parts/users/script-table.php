$('.mdb-select').material_select();
var $table = $('#table');
function initTable() {
  $table.bootstrapTable({
    url: 'getUsers.php',
    height: setHeight(),
  });
};

$(function() {
  initTable();
});

function deleteUser() {
  var user_id = $("#user_id").val() ? $("#user_id").val() : -1;
  if (user_id != -1) {
    request = $.ajax({
      url: "deleteUser.php",
      type: "post",
      data: {
        user_id: user_id
      }
    });
    request.done(function(response, textStatus, jqXHR) {
      response = JSON.parse(response);
      if (response.status == "success") {
        $("#error").text("");
        $("#error").hide();
        $table.bootstrapTable('refresh');
        $('#modalConfirmDelete').modal('hide')
        $('#userModal').modal('hide')
      }
      if (response.status == "error") {
        $("#error").html(response.message);
        $("#error").show();
      }
    });
    request.fail(function(jqXHR, textStatus, errorThrown) {
      console.error(
        "The following error occurred: " +
        textStatus, errorThrown
      );
      $("#error").text(textStatus, errorThrown);
    });
    request.always(function() {
      $inputs.prop("disabled", false);
      $("#mdb-preloader").hide();
    });
  }
}

function save() {
  var $form = $("#formReg");
  var $inputs = $form.find("input, select, button, textarea");
  let log = validateSubmit($form);
  let pass = checkPassword()
  if (log && pass) {
    $("#mdb-preloader").show();
    var serializedData = $form.serialize();
    $inputs.prop("disabled", true);
    switch (status) {
      case 'add':
        request = $.ajax({
          url: "addUser.php",
          type: "post",
          data: serializedData
        });
        break;
      case "edit":
        request = $.ajax({
          url: "editUser.php",
          type: "post",
          data: serializedData
        });
    };
    request.done(function(response, textStatus, jqXHR) {
      response = JSON.parse(response);
      if (response.status == "success") {
        $("#error").text("");
        $("#error").hide();
        $table.bootstrapTable('refresh');
        $('#userModal').modal('hide')
      }
      if (response.status == "error") {
        $("#error").html(response.message);
        $("#error").show();
      }
    });
    request.fail(function(jqXHR, textStatus, errorThrown) {
      console.error(
        "The following error occurred: " +
        textStatus, errorThrown
      );
      $("#error").text(textStatus, errorThrown);
    });
    request.always(function() {
      $inputs.prop("disabled", false);
      $("#mdb-preloader").hide();
    });
  }
}

function resize() {
  $("#table").bootstrapTable('resetView', {
    height: setHeight()
  });
}

function setHeight() {
  var height = 0;
  height += $('.navbar.fixed-top').outerHeight();
  height += $('#toolbar').outerHeight();
  return window.innerHeight - height;
}

$(window).resize(function() {
  resize();
})
