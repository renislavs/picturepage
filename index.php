
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
    
</html>
