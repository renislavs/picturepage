<?php
    session_start();
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Authentication.inc.php';
    $dbh = DbH::getDbH();

    foreach($_GET as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    if(isset($photoid)) {
      //  $sql = 'IF NOT EXISTS(SELECT photoid FROM vote WHERE photoid != :photoid and voter != :voter) BEGIN';
        $sql = ' insert into vote (photoid, voter)';
        $sql .= ' values(:photoid, :voter);';
        //$sql .= ' END';
        try {
          $q = $dbh->prepare($sql);
          $q->bindValue(':photoid', $photoid);
          $q->bindValue(':voter', Authentication::getEmail());
          $q->execute();
        } catch(PDOException $e) {
            $_SESSION['error'] = "Could not create vote (".$e->getMessage().")";
            header('Location: ./index.php?'.$e->getMessage());
            die("Posting failed. <br />".$e->getMessage());
        } catch (Exception $e) {
            $_SESSION['error'] = "Could not create vote (".$e->getMessage().")";
            header('Location: ./index.php?'.$e->getMessage());
            die("Posting failed. <br />".$e->getMessage());
        }
        header('Location: ./index.php?voteinserted');
        
    } else {
        header('Location: ./index.php?voteNOTinserted');
    }
    
    