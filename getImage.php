<?php
//
// Author: Emma Vogensen
// Made on: 18-Sep-2017 @ 13:29:53
// Orgranisation: IBA
//

    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
     $dbh = DbH::getDbH();

    foreach($_GET as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    
    if(isset($caption)&& isset ($story)) {
            $sql  = "select caption, imagesdata, mimetype, story, tags, credit";
            $sql .= " from photo";
            $sql .= " order by random()";
            $sql .= " limit 15";
        try {    
            $q = $dbh->prepare($sql);
            
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
        echo 'this is not working!';
    }
    
    