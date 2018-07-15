 function submit(partner) {
    var id = guid();

    $("#paginator").hide();
    $form = $("#formReg");
    // setup some local variables
    // Let select and cache all the fields

    var pdf_array = [];
    var $inputs = $form.find("input, select, textarea");

    for (var i = 0; i < $inputs.length; i++) {
      if ($inputs[i].id != "") {
        var labels = $("[for='"+$inputs[i].id+"']");
        if (labels.length>0) {

       // if ($inputs[i].labels.length > 0) {
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
    // Serialize the data in the form
    var serializedData = $form.serialize();
    console.log(serializedData);
    console.log(pdf_array);
    fileUpload(id, $form, pdf_array,partner);
  };

  function guid() {
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
    };
    return "_" + s4() + s4();
  };
  function reload() {
    location.reload();
  };



  function fileUpload(id, $for, data, partner) {

  //  var form = $("#form_photo_passport");

  var file1 = $form.find("input[type='file']")[0].files;
  var file2 = $form.find("input[type='file']")[1].files;
  var file3 = $form.find("input[type='file']")[2].files

   if (!isGoodFileExt(file1[0], 0) || !isGoodFileExt(file2[0], 1) || !isGoodFileExt(file3[0], 2) || !isGoodFileSize(file1[0]) || !isGoodFileSize(file2[0]) || !isGoodFileSize(file3[0])) {
    next(stepDoc);
    return;
  }
  var form_data = new FormData();
  form_data.append('photo_passport', file1[0]);
  form_data.append('photo_passport_reg', file2[0]);
  form_data.append('photo_selfi', file3[0]);
  form_data.append('guid', id);
  form_data.append('partner', partner);
  form_data.append('data', JSON.stringify(data));


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
    },
    error: function(error) {
      console.log(error);
    },
     complete: function () {
      $("#mdb-preloader").hide();
       next();
                /// How to get here the reference for the newly created asset object?
                /// how to alert(asset)?
      }
  });
};
function next(newStepIndex) {
  if (validate()) {
    $("[stepindex=" + stepIndex + "]").hide();
    stepIndex++;
    if (newStepIndex!= undefined && newStepIndex!= null)
      stepIndex = newStepIndex;
    $("[stepindex=" + stepIndex + "]").show();
    if (stepIndex == stepAccess) {

      $("#paginator").hide();
    }
    /*       $("[stepindex="+stepIndex+"] [dir='next']").click(function(){
         next()
      });
           $("[stepindex="+stepIndex+"] [dir='prev']").click(function(){
         prev()
      });*/
  }
};

function prev(newStepIndex) {
  if (stepIndex > 0) {
    $("[stepindex=" + stepIndex + "]").hide();
    stepIndex--;
    if (newStepIndex!= undefined && newStepIndex!= null)
      stepIndex = newStepIndex;
    $("[stepindex=" + stepIndex + "]").show();
    /*$("[stepindex="+stepIndex+"] [dir='prev']").click(function(){
       prev()
    });
          $("[stepindex="+stepIndex+"] [dir='next']").click(function(){
       next()
    });*/
    switch (stepIndex) {
      case stepAge:
      case stepAccess:
        $('[stepindex="' + stepIndex + '"] input:radio').each(function() {
          $(this).prop("checked", false);
          $("#paginator").hide();
        });
        break
      default:
        break
    }
  }

};

function validate() {
  var formValid = true;
  var $input =  $("[stepindex=" + stepIndex + "] [required]:visible, [stepindex=" + stepIndex + "] select");



  $input.each(function() {
    //найти предков, которые имеют класс .form-group, для установления success/error
    //   var formGroup = $(this).parents('.form-group');
    //для валидации данных используем HTML5 функцию checkValidity
    if (this.checkValidity()) {
      //добавить к formGroup класс .has-success, удалить has-error
      $(this).addClass('valid').removeClass('invalid');
      $(this).siblings("label").addClass("active");
    } else {
      //добавить к formGroup класс .has-error, удалить .has-success
      $(this).addClass('invalid').removeClass('valid');
      $(this).siblings("label").addClass("active");
      //отметить форму как невалидную
      formValid = false;
    }
  });
  if (formValid) {
    return true;
  };
  return false;
};


function getExt(name){
    var mas = name.split('.');
    return (mas.length>0) ? mas[mas.length-1]: "";
  };
  function isGoodFileExt(file){
     var ext = getExt(file.name);
     return (!file || extFile.indexOf(ext) == -1)? false: true;
  };

  function isGoodFileSize(file){
     var size = file.size;
     return (!file || size > maxSize)? false: true;
  };
  var extFile = ["jpg","jpeg","gif","JPG","JPEG","GIF"];//,"png","PNG"];//Только форматы: jpg, jpeg, png или gif
  function fileValid($target,isValid, text){
     var input = $target.parent().siblings().find("input[type='text']");
     var label = $target.parent().siblings().find("label");
     if (isValid){
        input.removeClass("invalid").addClass("valid");
        label.addClass("active");
        if (text) {
          label.attr("data-success", text);
        }
      }
      else {
        input.val("");
        input.removeClass("valid").addClass("invalid");
        label.addClass("active");
        $target.replaceWith($target.val('').clone(true));
        if (text) {
          label.attr("data-error", text);
        }
      }

  };
  function preload(partner){
     $(".phoneMask").mask("+7(999) 999-9999");
  $(".datepickerMask").mask("99.99.9999", {placeholder: "ДД.ММ.ГГГГ" });

   $("#friend_name").change(function(e) {
    if ($(e.target).val() == $("#name").val() || $(e.target).val() == $("#spouse_name").val()){
      //$(e.target).removeClass("valid").addClass("invalid");
      // $(e.target).val("")
      e.target.setCustomValidity("Error");
    }
    else {
       e.target.setCustomValidity("");
    }
  });
   $("#friend_name1").change(function(e) {
    if ($(e.target).val() == $("#name").val() || $(e.target).val() == $("#spouse_name").val()){
      //$(e.target).removeClass("valid").addClass("invalid");
      // $(e.target).val("")
      e.target.setCustomValidity("Error");
    }
    else {
       e.target.setCustomValidity("");
    }
  });
  $("#friend_name2").change(function(e) {
    if ($(e.target).val() == $("#name").val() || $(e.target).val() == $("#spouse_name").val()){
      //$(e.target).removeClass("valid").addClass("invalid");
      // $(e.target).val("")
      e.target.setCustomValidity("Error");
    }
    else {
       e.target.setCustomValidity("");
    }
  });

  $(".currency").on('keyup', function(){
    var n = parseInt($(this).val().replace(/\D/g,''),10);
    $(this).val(n.toLocaleString());
});

  $('input[type="file"]').change(function(e) {

     var file = e.target.files[0];
    if (!isGoodFileExt(file)){
      fileValid($(e.target), false, "Только форматы: jpg, jpeg, png или gif");
    } else {
      if (isGoodFileSize(file)){
        fileValid($(e.target), true);
      }
      else{
        fileValid($(e.target), false, "Размер файла должен быть меньше "+maxSize/1000000+"Мб");
      }
    }

  });

  $("input[name='age']").change(function() {
    //  $("[stepindex=0]").hide();
    if ($("input[name='age']:checked").val() == "true") {
      next();
      $("#paginator").show();

    } else {
      next(stepAgeError);
      $("#paginator").hide();
    }
    // Do something interesting here
  });
  $("input[name='is_person']").change(function() {
    //  $("[stepindex=0]").hide();
    $("#paginator").hide();
    if ($("input[name='is_person']:checked").val() == "true") {


    //  next();
      submit(partner);

    } else {
      next(stepAccessError);
      $("#paginator").hide();
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
  }
