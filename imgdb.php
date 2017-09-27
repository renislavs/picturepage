<?php
    session_start();    
    if(!(isset($_FILES['img']))) {
        header("Location: ./profilPage.php");
        
    } else if ($_FILES['img']['error'] > 0) { // there is a issue with fileupload - find err-code and make good msg to user
        
        if($_FILES['img']['error'] == UPLOAD_ERR_FORM_SIZE) {
            $_SESSION["errmsg"] = "The file is too big";
            

        }
        header("Location: ./profilPage.php");
        // and so on... http://php.net/manual/en/features.file-upload.errors.php
    } else {
    
    if ($_FILES['img']['size'] == 0) {
        $_SESSION["errmsg"] = "No data";
        header("Location: ./profilPage.php");
    }
    
    // Check filesize here.
   /* if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }*/
    
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Photo.inc.php';
    $dbh = DbH::getDbH(); // static invocation
    
    foreach($_POST as $key => $value) {
        $$key = trim($value);  // vars with names as in form :inch 
    }
    
    // Temporary file name stored on the server
    // Read in one gulp and addslashes
    $imagedata = addslashes(file_get_contents($_FILES['img']['tmp_name']));
    $mimetype = $_FILES['img']['type'];
    $test = Authentication::getEmail();
    $credit = $test; //Authentication::getDispvar() Authentication::email
    
    $gb = new Photo($caption, $credit, $id, $imagedata, $mimetype, $story, $tags);
    
    $sql = 'start transaction;';
    $dbh->query($sql);
    
    $sql = 'insert into photo (caption, credit, imagedata, mimetype, story, tags) values(:caption, :credit, :imagedata, :mimetype, :story, :tags);';
    try {
      $q = $dbh->prepare($sql);
      $q->bindValue(':caption', $caption); //input
      $q->bindValue(':credit', $credit);//input
      $q->bindValue(':imagedata', $imagedata);//input
      $q->bindValue(':mimetype', $mimetype);
      $q->bindValue(':story', $story);//input
      $q->bindValue(':tags', $tags);//input
      $q->execute();
    } catch(PDOException $e) {
      die("Photo posting failed.<br/>".$e->getMessage());
    }
    catch(Exception $e) {
      die("Photo posting failed.<br/>".$e->getMessage());
    }
    $sql = 'commit;';
    $dbh->query($sql);
    
    header('Location: ./profilPage.php?inserted');
    }