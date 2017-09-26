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
                $err = 'Error at login, please retry';
                $_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
            }
            else {
                $err = '';
                $_SESSION['login_error_msg'] = "good";
            }
        }
    }    
    header("Location: ./index.php");
                                   
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PicturePage Login</title>
        <link rel='stylesheet' href='css/styles.css'/>
    </head>
    <body>
<?php
    include './includes/menu.inc.php';
?>  

  </body>
</html>