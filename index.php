<?php
    session_start();
    require_once './includes/Photo.inc.php';
    require_once './includes/Authentication.inc.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">     
        <title>PicturePage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Upload and vote on pictures">
        <meta name="author" content="Group 7">
        <link rel="stylesheet" type="text/css" href="./css/modalStyle.css">
        <link rel="stylesheet" href="./css/lightbox.min.css">
        <link href="./css/popupCSS.css" rel="stylesheet">
        <link rel="icon" href="./img/favicon.ico">
        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">
        <link href="./css/mystyle.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="./js/modalFunc.js"></script> 
        <script src="./js/magnificpopup.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <script>
         $(document).ready(function() {
       $('.thumbnail').magnificPopup({
           type:'image',
           gallery:{
             enabled:true
           }
       });
     });
         </script>
        <script>
            'use strict'; // use correct syntax in js. Helps us find issues in js
            var check = function (e) {
               
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var email = document.forms.formalia.email.value;
                if (!re.test(email))
                {
                    document.getElementById("err").innerHTML = "Email is not correct";
                    document.forms.formalia.email.focus();
                    e.preventDefault();
                    return false;      
                }
                if (document.forms.formalia.password.value !== 
                                   document.forms.formalia.password2.value) {
                    document.forms.formalia.password.focus();
                    document.getElementById("err").innerHTML = "Two password entries differ";
                    e.preventDefault(); 
                    return false;       
                } 
                return true;
            };
            var init = function () {
                document.forms.formalia.addEventListener('submit', check);
            };
            window.addEventListener('load', init);
        </script>
    </head>
    <body>
   
<?php
    include './includes/menu.inc.php';
?>
<div class="container">
      
<?php              
if (!Authentication::isAuthenticated()) {
                  
?>    
    <div class="row">
          <div class="col-sm-6 col-md-6 reg"> 
                <h4 class="title3">Log in</h4>
                <form class="container frontinput" action="testLogin.php" method="post">
                    <input type="text" placeholder="Enter email" name="email" required>
                    <input type="password" placeholder="Enter Password" name="password" required><br />
                    <button>Submit</button>
<?php
                if(isset($_SESSION['login_error_msg'])) {
                    printf("<br /><label class='err'>%s.</label>\n", $_SESSION['login_error_msg']);
                    unset( $_SESSION['login_error_msg']);
                }
                if(isset($_SESSION['errmsg'])) {
                    printf("<br /><label class='err'>%s.</label>\n", $_SESSION['errmsg']);
                    unset( $_SESSION['errmsg']);
                }
?>
                </form>
              </div>
               <div class="col-sm-6 col-md-6 reg">
                   <h4 class="title3">Register</h4><br />
                <button id="myBtn">Sign me up</button>
              </div>
            </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content --> 
      <div class="modal-content">
        <span class="close">&times;</span>
        <p>You are about to register</p>
        <form id='formalia' class="container" method="post" action="/PicturePage/createVoterDb.php">
            <label><b>Firstname *</b></label><br />
            <input type="text" placeholder="Enter firstname" name="firstname" required><br />
            <label><b>Email *</b></label><br />
            <input type="text" placeholder="Enter email" name="email" id="email" required><br />
            <label><b>Password *</b></label><br />
            <input type="password" placeholder="Enter Password" name="password" required><br />
            <label><b>Confirm password *</b></label><br />
            <input type="password" placeholder="Enter Password" name="password2" required><br />
            <label id="err" style="color:red"></label>
            
            <button type="submit" name="createAccountBt">Create</button>
        </form>
      </div>
    </div>      
    
    
<?php
    } else {// end !authenticated
    // See all pictures
?>
    <form action="index.php" method="post">
        <input type="checkbox" name="sorted" onChange="this.form.submit()" /> <p style="color: white;">Show me sorted pictures </p>
    </form>
    <br /><br /> 
    <br />
<?php    
    require_once './includes/DbP.inc.php';
    require_once './includes/DbH.inc.php';
    require_once './includes/Photo.inc.php';
    $dbh = DbH::getDbH();
    try {
        $sql  = "select p.caption, p.credit, p.id, p.imagedata, p.mimetype, p.story, p.tags, count(v.photoid) votes";
        $sql .= " from photo p left join vote v on p.id = v.photoid ";
        $sql .= " group by p.id";
        if (isset($_POST['sorted'])) {
            $sql .= " order by count(v.photoid) DESC"; // random order        
        } else {
            $sql .= " order by RAND()"; // random order        
        }
        $q = $dbh->prepare($sql);
        $q->bindValue(':email', Authentication::getEmail());
        $q->execute();
       
    } catch(PDOException $e) {
        $_SESSION['error'] = "Could not get image (".$e->getMessage().")";
        header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    } catch (Exception $e) {
        $_SESSION['error'] = "Could not get image (".$e->getMessage().")";
        header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    }
    
    $images = array();
    while ($out = $q->fetch()) {
        $g = new Photo($out['caption'], $out['credit'], $out['id'], $out['imagedata'], $out['mimetype'], $out['story'], $out['tags']);
        $g->setVotes($out['votes']);
        array_push($images, $g);
    }

    // Get votes - so that user cannot vote on the same picture twice
        try {
        $sql  = "select photoid";
        $sql .= " from vote";
        $sql .= " where voter = :email";
        $q2 = $dbh->prepare($sql);
        $q2->bindValue(':email', Authentication::getEmail());
        $q2->execute();
       
    } catch(PDOException $e) {
        $_SESSION['error'] = "Could not get vote (".$e->getMessage().")";
      //  header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    } catch (Exception $e) {
        $_SESSION['error'] = "Could not get vote (".$e->getMessage().")";
      //  header('Location: ./profilPage.php?'.$e->getMessage());
        die("Reading failed.<br />".$sql."<br />".$e->getMessage());
    }
    
    $a2 = array();
    while ($out2 = $q2->fetch()) {
        array_push($a2, $out2['photoid']);
    }
    
    print("<div class='row'>"); 
    foreach($images as $image){

        print("<div class='col-xs-12 col-md-2' style='height:375px; width:200px;'>");
        print("<p class='captext'>Name: ".$image->getCaption()."</p><p class='captext'>By: ".$image->getCredit()."</p><p class='captext'>Votes: ".$image->getVotes()."</p>");
        echo sprintf("<a class='thumbnail' href='getImage.php?id=%s' title='%s' alt='%s'>
                        ".$image."</a>\n", 
                $image->getId(),
                $image->getStory(),
                $image->getCaption(),
                $image->getId()                           
            );
        if (!in_array($image->getId(), $a2)) {
            print("<a class='votebutton' href='makeVoteDb.php?photoid=".$image->getId()."'>VOTE</a>\n");
        }
        print("</div>\n");
        //print("<br />");
    }
    print("</div>\n");
?>    
    
<?php
    } // end authenticated - see pics
?>    
    </div><!-- /.container -->
   
</html>
