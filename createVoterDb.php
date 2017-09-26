<?php
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    $dbh = DbH::getDbH();
    
    foreach($_POST as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    
    //TODO: Validation of user input:
    // Email correct, firstname only characters, two passwords the same?
    
    $sql = 'insert into voter (firstname, email, password)';
    $sql .= ' values(:firstname, :email, :password);';
    try {
      $q = $dbh->prepare($sql);
      $q->bindValue(':firstname', $firstname);
      $q->bindValue(':email', $email);
      $q->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
      $q->execute();
    } catch(PDOException $e) {
      die("Posting failed. <br/>".$e->getMessage());
    }
    header('Location: ./index.php?voterinserted');