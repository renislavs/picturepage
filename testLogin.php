<?php
    session_start();
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Authentication.inc.php';
    $auth = FALSE;
    $err = '';

    if (!Authentication::isAuthenticated() 
          && Authentication::areCookiesEnabled()) { 
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $auth = Authentication::authenticate($_POST['email'], $_POST['password']);
            if (!Authentication::isAuthenticated()) {
                //$err = 'Error at login, please retry';
                $_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
            }
            else {
                $_SESSION['login_error_msg'] = "";
            }
        }
    }    
    header("Location: ./index.php");
                                   
