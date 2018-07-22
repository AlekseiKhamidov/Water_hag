function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return "_" + s4() + s4();
};

function init_anketa(id, partner, pipeline, group) {
  $(".phoneMask").mask("+7(999) 999-9999");
  $(".datepickerMask").mask("99.99.9999", {
    placeholder: "ДД.ММ.ГГГГ"
  });
  setLog("init");

  function submit() {
     hidePaginator();
    $form = $("#formReg");

    var pdf_array = [];
    var $inputs = $form.find("input, select, textarea");

    for (var i = 0; i < $inputs.length; i++) {
      if ($inputs[i].id != "") {
        var labels = $("[for='" + $inputs[i].id + "']");
        if (labels.length > 0) {
          var pdf_elem = {};
          pdf_elem.id = $inputs[i].id;
          pdf_elem.q = labels[0].textContent.replace("*", "");
          if ($inputs[i].type == "checkbox") {
            pdf_elem.a = $inputs[i].checked ? "да" : "нет";
          } else
          if ($inputs[i].type != "file") {
            pdf_elem.a = $inputs[i].value;
          }
          if (pdf_elem.a)
            pdf_array.push(pdf_elem);
        }
      }
    }
    setLog("submit");
    fileUpload(id, $form, pdf_array, partner, pipeline);
  };

  function setLog(info,notField) {
    var client = {
      userAgent: navigator.userAgent,
      os: navigator.platform
    }
    var result = {
      id: id,
      fields: notField?null:$("#formReg").serialize(),
      stepIndex: stepIndex,
      date: new Date(),
      client: JSON.stringify(client),
      info:info
    }
    $.ajax({
      url: '../logger.php',
      data: {
        data: result
      },
      type: 'POST'
    })
  };

  function fileUpload(id, $for, data, partner, pipeline) {
    var file1 = $form.find("input[type='file']")[0].files;
    var file2 = $form.find("input[type='file']")[1].files;
    var file3 = $form.find("input[type='file']")[2].files

    if (!isGoodFileExt(file1[0], 0) || !isGoodFileExt(file2[0], 1) || !isGoodFileExt(file3[0], 2) || !isGoodFileSize(file1[0]) || !isGoodFileSize(file2[0]) || !isGoodFileSize(file3[0])) {
      next(stepDoc);
      return;
    }
    var form_data = new FormData();
    form_data.append('file1', file1[0]);
    form_data.append('file2', file2[0]);
    form_data.append('file3', file3[0]);
    form_data.append('guid', id);
    form_data.append('partner', partner);
    form_data.append('data', JSON.stringify(data));
    form_data.append('pipeline', pipeline);
    form_data.append('group', JSON.stringify(group));




    setLog("fileUpload");

    $("#mdb-preloader").show();
    $.ajax({
      url: '../upload.php',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'POST',
      success: function(response) {
        console.log(response);
        if (response != ""){
          setLog(response);
          next(stepError);
        }
        else {
          next(stepSuccess);
          setLog("success");
        }
      },
      error: function(error) {
        console.log(error);
          next(stepError);
      },
      complete: function() {
        $("#mdb-preloader").hide();
    //    next(stepSuccess);
      }
    })
  };

  function next(newStepIndex) {
    if (validate()) {
      $("[stepindex=" + stepIndex + "]").hide();
      stepIndex++;
      if (newStepIndex != undefined && newStepIndex != null)
        stepIndex = newStepIndex;
      $("[stepindex=" + stepIndex + "]").show();
      setLog("next");
      if (stepIndex == stepAccess) {
         hidePaginator();
      }
    }
  };

  function prev(newStepIndex) {
    if (stepIndex > 0) {
      $("[stepindex=" + stepIndex + "]").hide();
      setLog("prev");
      stepIndex--;
      if (newStepIndex != undefined && newStepIndex != null)
        stepIndex = newStepIndex;
      $("[stepindex=" + stepIndex + "]").show();
      switch (stepIndex) {
        case stepAge:
        case stepAccess:
          $('[stepindex="' + stepIndex + '"] input:radio').each(function() {
            $(this).prop("checked", false);
             hidePaginator();
          });
          break
        default:
          break
      }
    }
  };

  function validate() {
    var formValid = true;
    var $input = $("[stepindex=" + stepIndex + "] [required]:visible, [stepindex=" + stepIndex + "] select");
    $input.each(function() {
      if (this.checkValidity()) {
        $(this).addClass('valid').removeClass('invalid');
        $(this).siblings("label").addClass("active");
      } else {
        $(this).addClass('invalid').removeClass('valid');
        $(this).siblings("label").addClass("active");
        formValid = false;
      }
    })
    if (formValid) {
      return true;
    }
    return false;
  };

  function getExt(name) {
    var mas = name.split('.');
    return (mas.length > 0) ? mas[mas.length - 1] : "";
  };

  function isGoodFileExt(file) {
    var ext = getExt(file.name);
    return (!file || extFile.indexOf(ext) == -1) ? false : true;
  };

  function isGoodFileSize(file) {
    var size = file.size;
    return (!file || size > maxSize) ? false : true;
  };
  var extFile = ["jpg", "jpeg", "gif", "JPG", "JPEG", "GIF"]; //,"png","PNG"];//Только форматы: jpg, jpeg, png или gif
  function fileValid($target, isValid, text) {
    var input = $target.parent().siblings().find("input[type='text']");
    var label = $target.parent().siblings().find("label");
    if (isValid) {
      input.removeClass("invalid").addClass("valid");
      label.addClass("active");
      if (text) {
        label.attr("data-success", text);
      }
    } else {
      input.val("");
      input.removeClass("valid").addClass("invalid");
      label.addClass("active");
      $target.replaceWith($target.val('').clone(true));
      if (text) {
        label.attr("data-error", text);
      }
    }
  };

  $("#friend_name").change(function(e) {
    if ($(e.target).val() == $("#name").val() || $(e.target).val() == $("#spouse_name").val()) {
      //$(e.target).removeClass("valid").addClass("invalid");
      // $(e.target).val("")
      e.target.setCustomValidity("Error");
    } else {
      e.target.setCustomValidity("");
    }
  });
  $("#friend_name1").change(function(e) {
    if ($(e.target).val() == $("#name").val() || $(e.target).val() == $("#spouse_name").val()) {
      //$(e.target).removeClass("valid").addClass("invalid");
      // $(e.target).val("")
      e.target.setCustomValidity("Error");
    } else {
      e.target.setCustomValidity("");
    }
  });
  $("#friend_name2").change(function(e) {
    if ($(e.target).val() == $("#name").val() || $(e.target).val() == $("#spouse_name").val()) {
      //$(e.target).removeClass("valid").addClass("invalid");
      // $(e.target).val("")
      e.target.setCustomValidity("Error");
    } else {
      e.target.setCustomValidity("");
    }
  });

  $(".currency").on('keyup', function() {
    var n = parseInt($(this).val().replace(/\D/g, ''), 10);
    if (isNaN(n)){
      $(this).val("");
    }
    else {
      $(this).val(n.toLocaleString());
    }
  });

  $('input[type="file"]').change(function(e) {

    var file = e.target.files[0];
    if (!isGoodFileExt(file)) {
      fileValid($(e.target), false, "Только форматы: jpg, jpeg или gif");
    } else {
      if (isGoodFileSize(file)) {
        fileValid($(e.target), true);
      } else {
        fileValid($(e.target), false, "Размер файла должен быть меньше " + maxSize / 1000000 + "Мб");
      }
    }

  });
  function showPaginator(){
      $("#paginator").removeClass("divHide");
  };
  function hidePaginator(){
      $("#paginator").addClass("divHide");
  };

  $("input[name='age']").change(function() {
    //  $("[stepindex=0]").hide();
    if ($("input[name='age']:checked").val() == "true") {
      next();
  //    $("#paginator").show();
    showPaginator();

    } else {
      next(stepAgeError);
    //   hidePaginator();
    }
    // Do something interesting here
  });
  $("input[name='is_person']").change(function() {
    //  $("[stepindex=0]").hide();
     hidePaginator();
    if ($("input[name='is_person']:checked").val() == "true") {


      //  next();
      submit(partner, pipeline);

    } else {
      next(stepAccessError);
       hidePaginator();
    }
    // Do something interesting here
  });
  $("input[name='change_name']").change(function() {
    if ($("input[name='change_name']").prop("checked")) {
      //$("input[name='change_name']").val
      $("[def='change_name']").show();
    } else {
      $("[def='change_name']").hide();
    }
    // Do something interesting here
  });
  $("input[name='is_married']").change(function() {
    if ($("input[name='is_married']").prop("checked")) {
      $("[def='is_married']").show();
    } else {
      $("[def='is_married']").hide();
    }
    // Do something interesting here
  });
  $("input[name='address_same']").change(function() {
    if (!$("input[name='address_same']").prop("checked")) {
      $("[def='address_same']").show();
    } else {
      $("[def='address_same']").hide();
    }
    // Do something interesting here
  });

  $("button[dir='prev']").click(function() {
    prev()
  });
  $("[stepindex='" + stepAccessError + "'] [dir='prev']").click(function() {
    prev(stepAccess);
  });
  $("button[dir='allprev']").click(function() {
    prev(stepAge);
  });
  $("button[dir='next']").click(function() {
    next()
  });
  $("button[dir='reload']").click(function() {
    location.reload();
  });
}
