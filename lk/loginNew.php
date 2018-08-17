<?php
  require_once "check.php";
  require_once "../config.php";
  require_once "mysql.php";


  // if (checkLogin() != -1) {
  //   header("Location: index.php"); exit();
  // };

?>
<html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link href="../css/mdb.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
    <link href="../css/compiled.min.css" rel="stylesheet">

        <style>

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

<!-- Material form register -->

<section>
<form id="formLogin">
            <!-- Grid row -->
            <div class="row justify-content-center">

              <!-- Grid column -->
              <div class="col-md-6 mb-5 mt-5" style="width: 90%">

                <div class="card mx-xl-5">
                    <div class="card-body">

                        <!--Header-->
                        <div class="form-header purple-gradient rounded">
                            <h3><i class="fa fa-lock"></i> Авторизация</h3>
                        </div>

                        <!-- Material input email -->
                        <div class="md-form">
                            <i class="fa fa-user prefix grey-text"></i>
                            <input type="text" id="login" name="login" required class="form-control" >
                            <label for="login" >Логин</label>
                        </div>

                        <!-- Material input password -->
                        <div class="md-form font-weight-light">
                            <i class="fa fa-lock prefix grey-text"></i>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <label for="password">Пароль</label>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-deep-purple waves-effect waves-light" id="loginButton" type="submit">Войти</button>
                             <p id="error" class="red-text"></p>
                        </div>

                    </div>

                    <!--Footer-->
                   <!--  <div class="modal-footer">
                        <div class="options font-weight-light">
                            <p>Not a member? <a href="#">Sign Up</a></p>
                            <p>Forgot <a href="#">Password?</a></p>
                        </div>
                    </div> -->

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


        <script>
            // Variable to hold request
        var request;
        $("#error").hide();

        // Bind to the submit event of our form
        $("#formLogin").submit(function(event){

            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);

            // Let select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = $form.serialize();

            // Let disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            // Fire off the request to /form.php
            request = $.ajax({
                url: "loginLoad.php",
                type: "post",
               // dataType: "json",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                console.log("Hooray, it worked!");
                if (response.status == "error") {
                   $("#error").text(response.message);
                    $("#error").show();
                }
                else {
                       $("#error").text("");
                    $("#error").hide();
                    window.location.replace("indexnew2.php")
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
            });

        });
        function validate() {
		  var formValid = true;
		  var $input =  $("input");
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
