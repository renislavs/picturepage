<?php
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    $dbh = DbH::getDbH();

    foreach($_GET as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    if(isset($id)) {
            $sql  = "select caption, credit, id, imagedata, mimetype, story, tags";
            $sql .= " from photo";
            $sql .= " where id = :id";
        try {    
            $q = $dbh->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
            $out = $q->fetch();
        } catch(PDOException $e)  {
            printf("Error getting image.<br/>". $e->getMessage(). '<br/>' . $sql);
            die('');
        }

        $out['imagedata'] = stripslashes($out['imagedata']);
        header("Content-type: " . $out['mimetype']);
        echo $out['imagedata'];	
    } else {
        echo 'X';
    }
    