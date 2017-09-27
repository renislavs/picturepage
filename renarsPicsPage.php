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
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="css/lightbox.min.css">

    <title>PictureView</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">

    
  <style>
  .nav  {
    float: right;
  }
body{
  background-color: white!important;
  background-image: none;
}
.rowmar{
margin-top: 20px;
}
.title {
  text-align: center;
}
.h4text {
  color: black;
  font-size: 15px;
}
.dropdown{
  
  margin-left: 16px;
  margin-bottom: 16px;
  
}
  </style>
  </head>

  <body>
    
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img id="logo" src="Logo.png"></a>
    </div>
    <ul class="nav navbar-nav">
      
      <li><a href="#">Upload</a></li>
      <li><a href="#">SignOut</a></li>
      
    </ul>
  </div>
</nav>

    <div class="container">
    <h1 class="title">Se all our pictures</h1>

  <div class="row center">

    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sort images
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="#">Random</a></li>
    <li><a href="#">Highest ratet</a></li>
    
  </ul>
  </div>

 </div>
      <div class="row">
          <div class="col-sm-3 col-md-3">
             <a href="img/1.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.Click the right half of the image to move forward.Click the right half of the image to move forward."><img class="example-image" src="img/1.jpg" width="200" height="150" alt=""/></a>
            <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>
          </div>

           <div class="col-sm-3 col-md-3">
            
             <a href="img/2.jpg" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard."><img class="example-image" src="img/2.jpg" width="200" height="150" alt="" /></a> 
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>

          </div>

           <div class="col-sm-3 col-md-3">
            
             <a href="img/3.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="img/3.jpg" width="200" height="150" alt="" /></a>
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>

          </div>

           <div class="col-sm-3 col-md-3">
            
             <a href="img/4.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="img/4.jpg" width="200" height="150" alt="" /></a>
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>

          </div>




   </div>



   <div class="row rowmar">




          <div class="col-sm-3 col-md-3">
            
             <a href="img/5.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="img/5.jpg" width="200" height="150" alt="" /></a>
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>



          </div>

           <div class="col-sm-3 col-md-3">
            
             <a href="./img/Logo.png" data-lightbox="example-set" 
                data-title="The next image in the set is preloaded as you're viewing.">
                 <img class="example-image" src="./img/Logo.png" width="200" height="150" alt="" />
             </a> 
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>

          </div>

           <div class="col-sm-3 col-md-3">
            
             <a href="img/7.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="img/7.jpg" width="200" height="150" alt="" /></a> 
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button>

          </div>

           <div class="col-sm-3 col-md-3">
            
             <a href="img/8.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="img/8.jpg" width="200" height="150" alt="" /></a> 
             <button type="button" class="btn btn-default"><a href="#">VOTE</a></button> 

          </div>






   </div>




  







    </div><!-- /.container -->

<script src="dist/js/lightbox-plus-jquery.min.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>