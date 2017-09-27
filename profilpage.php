<?php
    session_start();
    require_once './includes/Authentication.inc.php';
    
    if (!Authentication::isAuthenticated()) {
        header('Location: ./index.php?noaccess');
    }
?>

<!DOCTYPE html>
<html lang="en">
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

    <title>ProfilPage</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <link href="./css/mystyle.css" rel="stylesheet">
  <style>
#logo{
  margin-left: 10px;
}
body {
    background-image: none!important;
    background-color: #f2f2f2;
}
  .line {
width: 80px;
height: 4px;
background-color: #019fb3;
  }
  h1, h2, h3, h4, p {
    color: #686868;
  }
  .color{
    background-color:#019fb3;
  }
  img{
    display: block;
    margin: auto 0;
  }
.Uploadtext {
  margin-bottom: 0px;
  margin-top: 8px;
}
.example {
border: 1px lightgrey solid;
}
  </style>
  </head>

  <body>

    <?php
    include './includes/menu.inc.php';
?>

<div class="container">
<div class="row">

  <div class="col-sm-12 col-md-6">
  <h3>Add image to your library</h3>
       
        <!--button style="margin-bottom: 30px;"type="button" class="btn btn-default dropdown-toggle">
         Browse
          </button-->    
    <form action="imgdb.php" method="post" id='deform' enctype="multipart/form-data"> 
        <input type="hidden" name="MAX_FILE_SIZE" value="256000"/>
        <input type='file' id='bild' name='img' style="margin-bottom: 30px;" class="btn btn-default dropdown-toggle" />
  
        <p class="Uploadtext">Caption</p>
        <input type="text" name="caption">

        <p class="Uploadtext">Story</p>
        <input rows="4" cols="50" type="text" name="story"></input>

        <p class="Uploadtext">Tags</p>
        <input type="text" name="tags"><br>

        <button style="margin-bottom: 30px; margin-top: 10px;" type="submit" class="btn btn-default dropdown-toggle">
         Add image to Library
          </button>  
<?php        

        if (ISSET($_SESSION["errmsg"])) {
            print("<p>".$_SESSION["errmsg"]."</p>");
        }
?>                
    </form>
  </div>

   <div class="col-sm-12 col-md-6">
        
         <img style="border: 1px lightgrey solid; margin-top: 20px;"src="images/ex.jpg">       

  </div>
</div>

<div class="row">

<div class="col-sm-12 col-md-12">
     <h1 class="title">Your Library</h1>
     <div class="line"></div>
       
</div>
</div>
<br><br>

<div class="row rowmar">
<?php
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Photo.inc.php';
    $dbh = DbH::getDbH();
    try {
        $sql  = "select caption, credit, id, imagedata, mimetype, story, tags";
        $sql .= " from photo";
        $sql .= " where credit = :email";
        $q = $dbh->prepare($sql);
        $q->bindValue(':email', Authentication::getEmail());
        $q->execute();
        
    } catch(PDOException $e) {
        $_SESSION['error'] = "Could not create img (".$e->getMessage().")";
      //  header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    } catch (Exception $e) {
        $_SESSION['error'] = "Could not create img (".$e->getMessage().")";
      //  header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    }
    
    $a = array();
    while ($out = $q->fetch()) {
        $g = new Photo($out['caption'], $out['credit'], $out['id'], $out['imagedata'], $out['mimetype'], $out['story'], $out['tags']);
        array_push($a, $g);
    }

    foreach ($a as $gb) {
        print("<div class='col-sm-3 col-md-3'>\n"); //TODO find class style
        print($gb);
        print("</div>\n");
    }
   
?>
          
   </div>
<br><br>

</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"></script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

  </body>
</html>
