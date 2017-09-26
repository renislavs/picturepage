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
            }
        }
    }

    if (Authentication::isAuthenticated()) {  // am I logged on?
        header("Location: ./frontPage.php");
    }                               
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
        <main id="mydiv">
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table id="login">
                <caption>Login</caption>
                <tr>
                  <td>Email:</td><td><input type="text" name="email"/></td>
                </tr>
                <tr>
                  <td>Password: </td><td><input type="password" name="password"/></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" value="OK"/>&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Cancel" 
                          onclick="window.location='./index.php'"/>
                  </td>
                </tr>
<?php
                if ($err != '') {
                  printf("<tr><td colspan='2' class='err'>%s.</td></tr>\n", $err);
                }
                if (!Authentication::areCookiesEnabled()) {
                  print("<tr><td colspan='2' class='err'>Cookies 
                      from this domain must be 
                      enabled before attempting login.</td></tr>");
                }
?>
          </table>
        </form>
      </main>

  </body>
</html>