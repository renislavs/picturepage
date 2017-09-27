<?php

error_reporting(E_ALL);
//define user friendly EOL for friendlier PHP output
if (!defined('EOL')) {
    define('EOL', '<br />' . PHP_EOL);
}

            //Require some shizzzzz
            require_once './includes/DbP.inc.php';
            require_once './includes/DbH.inc.php';
            
            $dbh = DbH::getDbH();
            
            $query = $dbh->prepare('SELECT * FROM photo');
            $query->execute();
            
            $images = $query->fetchAll();
 
//for log on only.
    session_start();
    require_once './includes/Authentication.inc.php';
    
   if (!Authentication::isAuthenticated()) {
        header('Location: ./index.php?noaccess');
    }
    ?>
    
<!DOCTYPE html>
<html>
    <head>
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
 
        <title>Picture Page</title>
        
       <!-- Bootstrap core CSS -->
        <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        
        <link href="../css/mystyle.css" rel="stylesheet">
        <link href="./css/popupCSS.css" rel="stylesheet">
        <script src="./js/modalFunc.js"></script>

    </head>
    <body>
        <?php
    include './includes/menu.inc.php';

            if(isset($_SESSION['errors'])){
                foreach($_SESSION['errors'] as $error){
                    echo sprintf('<p>%s</p>',$error);
                }
                unset($_SESSION['errors']);
            }
        ?>
 
        <div class="container">

        <div class="row">            

                        <!-- connect to the database.php -->
                        <form action="imagesDB.php" 
                              method="post" 
                              id="deform"
                              enctype="multipart/form-data">
                            <fieldset>
                                <legend>Upload</legend>
                            <p>
                                <label for='caption'>Caption</label><br/>
                                <input type='text' id='caption' name='caption'/>
                            </p>
                            <p>
                                <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                                <label for='bild'>Image:</label><br/>
                                <input type='file' id='bild' name='images'/><br/>
                                <label for='bild'>It got to be under 64kb.</label><br/>
                            </p>
                         
                             <p>
                                <label for='story'>Story:</label><br/>
                                <input type='text' id='story' name='story'/>
                            </p>
                            <p>
                                <label for='tags'>Tags:</label><br/>
                                <input type='text' id='tags' name='tags'/>
                            </p>
                            <p>
                                <label for='credit'>Credit by:</label><br/>
                                <input type='text' id='credit' name='credit'/>
                            </p>
                            <p>
                               <input type='submit' name='butt' value='Go!'/>
                            </p>
                            </fieldset>
                        </form>
                        
                        
        </div>
    </div> <!--end of container -->
    <div class="container"> <!-- gallery -->

        <div class="row">            

                         <?php
                foreach($images as $image){
                    echo sprintf(' 
                            <div class="col-xs-12 col-md-2">
                                <a class="thumbnail" href="data:image/jpeg;base64,%s" title="%s" alt="%s">
                                    <img src="data:image/jpeg;base64,%s" class="img-fluid" />
                                   
                                </a>
                            </div>
                            ', 
                            base64_encode($image['imagedata']),
                            $image['caption'],
                            //this do not show credit.
                            $image['credit'],
                            base64_encode($image['imagedata'])
                           
                        );
                }
                
               
        ?>   
           
    </div> <!--end of gallery container -->
        
    
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="./js/magnificpopup.min.js"></script>
   <script>
    $(document).ready(function() {
  $('.thumbnail').magnificPopup({
      type:'image',
      gallery:{
        enabled:true
      }
  });
});
    </script>
    </body></html>