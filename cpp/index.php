<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Анкета Центр правовой поддержки</title>
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
      .md-form label{
                  width: 100%!important;
              }
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
                <h3 class="white-text mb-3 pt-3 font-weight-bold">Центр правовой поддержки</h3>
            </div>

        </div>
<div stepindex="0">
    <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">Здравствуйте!</h5>
        <p class="card-text">
Вы хотите воспользоваться услугами «Центр правовой поддержки», но у Вас нет свободных средств? Мы поможем оформить Вам рассрочку на 6 месяцев без переплаты. Рассрочка оформляется через банки-партнеры. Никаких справок, поручителей и беготни по отделениям. Всё просто и в одном месте. Вам остается только следовать инструкции и корректно отвечать на вопросы.
Спасибо за то, что Вы с нами!</p>

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
        <h5 class="card-title" style="margin-bottom: 0px">Название услуги и срок кредита</h5>
      <!--   <p class="card-text">Название семинара и срок кредита </p> -->
    </div>
  </div>
    <div class="md-form ">
    <input type="text" id="course" name="course" required class="form-control validate">
    <label for="course" data-error="Введите название оказываемых услуг" data-success="Верно">Введите название оказываемых услуг*</label>
</div>
 <div class="md-form ">
    <i class="fa fa-rub prefix grey-text"></i>
    <input type="text" min="0"  id="price" name="price" required class="form-control validate currency"/>
    <label for="price" data-error="Укажите стоимость услуг" data-success="Верно">Укажите стоимость услуг*</label>
</div>

<div class="md-form ">
    <input type="number" min="6" max="36"  id="credit_term" name="credit_term" required class="form-control validate"/>
    <label for="credit_term" data-error="Введите число от 6 до 36" data-success="Верно">Введите желаемый срок кредита (в мес)*</label>
</div>
</div>

<div stepindex="2">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Личные данные</h5>
    </div>
  </div>
    <div class="md-form ">
        <input type="text" id="name" name="name" required class="form-control validate">
        <label for="name" data-error="Укажите ФИО" data-success="Верно">Укажите Ваши фамилию, имя, отчество*</label>
    </div>
    <div class="md-form ">
        <select name="education" id="education" required class="mdb-select validate">
            <option value="" disabled selected></option>
            <option value="Высшее">Высшее</option>
            <option value="Неполное высшее">Неполное высшее</option>
            <option value="Среднее специальное">Среднее специальное</option>
            <option value="Среднее">Среднее</option>
            <option value="Неполное среднее">Неполное среднее</option>
        </select>
        <label for="education"  data-error="Выберите образование из списка" data-success="Верно">Укажите ваше образование*</label>
    </div>
     <div class="md-form">
        <input type="tel" id="phone" name="phone" required class="form-control validate phoneMask" value="+7"  >
        <label for="phone" data-error="+7xxxxxxxxxx" data-success="Верно">Укажите номер Вашего мобильного телефона*</label>
    </div>
     <div class="md-form">
        <input type="email" id="email" name="email" required class="form-control validate">
        <label for="email" data-error="Укажите email" data-success="Верно">Укажите Вашу электронную почту*</label>
    </div>

</div>
<div stepindex="3">
 <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Смена фамилии</h5>
    </div>
  </div>
     <div class="mt-4 ml-2">
         <div class="row justify-content-left">
           <label for="change_name">Вы меняли фамилию?</label>
         </div>
        <div class="row justify-content-left">
            <div class="switch">
            <label for="change_name">
                Нет
                <input id="change_name" name="change_name" type="checkbox">
                <span class="lever"></span>
                Да
            </label>
            </div>
        </div>
        <div def="change_name">
             <div class="md-form ">
                <input type="text" id="old_name" name="old_name" required class="form-control validate">
                <label for="old_name" data-error="Укажите прежнюю фамилию" data-success="Верно">Укажите прежнюю фамилию*</label>
            </div>
        </div>
    </div>
</div>
<div stepindex="4">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Данные супруга/супруги</h5>
    </div>
  </div>
      <div class="mt-4 ml-2">
         <div class="row justify-content-left">
           <label for="is_married" >Вы женаты/замужем?</label>
         </div>
        <div class="row justify-content-left">
            <div class="switch">
            <label for="is_married">
                Нет
                <input id="is_married" name="is_married" type="checkbox">
                <span class="lever"></span>
                Да
            </label>
            </div>
        </div>
        <div def="is_married">
             <div class="md-form ">
                <input type="text" id="spouse_name" name="spouse_name" required class="form-control validate">
                <label for="spouse_name" data-error="Данных нет" data-success="Верно">Укажите ФИО жены/мужа*</label>
            </div>
            <div class="md-form ">
                <input type="text" id="spouse_birth" name="spouse_birth" required class="form-control validate datepickerMask" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
                <label for="spouse_birth" data-error="Дата введена некорректно" data-success="Верно">Укажите дату рождения жены/мужа*</label>
            </div>

           <!--  <div class="md-form">
                <input placeholder="Выберите дату" type="text" id="spouse_birth" required class="form-control datepicker">
                <label for="spouse_birth">Укажите дату рождения жены/мужа</label>
            </div> -->
         </div>
       </div>
</div>
<div stepindex="5">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Лицо для экстренной связи</h5>
        <p class="card-text">Укажите данные лица (не супруга(и)) для экстренной связи с Вами.</p>
    </div>
  </div>
    <div class="md-form ">
        <input type="text" id="friend_name" name="friend_name" required class="form-control validate">
        <label for="friend_name" data-error="Данные совпадают с Вашим ФИО" data-success="Верно">Фамилия Имя Отчество контактного лица*</label>
    </div>
     <div class="md-form">
        <input type="tel" id="friend_phone" name="friend_phone" required class="form-control validate phoneMask" value="+7"  >
        <label for="friend_phone" data-error="+7xxxxxxxxxx" data-success="Верно">Номер мобильного телефона (контактного лица)*</label>
    </div>

</div>
<div stepindex="6">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Адрес регистрации</h5>
    </div>
  </div>
     <div class="md-form ">
        <input type="text" id="city" name="city" required class="form-control validate">
        <label for="city" data-error="Введите данные" data-success="Верно">Город (прописка)*</label>
    </div>
     <div class="md-form ">
        <input type="text" id="street" name="street" required class="form-control validate">
        <label for="street" data-error="Введите данные" data-success="Верно">Улица (прописка)*</label>
    </div>
     <div class="md-form ">
        <input type="text" id="house" name="house" required class="form-control validate">
        <label for="house" data-error="Введите данные" data-success="Верно">Дом (прописка)*</label>
    </div>
     <div class="md-form ">
        <input type="number" id="flat" min="0" step="1" name="flat" class="form-control validate">
        <label for="flat" data-error="Введите данные" data-success="Верно">Квартира (прописка)</label>
    </div>
</div>
<div stepindex="7">
  <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Адрес фактического места жительства</h5>
    </div>
  </div>
     <div class="mt-4 ml-2">
         <div class="row justify-content-left">
           <label for="address_same" >Адрес места жительства совпадает с адресом регистрации?</label>
         </div>
        <div class="row justify-content-left">
            <div class="switch">
            <label for="address_same">
                Нет
                <input id="address_same" name="address_same" checked type="checkbox">
                <span class="lever"></span>
                Да
            </label>
            </div>
        </div>
        <div def="address_same">
             <div class="md-form ">
                <input type="text" id="city_loc" name="city_loc" required class="form-control validate">
                <label for="city_loc" data-error="Введите данные" data-success="Верно">Город (место жительства)*</label>
            </div>
             <div class="md-form ">
                <input type="text" id="street_loc" name="street_loc" required class="form-control validate">
                <label for="street_loc" data-error="Введите данные" data-success="Верно">Улица (место жительства)*</label>
            </div>
             <div class="md-form ">
                <input type="text" id="house_loc" name="house_loc" required class="form-control validate">
                <label for="house_loc" data-error="Введите данные" data-success="Верно">Дом (место жительства)*</label>
            </div>
             <div class="md-form ">
                <input type="number" id="flat_loc" min="0" step="1" name="flat_loc" class="form-control validate">
                <label for="flat_loc" data-error="Введите данные" data-success="Верно">Квартира (место жительства)</label>
            </div>
        </div>

    </div>
</div>
<div stepindex="8">
   <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Информация о месте работы</h5>
        <p class="card-text">Укажите фактический адрес</p>
    </div>
  </div>
     <div class="md-form ">
        <input type="text" id="work_name" name="work_name" required class="form-control validate">
        <label for="work_name" data-error="Введите данные" data-success="Верно">Наименование организации*</label>
    </div>
     <div class="md-form ">
        <input type="text" id="city_work" name="city_work" required class="form-control validate">
        <label for="city_work" data-error="Введите данные" data-success="Верно">Город (Место работы)*</label>
    </div>
     <div class="md-form ">
        <input type="text" id="street_work" name="street_work" required class="form-control validate">
        <label for="street_work" data-error="Введите данные" data-success="Верно">Улица (Место работы)*</label>
    </div>
     <div class="md-form ">
        <input type="text" id="house_work" name="house_work" required class="form-control validate">
        <label for="house_work" data-error="Введите данные" data-success="Верно">Дом (Место работы)*</label>
    </div>
    <div class="md-form ">
        <input type="text" id="flat_work" name="flat_work"  class="form-control validate">
        <label for="flat_work" data-error="Введите данные" data-success="Верно">Офис (Место работы)</label>
    </div>
     <div class="md-form">
        <input type="tel" id="phone_work" name="phone_work" required class="form-control validate phoneMask" value="+7"  >
        <label for="phone_work" data-error="+7xxxxxxxxxx" data-success="Верно">Укажите номер телефона (не мобильный) с указанием кода города*</label>
    </div>
     <div class="md-form ">
        <input type="text" id="post_work" name="post_work" required class="form-control validate">
        <label for="post_work" data-error="Введите данные" data-success="Верно">Укажите вашу должность*</label>
    </div>
    <div class="md-form ">
        <input type="number" min="0" step="1"  id="count_work" name="count_work" required class="form-control validate"/>
        <label for="count_work" data-error="Введите количество месяцев" data-success="Верно">Укажите количество месяцев на последнем месте работы*</label>
    </div>
    <div class="md-form ">
        <i class="fa fa-rub prefix grey-text"></i>
        <input type="text" min="0"  id="income_work" name="income_work" required class="form-control validate currency"/>
        <label for="income_work" data-error="Введите данные" data-success="Верно">Укажите ежемесячный доход по основному месту работы*</label>
    </div>

</div>

<div stepindex="9">
   <div class="card text-center">
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0px">Документы</h5>
    </div>
  </div>
    <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="photo_passport" data-error="Введите данные" data-success="Верно">Сделайте фото 2-3 страницы паспорта в развороте*</label>
         </div>
     </div>
    <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">
            <div class="file-field">

                <div class="btn btn-primary btn-sm float-left">
                    <span>Выберите файл</span>
                    <input required id="photo_passport" name="photo_passport" type="file" accept='image/gif, image/jpeg, image/jpg' >
                </div>

                <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="photo_passport_text" type="text" required >
                    <!-- <input class="file-path validate" id="tmp" type="text" required  readonly> -->
                    <label for="photo_passport_text" data-error="Только форматы: jpg, jpeg или gif" data-success="Верно" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>
        </div>
    </div>
   <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="photo_passport_reg">Сделайте фото страницы паспорта с действующей регистрацией*</label>
         </div>
     </div>
   <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">

            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span>Выберите файл</span>
                    <input type="file" required id="photo_passport_reg" name="photo_passport_reg" accept='image/gif, image/jpeg, image/jpg'>

                </div>
                  <div class="file-path-wrapper">

                  <input class="file-path validate readonly"  name="photo_passport_reg_text" type="text" required  >
                    <label for="photo_passport_reg_text" data-error="Только форматы: jpg, jpeg или gif" data-success="Верно" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>

        </div>
    </div>
   <div class="mt-5 ml-2">
         <div class="row justify-content-left">
           <label for="photo_selfi">Сделайте селфи для вашей верификации*</label>
         </div>
     </div>
    <div class="row justify-content-left">
        <div class="md-form" style="margin-top: 0rem;">

            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span>Выберите файл</span>
                    <input type="file" required id="photo_selfi" name="photo_selfi" accept='image/gif, image/jpeg, image/jpg'>
                </div>
                <div class="file-path-wrapper">

                  <!-- <input class="file-path validate" name="photo_selfi_text" type="text" required style="display: none;"  >   -->
                  <input class="file-path validate readonly"  name="photo_selfi_text" type="text" required  ="">
                    <!-- <input class="file-path validate" id="tmp" type="text" required  readonly> -->
                    <label for="photo_selfi_text" data-error="Только форматы: jpg, jpeg или gif" data-success="Верно" class="active" style="width: 100%;margin-left: 5px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<div stepindex="10">
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
<div stepindex="11">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Поздравляем!</h5>
            <p class="card-text">
                Ваши данные отправлены на рассмотрение, в ближайшее время с Вами свяжется наш специалист.<br/>
                Спасибо за то, что Вы с нами!</p>
        </div>
    </div>
    <div class="row justify-content-center md-form">
            <!-- Default button -->
        <button type="button" onclick="reload()" dir="reload" class="btn btn-primary">Заполнить заявку еще раз</button>
    </div>
</div>
<div stepindex="12">
     <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Вы не дали согласие на обработку персональных данных</h5>
              <h5 class="card-title">Ваша заявка не будет рассмотрена</h5>
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
<div stepindex="13">
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

 <div id="paginator" class="row justify-content-between md-form">
            <!-- Default button -->
            <button type="button" dir="prev" onclick="prev()" class="btn btn-outline-primary waves-effect">Назад</button>
            <button type="button" dir="next" onclick="next()" class="btn btn-primary">Вперед</button>
        </div>

<!-- <div class="text-center mt-4">
        <button class="btn btn-default" id="submitBtn">Login</button>
    </div> -->


<!-- Material form register -->

    </div>
</div>

</section>



  <!--Pagination -->

    <!-- SCRIPTS -->
    <!-- JQuery -->
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
      <script type="text/javascript" src="../js/functions-anketa.js"></script>
    <script>
$('.mdb-select').material_select();
// $('.datepicker').pickadate(
//   {selectMonths: true,
//     selectYears: 40,
//   });
</script>

<script>
   var stepIndex=0;
  var stepSuccess = 11;
  var stepAgeError = 13;
  var stepAccessError =12;
  var stepAccess = 10;
  var stepAge = 0;
  var maxSize = 8000000;
   var stepDoc = 9;
   var partner = "Центр правовой поддержки";
  $(".readonly").on('keydown paste', function(e){
    e.preventDefault();
  });
 $(function() {
   preload(850545, "pos-credit");
  $("#paginator").hide();
  $("[stepindex]:not([stepindex=" + stepIndex + "])").hide();
  $("[def]").hide();
});
</script>
</body>

</html>
