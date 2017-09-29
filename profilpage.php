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
    <meta name="description" content="Group 7">
    <meta name="author" content="Upload and vote on pictures">
    <link rel="icon" href="./img/favicon.ico">

    <title>ProfilPage</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <link href="./css/mystyle.css" rel="stylesheet">
    <link href="./css/popupCSS.css" rel="stylesheet">
  <style>
#logo{
  margin-left: 10px;
}
body {
    background-image: url("img/luca.jpg");
}
  .line {
width: 80px;
height: 4px;

  }
  h1, h2, h3, h4, p {
    color: white;
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

  </style>
  </head>

  <body>

    <?php
    include './includes/menu.inc.php';
?>

<div class="container-fluid">
<div class="row rowleft">

  <div class="col-sm-12 col-md-6">
  <h3 class="title1">Add image to your library</h3>
          
    <form action="imgdb.php" method="post" id='deform' enctype="multipart/form-data"> 
        <input type="hidden" name="MAX_FILE_SIZE" value="256000"/>
        <input type='file' id='bild' name='img' style="margin-bottom: 30px;" class="btn btn-default dropdown-toggle" />
  
        <p class="Uploadtext">Caption</p>
        <input type="text" name="caption">

        <p class="Uploadtext">Story</p>
        <input rows="4" cols="50" type="text" name="story">

        <p class="Uploadtext">Tags</p>
        <input type="text" name="tags"><br>
        <p>By uploading your picture, you accept that PicturePage can use it.</p>
        <button style="margin-bottom: 30px; margin-top: 10px;" type="submit" class="btn btn-default dropdown-toggle">
         Add image to Library
          </button>  
<?php        

        if (ISSET($_SESSION["error"])) {
            print("<p style='color:red'>".$_SESSION["error"]."</p>");
        }
?>                
    </form>
  </div>

</div>

    <div class="conatiner-fluid container-lib">
<div class="row rowleft">

<div class="col-sm-12 col-md-12">
     <h1 class="title title2">Your Library</h1>
     <div class="line"></div>
       
</div>
</div>
<br><br>

<div class="row rowleft">
<?php
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Photo.inc.php';
    $dbh = DbH::getDbH();
    try {
/*        $sql  = "select caption, credit, id, imagedata, mimetype, story, tags";
        $sql .= " from photo";
        $sql .= " where credit = :email";*/
        $sql  = "select p.caption, p.credit, p.id, p.imagedata, p.mimetype, p.story, p.tags, count(v.photoid) votes";
        $sql .= " from photo p left join vote v on p.id = v.photoid ";
        $sql .= " where p.credit = :email";
        $sql .= " group by p.id";
        $q = $dbh->prepare($sql);
        $q->bindValue(':email', Authentication::getEmail());
        $q->execute();
        
        $images = array();
        while ($out = $q->fetch()) {
            $g = new Photo($out['caption'], $out['credit'], $out['id'], $out['imagedata'], $out['mimetype'], $out['story'], $out['tags']);
            $g->setVotes($out['votes']);
            array_push($images, $g);
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = "Could not get img (".$e->getMessage().")";
      //  header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    } catch (Exception $e) {
        $_SESSION['error'] = "Could not get img (".$e->getMessage().")";
      //  header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    }    
    
    foreach($images as $image){
        print("<div class='col-xs-12 col-md-2'>\n");
        print($image->getCaption()."<br />");
        echo sprintf("<a class='thumbnail' href='getImage.php?id=%s' title='%s' alt='%s'>
                        ".$image."</a>\n", 
                $image->getId(),
                $image->getStory(),
                $image->getCaption(),
                $image->getId()
            );
        print($image->getVotes()." votes\n");
        print("</div>\n");
    }
   
?>
          
   </div>
 </div>

</div><!-- /.container -->
  </body>
</html>