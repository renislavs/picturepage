<?php

if(!session_start()){
    session_start();
}
    
   
error_reporting(E_ALL);
//define user friendly EOL for friendlier PHP output
if (!defined('EOL')) {
    define('EOL', '<br />' . PHP_EOL);
}

//-------

    //Check to see if the user posted anything oh and check if ALL the required fields are set...
    if ((     
            (isset($_FILES['images']))
        )) {
       
    $errors = [];
    unset($_SESSION['errors']);
        
        //to check if images are there
        try {
            if(!is_uploaded_file($_FILES['images']['tmp_name'])){
                $errors[] = 'No Image...';
            }
        } catch (Exception $ex) {
            $_SESSION['errors'] = $errors;
            header('location: ./upload.php?x=2');
            exit('You\'re not supposed to see me unless you\'re doing something you are not supposed to do.... '); //It's general good practice to FORCE exit of the code to ensure nothing else gets run!
        }
        
            //to validate each details.
            if(isset($_POST['caption']) && ($_POST['caption'] != '' || null)){
                $caption = $_POST['caption'];
            }else {
                $errors[] = 'You\'re missing a caption...';
            }
            
            if($_POST['credit'] && ($_POST['credit'] != '' || null)){
                $credit = $_POST['credit'];
            }else {
                $errors[] = 'You havn\'t given credit.... slacker';
            }
            
            if($_POST['story'] && ($_POST['story'] != '' || null)){
                $credit = $_POST['story'];
            }else {
                $errors[] = 'You havn\'t give the story';
            }
            
            if($_POST['tags'] && ($_POST['tags'] != '' || null)){
                $credit = $_POST['tags'];
            }else {
                $errors[] = 'Please put some tags. etc summer, red, tree';
            }
            
        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;
            header('location: ./upload.php?x=2');
            exit('You\'re not supposed to see me unless you\'re doing something you are not supposed to do.... '); 
        } //It is good practice to FORCE exit of the code to ensure nothing else gets run! 

        
            require_once './includes/DbP.inc.php';
            require_once './includes/DbH.inc.php';
            require_once './includes/images.inc.php';
            $dbh = DbH::getDbH();

        
            extract($_POST); //Et'Viola' a super function
            
            $img = new Images();
            $img->setCaption($caption);
            $img->setStory($story);
            $img->setTags($tags);
            $img->setCredit($credit);

            // Temporary file name stored on the server
            // Read in one gulp and addslashes
            if(!empty($_FILES['images']['tmp_name']) 
             && file_exists($_FILES['images']['tmp_name'])) {
                
                $images= file_get_contents($_FILES['images']['tmp_name']);
                $imagetype = $_FILES['images']['type'];
            }

           $sql = 'start transaction;';
           $dbh->query($sql);

            //insert the image data in database
            $sql = 'insert into photo (caption,imagedata,mimetype,story,tags,credit) values( :caption,  :imagedata, :mimetype, :story, :tags, :credit);';
            try {
              $q = $dbh->prepare($sql);
              $q->bindValue(':caption', $img->getCaption());
              $q->bindValue(':imagedata', $images, PDO::PARAM_LOB); //Needs the PARAM:LOB to "Stream" the data to the database
              $q->bindValue(':mimetype', $imagetype);
              $q->bindValue(':story', $img->getStory());
              $q->bindValue(':tags', $img->getTags());
              $q->bindValue(':credit', $img->getCredit());
              $q->execute();
              
                $sql = 'commit;';
                $dbh->query($sql);
                header('Location: ./gallery.php?inserted');
            } catch (Exception $e) {
              die("Posting failed. Call a friend IMG.<br/>".$e->getMessage());
            }

    
    }else {
        header("Location: ./upload.php?x=1");
    }