<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Анкета Garden Group</title>
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/compiled.min.css" rel="stylesheet">
  <!--    <link href="css/materialize.min.css" rel="stylesheet"> -->
<style type="text/css">
.form-gradient .header {
  border-top-left-radius: .3rem;
  border-top-right-radius: .3rem; }

.form-gradient input[type=text]:focus:not([readonly]) {
  border-bottom: 1px solid #fd9267;
  -webkit-box-shadow: 0 1px 0 0 #fd9267;
  box-shadow: 0 1px 0 0 #fd9267; }

.form-gradient input[type=text]:focus:not([readonly]) + label {
  color: #4f4f4f; }

.form-gradient input[type=password]:focus:not([readonly]) {
  border-bottom: 1px solid #fd9267;
  -webkit-box-shadow: 0 1px 0 0 #fd9267;
  box-shadow: 0 1px 0 0 #fd9267; }

.form-gradient input[type=password]:focus:not([readonly]) + label {
  color: #4f4f4f; }
           /*input.currency {
    text-align: right;
    padding-right: 15px;
}   */
.picker__footer{
    display: none!important
}
</style>
</head>

<body>
    <div id="mdb-preloader" class="flex-center" style="display: none;    opacity: 0.5;">
    <div id="preloader-markup">
      <div class="preloader-wrapper big active crazy">
  <div class="spinner-layer spinner-blue-only">
    <div class="circle-clipper left">
      <div class="circle"></div>
    </div>
    <div class="gap-patch">
      <div class="circle"></div>
    </div>
    <div class="circle-clipper right">
      <div class="circle"></div>
    </div>
  </div>
</div>
    </div>
</div>
<section class="form-gradient" >

<div class="row justify-content-center">
    <div class="col-md-6 mb-4" style="width: 90%">


<!-- Material form register -->
<form id="formReg">

 <div class="header blue-gradient">

            <div class="row d-flex justify-content-center">
                <h3 class="white-text mb-3 pt-3 font-weight-bold">Garden Group</h3>
            </div>

        </div>
<div stepindex="0">
    <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">Здравствуйте!</h5>
        <p class="card-text">
Вы хотите приобрести станок Garden Group , но у Вас нет свободных средств? Мы поможем Вам оформить кредит на любой для Вас удобный срок. Кредит оформляется через банки-партнеры. Никаких справок, поручителей и беготни по отделениям. Все просто и в одном месте. Вам остается только следовать инструкциям и корректно отвечать на вопросы. Спасибо за то, что Вы с нами!</p>

    </div>
</div>


 <!-- Material input text -->

    <div class="mt-4 ml-2">
       <div class="row justify-content-center">
      <label for="age" >Ваш возраст 21 и более полных лет?</label>
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

<div stepindex="1">
   <div class="card text-left">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Название оборудования и срок кредита</h5>
      <!--   <p class="card-text">Название семинара и срок кредита </p> -->
    </div>
  </div>
  <div class="md-form ">
    <input type="text" id="course" name="course" required class="form-control validate">
    <label for="course" data-error="Данные отсутсвуют" data-success="Верно">Введите наименование оборудования*</label>
</div>
 <div class="md-form ">
    <i class="fa fa-rub prefix grey-text"></i>
    <input type="text" min="0"  id="price" name="price" required class="form-control validate currency"/>
    <label for="price" data-error="Данные отсутсвуют" data-success="Верно">Укажите стоимость оборудования*</label>
</div>
</div>
<div stepindex="2">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Контактное лицо</h5>
    </div>
  </div>
    <div class="md-form ">
        <input type="text" id="name" name="name" required class="form-control validate">
        <label for="name" data-error="Данные отсутсвуют" data-success="Верно">Фамилия Имя Отчество контактного лица*</label>
    </div>
     <div class="md-form">
        <input type="tel" id="phone" name="phone" required class="form-control validate phoneMask" value="+7"  >
        <label for="phone" data-error="+7xxxxxxxxxx" data-success="Верно">Номер телефона контактного лица*</label>
    </div>
     <div class="md-form">
        <input type="text" id="manager" name="manager" class="form-control">
        <label for="manager">Менеджер Garden Group, курирующий данную сделку</label>
    </div>
</div>
<div stepindex="3">
   <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Документы</h5>
    </div>
  </div>
    <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="commercial" data-error="Введите данные" data-success="Верно">Коммерческое приложение от ООО "ТЛК" с НДС*</label>
         </div>
     </div>
    <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">
            <div class="file-field">

                <div class="btn btn-primary btn-sm float-left">
                    <span>Выберите файл</span>
                    <input required id="commercial" name="commercial" type="file" number="0" accept='application/pdf' >
                </div>

                <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="commercial_text" type="text" required >
                    <!-- <input class="file-path validate" id="tmp" type="text" required  readonly> -->
                    <label for="commercial_text" data-error="Доступен только формат: pdf" data-success="Верно" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>
        </div>
    </div>
   <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="info_card">Информационная карта компании клиента*</label>
         </div>
     </div>
   <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">

            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span>Выберите файл</span>
                    <input type="file" required id="info_card" name="info_card" number="1" accept='application/pdf, application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/gif, image/jpeg, image/jpg, image/png'>

                </div>
                  <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="info_card_text" type="text" required  >
                    <label for="info_card_text" data-error="Доступны форматы: pdf, doc, docx, jpg, jpeg, png или gif" data-success="Верно" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>

        </div>
    </div>
   <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="statement">Выписка 51 счета от клиента (в разбивке по месяцам)*</label>
         </div>
     </div>
    <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">

            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span>Выберите файл</span>
                    <input type="file" required id="statement" name="statement" number="2" accept='application/pdf, application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'>
                </div>
                <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="statement_text" type="text" required>
                    <label for="statement_text" data-error="Доступны форматы: pdf, doc, docx, xls и xlsx" data-success="Верно" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>


        </div>
    </div>
    <div class="md-form">
    <textarea type="text" id="comment" class="form-control md-textarea" rows="2"></textarea>
    <label for="comment">Комментарий</label>
</div>
</div>
</form>
<div stepindex="4">
    <div class="mt-4 ml-2">
        <div class="row justify-content-center">
            <label for="is_person" >Даете ли Вы свое согласие на обработку персональных данных для рассмотрения заявки на кредит?</label>
        </div>
        <div class="row justify-content-center">
            <div  data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" required name="is_person" value="true" autocomplete="off" >Да
                </label>
                <label class="btn btn-outline-primary waves-effect">
                    <input type="radio" required name="is_person" value="false" autocomplete="off">Нет
                </label>
            </div>
        </div>
    </div>
</div>
<div stepindex="5">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Поздравляем!</h5>
            <p class="card-text">
                Ваши данные отправлены на рассмотрение, в ближайшее время с Вами свяжется наш специалист.<br/>
                Спасибо за то, что Вы с нами!
        </div>
    </div>
    <div class="row justify-content-center md-form">
            <!-- Default button -->
        <button type="button" onclick="reload()" dir="reload" class="btn btn-primary">Заполнить заявку еще раз</button>
    </div>
</div>
<div stepindex="6">
     <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Вы не дали согласие на обработку персональных данных</h5>
            <p class="card-text">
                Ваша анкета не сохранена.<br/>
                При необходимости заполните анкету заново.<br/>
                Спасибо за то, что Вы с нами!</p>
        </div>
    </div>
    <div class="row justify-content-between md-form">
            <!-- Default button -->
             <button type="button" dir="prev"  onclick="prev(10)" class="btn btn-outline-primary waves-effect">Назад</button>
        <button type="button" dir="reload" onclick="reload()" class="btn btn-primary">Заполнить заявку еще раз</button>
    </div>
</div>
<div stepindex="7">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Нет 21 года</h5>
            <p class="card-text">
               Рассмотрение заявки возможно только если вам более 21 года.<br/>
                Спасибо за то, что Вы с нами!</p>
        </div>
    </div>
    <div class="row justify-content-between md-form">
            <!-- Default button -->
              <button type="button" dir="allprev" onclick="prev(0)"  class="btn btn-outline-primary waves-effect">Назад</button>
        <button type="button" dir="reload" onclick="reload()" class="btn btn-primary">Заполнить заявку еще раз</button>
    </div>
</div>
   <div stepindex="8">
     <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Отправленные файлы не корректны</h5>
            <p class="card-text">
                Загрузите файлы еще раз<br/>
                Внимание, размер файлов должен быть меньше 8 Мб<br/>
        </div>
    </div>
    <div class="row justify-content-between md-form">
            <!-- Default button -->
        <button type="button" dir="reload" onclick="reload()" class="btn btn-primary">Перейти</button>
    </div>
</div>
 <div id="paginator" class="row justify-content-between md-form">
            <!-- Default button -->
            <button type="button" dir="prev" onclick="prev()" class="btn btn-outline-primary waves-effect">Назад</button>
            <button type="button" dir="next" onclick="next()" class="btn btn-primary">Вперед</button>
        </div>

    </div>
</div>
</section>
    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
     <script type="text/javascript" src="../js/jspdf.min.js"></script>
     <script type="text/javascript" src="../js/jquery.maskedinput.min.js"></script>
    <script>
$('.mdb-select').material_select();
</script>

<script>
  var stepIndex=0;
  var stepSuccess = 5;
  var stepAgeError = 7;
  var stepAccessError =6;
  var stepAccess = 4;
  var stepAge = 0;
  var stepDoc = 3;
  var maxSize = 8000000;
  $(".readonly").on('keydown paste', function(e){
    e.preventDefault();
  });
  function guid() {
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
    };
    return "_"+s4() + s4();
  };
  function reload() {
    location.reload();
  };


  function submit() {
    var id = guid();

    $("#paginator").hide();
    $form = $("#formReg");
    // setup some local variables
    // Let select and cache all the fields

    var pdf_array = [];
    var $inputs = $form.find("input, select, textarea");

    for (var i = 0; i < $inputs.length; i++) {
      if ($inputs[i].id != "") {
        if ($inputs[i].labels.length > 0) {
          var pdf_elem = {};
          pdf_elem.id = $inputs[i].id;
          pdf_elem.q = $inputs[i].labels[0].textContent.replace("*", "");
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
    fileUpload(id, $form, pdf_array);
  };
  function fileUpload(id, $for, data) {

  //  var form = $("#form_photo_passport");

  var file1 = $form.find("input[type='file']")[0].files;
  var file2 = $form.find("input[type='file']")[1].files;
  var file3 = $form.find("input[type='file']")[2].files

 // var imageType = /image.*/;

  if (!isGoodFileExt(file1[0], 0) || !isGoodFileExt(file2[0], 1) || !isGoodFileExt(file3[0], 2) || !isGoodFileSize(file1[0]) || !isGoodFileSize(file2[0]) || !isGoodFileSize(file3[0])) {
    next(stepDoc);
    return;
  }

  var form_data = new FormData();
  form_data.append('file1', file1[0]);
  form_data.append('file2', file2[0]);
  form_data.append('file3', file3[0]);
  form_data.append('guid', id);
  form_data.append('partner', 32927);
  form_data.append('data', JSON.stringify(data));
  form_data.append('pipeline', "leasing");



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
var extFile = [{
                  ext : ["pdf","PDF"],
                  error:"Доступен только формат: pdf",
                },
                {
                  ext:["pdf","PDF","doc","DOC","docx","DOCX","jpg","jpeg","png","gif","JPG","JPEG","GIF","PNG"],
                  error:"Доступны форматы: pdf, doc, docx, jpg, jpeg, png или gif"
                },
                {
                  ext:["pdf","PDF","doc","DOC","docx","DOCX","xls","XLS","xlsx","XLSX"],
                  error:"Доступны форматы: pdf, doc, docx, xls и xlsx"
                }
              ];
function getExt(name){
  let mas = name.split('.');
  return (mas.length>0) ? mas[mas.length-1]: "";
};
function isGoodFileExt(file, number){
   let ext = getExt(file.name);
   return (!file || extFile[number].ext.indexOf(ext) == -1)? false: true;
};

function isGoodFileSize(file){
   let size = file.size;
   return (!file || size > maxSize)? false: true;
};
function fileValid($target,isValid, text=null){
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

$(function() {

  $(".phoneMask").mask("+7(999) 999-9999");
  // $(".datepickerMask").mask("99.99.9999", {placeholder: "ДД.ММ.ГГГГ" });

  $(".currency").on('keyup', function(){
    var n = parseInt($(this).val().replace(/\D/g,''),10);
    $(this).val(n.toLocaleString());
});

  $('input[type="file"]').change(function(e) {
    let number=parseInt($(this).attr("number"));
    var file = e.target.files[0];
    if (!isGoodFileExt(file, number)){
      fileValid($(e.target), false, extFile[number].error);
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


     // next();
      submit();

    } else {
      next(stepAccessError);
      $("#paginator").hide();
    }
    // Do something interesting here
  });

  $("#paginator").hide();
  $("[stepindex]:not([stepindex=" + stepIndex + "])").hide();
  $("[def]").hide();
});

function next(newStepIndex = -1) {
  if (validate()) {
    $("[stepindex=" + stepIndex + "]").hide();
    stepIndex++;
    if (newStepIndex > -1)
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

function prev(newStepIndex = -1) {
  if (stepIndex > 0) {
    $("[stepindex=" + stepIndex + "]").hide();
    stepIndex--;
    if (newStepIndex > -1)
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






</script>
</body>

</html>
