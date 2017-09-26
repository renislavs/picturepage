<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">     
        <title>PicturePage</title>
        <link rel="stylesheet" type="text/css" href="./css/modalStyle.css">
        <script src="./js/modalFunc.js"></script> 
        <script>
            'use strict'; // use correct syntax in js. Helps us find issues in js
            var check = function (e) {
                if (document.forms.formalia.password.value !== 
                                   document.forms.formalia.password2.value) {
                    document.forms.formalia.password.focus();
                    document.forms.formalia.err.innerHTML = "Two password entries differ";
                    e.preventDefault(); 
                    return false;       
                } 
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var email = document.forms.formalia.email.value;
                if (!re.test(email))
                {
                    document.getElementById("err").innerHTML = "Email is not correct";
                    document.forms.formalia.email.focus();
                    e.preventDefault();
                    return false;      
                }
                return true;
            };
            var init = function () {
                document.forms.formalia.addEventListener('submit', check);
            };
            window.addEventListener('load', init);
        </script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">
        <!-- Bootstrap core CSS -->
        <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">
        <link href="css/mystyle.css" rel="stylesheet">

    </head>
    <body>
   
<?php
    include './includes/menu.inc.php';
?>
<div class="container">
      <div class="row">
          <div class="col-sm-6 col-md-6 reg">
                <h4>Log in</h4>
                <form class="container" action="testLogin.php" method="post">
                    <input placeholder="Enter email" name="email" required>
                    <input placeholder="Enter Password" name="password" required>
                    <button>Submit</button>
<?php
                if(isset($_SESSION['login_error_msg'])) {
                    printf("<br /><label class='err'>%s.</label>\n", $_SESSION['login_error_msg']);
                    unset( $_SESSION['login_error_msg']);
                }
?>
                </form>
              </div>
               <div class="col-sm-6 col-md-6 reg">
                <h4>Register</h4>
                <button id="myBtn">Sign me up</button>
              </div>
            </div>

    </div><!-- /.container -->
   
    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content --> 
      <div class="modal-content">
        <span class="close">&times;</span>
        <p>You are about to register</p>
        <form id='formalia' class="container" method="post" action="/PicturePage/createVoterDb.php">
            <label><b>Firstname *</b></label><br />
            <input type="text" placeholder="Enter firstname" name="firstname" required><br />
            <label><b>Email *</b></label><br />
            <input type="text" placeholder="Enter email" name="email" id="email" required><br />
            <label><b>Password *</b></label><br />
            <input type="password" placeholder="Enter Password" name="password" required><br />
            <label><b>Confirm password *</b></label><br />
            <input type="password" placeholder="Enter Password" name="password2" required><br />
            <label id="err" style="color:red"></label>
            
            <button type="submit" name="createAccountBt">Create</button>
        </form>
      </div>
    </div>      
</html>
