var status = "add";
$('#userModal').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this)
  var data = null;
  var default_active = false;
  clearValidate($("#formReg"));
  if (recipient) {
    data = $("#table").bootstrapTable('getData').find(x => x.user_id === recipient.toString());
    modal.find('.modal-title').text("Редактирование пользователя " + data["user_login"])
    $("#deleteButton").show();
    status = "edit";
  } else {
    modal.find('.modal-title').text('Регистрация нового пользователя');
    $("#deleteButton").hide();
    status = "add";
    default_active = true;
  }
  fillDataEdit(data, 'user_login', 'text');
  fillDataEdit(data, 'partner_id', 'select');
  fillDataEdit(data, 'is_admin', 'checkbox');
  fillDataEdit(data, 'leasing', 'checkbox');
  fillDataEdit(data, 'active', 'checkbox', default_active);
  fillDataEdit(data, 'user_id', 'text');
  fillDataEdit(data, 'password', 'text');
  fillDataEdit(data, 'confirm', 'text');
});

function validateSubmit($form) {
  let formValid = true;
  $inputs = $form.find("[required]");
  $inputs.each(function() {
    if (this.checkValidity()) {
      $(this).addClass('valid').removeClass('invalid');
      $(this).siblings("label").addClass("active");
      if ($(this).is("select")) {
        $('input.select-dropdown').addClass('valid').removeClass('invalid');
      }
    } else {
      $(this).addClass('invalid').removeClass('valid');
      $(this).siblings("label").addClass("active");
      if ($(this).is("select")) {
        $('input.select-dropdown').addClass('invalid').removeClass('valid');
      }
      formValid = false;
    }
  });
  if (formValid) {
    return true;
  };
  return false;
};

function fillDataEdit(data, id, type, val) {
  switch (type) {
    case 'text':
      if (data) {
        $("#" + id).val(data[id]);
        $("[for='" + id + "']").addClass("active");
      } else {
        $("#" + id).val("");
      }
      break;
    case 'checkbox':
      if (data) {
        $("#" + id).prop("checked", data[id] == '1');
      } else {
        if (val){
          $("#" + id).prop("checked", true);
        }
        else
        $("#" + id).prop("checked", false);
      }
      break;
    case 'select':
      if (data) {
        if (data.partner_id == "0" ) {
          clearSelect();
          $(".select-dropdown").prop("disabled", true);
          $("#partner_id").prop("required", false);
        } else {
          var text = $("#" + id + " option[value='" + data[id] + "'").text();
          $('.select-dropdown li span:contains(' + text + ')').parent().trigger('click')
          $("#partner_id").prop("required", true);
          $(".select-dropdown").prop("disabled", false);
        }
        $("#changePass").show();
        $("[for='changePass']").show();
        $("#changePass").prop("checked", false)
        $("#divPass").hide();
        $("#password").prop("required", false);
        $("#confirm").prop("required", false);

      } else {
        clearSelect();
        $("#changePass").hide();
        $("[for='changePass']").hide();
        $("#divPass").show();
          $("#partner_id").prop("required", true);
        $('#confirm').unbind("change").change(checkPassword);
        $('#password').unbind("change").change(checkPassword);
        $("#password").prop("required", true);
        $("#confirm").prop("required", true);
      }
      break;
  }
}

$('#user_login').unbind("change").change(function(event) {
  minlength = parseInt($(this).attr("minlength"));
  if ($(this).val().length < minlength) {
    validate($(this), false, "Логин должен быть не меньше 3-х символов и не больше 30");
  } else {
    validate($(this), true);
  }
  $(this).val($(this).val().replace(/\W/g, ''));
  var n = $(this).val().search(/\W/g);
  if (n > -1) {
    validate($(this), false, "Логин может состоять только из букв английского алфавита и цифр");
    return false;
  }
});

$("#is_admin").unbind("change").change(function() {
  if ($(this).is(':checked')) {
    clearSelect();
    $(".select-dropdown").prop("disabled", true);
    $("#partner_id").prop("required", false);
  } else {
    $(".select-dropdown").prop("disabled", false);
    $("#partner_id").prop("required", true);
  }
});

function clearSelect() {
  $('.mdb-select').material_select('destroy');
  $("#partner_id").val("")
  $('.mdb-select').material_select();
}

$("#changePass").unbind("change").change(function(e) {
  if ($(this).prop("checked")) {
    $("#divPass").fadeIn();
    $('#confirm').unbind("change").change(checkPassword);
    $('#password').unbind("change").change(checkPassword);
    $("#password").prop("required", true);
    $("#confirm").prop("required", true);
  } else {
    $("#divPass").fadeOut();
    $('#confirm').unbind("change")
    $('#password').unbind("change")
    $("#password").prop("required", false);
    $("#confirm").prop("required", false);
  }
});

function clearValidate($form) {
  $inputs = $form.find("input, select, button, textarea");
  $inputs.each(function() {
    $(this).removeClass('valid').removeClass('invalid');
    $(this).siblings("label").removeClass("active");
  });
}

function checkPassword() {
  if (status == "edit" && !$("#changePass").prop("checked")) return true;
  var pass = $("#password").val();
  var pass_rep = $("#confirm").val();
  if (pass_rep == "") return 0;
  if (pass != pass_rep) {
    validate($("#confirm"), false);
    validate($("#password"), false);
    return false;
  } else {
    validate($("#password"), true);
    validate($("#confirm"), true);
    return true;
  }
};

function validate($this, isValid, text = null) {
  if (isValid) {
    $this.addClass('valid').removeClass('invalid');
    if (text) {
      $this.siblings("label").attr("data-success", text);
    }
    $this.siblings("label").addClass("active");
  }
  else {
    $this.addClass('invalid').removeClass('valid');
    if (text) {
      $this.siblings("label").attr("data-error", text);
    }
    $this.siblings("label").addClass("active");
  }
  return true;
};
