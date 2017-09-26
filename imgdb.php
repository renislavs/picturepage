<?php
    if (!(isset($_FILES['img']) && $_FILES['img']['size'] > 0)) {
        header("Location: ./profilPage.php");
    }
    
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
    $credit = "haffemn@gmail.com";//TODO
   // $story = "bla bla";
    
    //TODO email, credit from session
    $gb = new Photo($caption, $credit, $id, $imagedata, $mimetype, $story, $tags);
    
    $sql = 'start transaction;';
    $dbh->query($sql);
    
    $sql = 'insert into photo (caption, credit, imagedata, mimetype, story, tags) values(:caption, :credit, :imagedata, :mimetype, :story, :tags);';
    try {
      $q = $dbh->prepare($sql);
      $q->bindValue(':caption', $caption); //input
      $q->bindValue(':credit', $credit);//input
    //  $q->bindValue(':id', $id);//TODO input
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
    