<?php
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    $dbh = DbH::getDbH();
    
    foreach($_POST as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    
    //TODO: Serverside alidation of user input:
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
        $_SESSION['error'] = "Could not create user (".$e->getMessage().")";
        header('Location: ./index.php?'.$e->getMessage());
        die("Posting failed. <br />".$e->getMessage());
    } catch (Exception $e) {
        $_SESSION['error'] = "Could not create user (".$e->getMessage().")";
        header('Location: ./index.php?'.$e->getMessage());
        die("Posting failed. <br />".$e->getMessage());
    }
    header('Location: ./index.php?voterinserted');