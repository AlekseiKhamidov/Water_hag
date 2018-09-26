<?php
  require_once "check.php";
  require_once "../config.php";
  require_once "../mysql.php";


  if (checkLogin() == -1) {
    header("Location: login.php"); exit();
  };

?>
<html>
    <head>
    	<title>Регистрация нового пользователя</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link href="../css/mdb.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
    <link href="../css/compiled.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <style>
        .md-form label{
            width: 100%!important;
        }
          select {
display: block important!;
}
.form-simple .font-small {
  font-size: 0.8rem; }

.form-simple .header {
  border-top-left-radius: .3rem;
  border-top-right-radius: .3rem; }

.form-simple input[type=text]:focus:not([readonly]) {
  border-bottom: 1px solid #ff3547;
  -webkit-box-shadow: 0 1px 0 0 #ff3547;
  box-shadow: 0 1px 0 0 #ff3547; }

.form-simple input[type=text]:focus:not([readonly]) + label {
  color: #4f4f4f; }

.form-simple input[type=password]:focus:not([readonly]) {
  border-bottom: 1px solid #ff3547;
  -webkit-box-shadow: 0 1px 0 0 #ff3547;
  box-shadow: 0 1px 0 0 #ff3547; }

.form-simple input[type=password]:focus:not([readonly]) + label {
  color: #4f4f4f; }


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
<section>
<form id="formReg">
            <!-- Grid row -->
            <div class="row justify-content-center">

              <!-- Grid column -->
              <div class="col-md-6 mb-5 mt-5" >

                <div class="card mx-xl-5">
                    <div class="card-body">

                        <!--Header-->
                        <div class="form-header purple-gradient rounded">
                            <h3><i class="fa fa-lock"></i> Регистрация</h3>
                        </div>

                        <!-- Material input email -->
                        <div class="md-form">
                            <input type="text" id="login" name="login" required class="form-control validate" minlength="3" maxlength="30">
                            <label for="login" >Логин*</label>
                        </div>

                        <!-- Material input password -->
                        <div class="md-form ">
                            <input type="password" id="password" name="password" class="form-control " required>
                            <label for="password">Пароль*</label>
                        </div>

                         <!-- Material input password -->
                        <div class="md-form ">
                            <input type="password" id="confirm" name="confirm" class="form-control " required >
                            <label for="confirm" data-error="Пароли не совпадают" data-success="Пароли совпадают">Повторите пароль*</label>
                        </div>


                         <div class="form-check md-form">
                          <input class="form-check-input filled-in" type="checkbox" id="isAdmin" name="isAdmin">
                          <label for="isAdmin" >Администратор</label>
                        </div>

                        <div class="md-form ">
                          <select id="partnerSelect"  name="partnerSelect" class="mdb-select">
                              <option value="" disabled selected></option>
                                <?php
                                  require_once 'amoconn.php';
                                //  getPartnerList("main");
                                //print_r(AMO_CFID_PARTNER);
                                  $data = getLeadCustomFieldEnums(AMO_CFID_PARTNER);
                                  foreach ($data as $key => $value) {

                                    echo "<option value=".$key.">$value</option>";
                                  }
                                ?>
                          </select>
                          <label for="partnerSelect">Принадлежит организации-партнеру</label>
                      </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-deep-purple waves-effect waves-light" id="loginButton" type="button" onclick="submit1()">Зарегистрировать</button>
                             <p id="error" class="red-text"></p>
                        </div>





                    </div>

                </div>

              </div>
              <!-- Grid column -->


            </div>
            <!-- Grid row -->

        </div>
    </form></section>

  <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
     <script type="text/javascript" src="../js/jquery.maskedinput.min.js"></script>
       <script type="text/javascript">

       </script>

        <script>
          function test(){
             checkPassword();
          }

           $(document).ready(function() {

    $('.mdb-select').material_select();
     $("#error").hide();
       //   $('#confirm').change(function(){
       //   //   event.preventDefault();
       //    checkPassword();
       // q;
       //  });
         $('#confirm').change(checkPassword);
         $('#password').change(checkPassword);
        $('#login').focusout(function(event){



        });
          $('#login').change(function(event){
           minlength = parseInt($(this).attr("minlength"));
            if ($(this).val().length< minlength){

              validate($(this), false, "Логин должен быть не меньше 3-х символов и не больше 30");



            }
            else {
               validate($(this), true);
            }
              var n = $(this).val().search(/\W/g);
              if (n>-1){
                validate($(this), false, "Логин может состоять только из букв английского алфавита и цифр");
              return false;
              }
          });
          $("#isAdmin").change(function(){
          if ( $(this).is(':checked')){
            $(".select-dropdown").prop( "disabled", true );
          }
          else {
            $(".select-dropdown").prop( "disabled", false );
          }
          })
          // $("#partnerSelect").change(function(){
          //   $("#partnerSelectText").val($(this).val());
          //   if ($(this).val()){
          //      validate($("#partnerSelectText"), false, "фывфвфывфв");
          //   }
          //   else {
          //      validate($("#partnerSelectText"), true);
          //   }
          // });
  });

            // Variable to hold request
        var request;


        // Bind to the submit event of our form

        function submit1(){
        //$("#formReg").submit(function(event){
      //      event.preventDefault();
            if (request) {
                request.abort();
            }
            var $form = $("#formReg");
            var $inputs = $form.find("input, select, button, textarea");
            let log = validateSubmit($form);
            let pass = checkPassword()
            if (log && pass){


            $("#mdb-preloader").show();
            var serializedData = $form.serialize();
            $inputs.prop("disabled", true);

            // Fire off the request to /form.php
            request = $.ajax({
                url: "addUser.php",
                type: "post",
               // dataType: "json",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){

              response = JSON.parse(response);
                // Log a message to the console
                if (response.status == "success"){
                     $("#error").text("");
                    $("#error").hide();
                    window.location.replace("index.php")
                }
                if (response.status == "error") {
                   $("#error").html(response.message);
                    $("#error").show();
                }
            });

            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
                 $("#error").text(textStatus,errorThrown);
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Reenable the inputs
                $inputs.prop("disabled", false);
                 $("#mdb-preloader").hide();
            });
          }

        };

         function checkPassword(){
             var pass = $("#password").val();
                var pass_rep = $("#confirm").val();
                if (pass_rep == "") return 0;

                if (pass != pass_rep) {
                     validate($("#confirm"), false);
                    validate($("#password"), false);

                    return false;
                }
                else{
                    validate($("#password"), true);
                    validate($("#confirm"), true);
                    return true;
                }
         };
         function validateSubmit($form){
            let formValid=true;
            $inputs = $form.find("[required]");

          $inputs.each(function() {
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


         function validate($this,isValid, text=null){
          if (isValid){
             $this.addClass('valid').removeClass('invalid');
              if (text) {
                $this.siblings("label").attr("data-success", text);
              }
              $this.siblings("label").addClass("active");
          } else {
              //добавить к formGroup класс .has-error, удалить .has-success
             $this.addClass('invalid').removeClass('valid');
             if (text) {
                $this.siblings("label").attr("data-error", text);
              }
              $this.siblings("label").addClass("active");
            }
            return true;
         };
        </script>
    </body>
</html>
