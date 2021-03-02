 <?php require("_header.php"); ?> 
 <!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplefok</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="css/favicon.png">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

  </head>

  <body>
  <!-- Inclusion du header de la page -->
  <?php require("header.php"); ?>  


    <div class="container">
      <!-- Inclusion des messages flash -->
      <?php require("includes/flashMessage.php"); ?> 
      <br>
      <div class="row entete-page" >
        <h1>APLEFOK</h1>
      </div>
    <br>
    <!-- /courroussel -->
    <div class="row">
      <div class="col-lg-12">
        <div id="carousel" class="carousel slide" >
          <div class="carousel-inner thumbnail">
        <div class="item active"> <img alt="" src="img/slide1.png"><h1 class="carousel-caption" style="color:red;">Une présentation</h1></div>
        <div class="item"> <img alt="" src="img/slide2.png"></div>
        <div class="item"> <img alt="" src="img/slide3.png"></div>
          </div>
          <a class="left carousel-control" href="#carousel" data-slide="prev">
      <span class="icon-prev"></span>
          </a>
          <a class="right carousel-control" href="#carousel" data-slide="next">
      <span class="icon-next"></span>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h1>Présentation</h1>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
    </div> <!-- /container -->

    <!-- Inclusion du footer de la page -->

  <script>
      $(document).ready(function(){

        //Gestion du slider
        $(function () {
          $('.carousel').carousel({ interval: 2000 });

        });
        $('.carousel').mouseover(function() {
          $('.carousel').carousel('pause');
        });
        $('.carousel').mouseout(function() {
          $('.carousel').carousel('cycle');
        });

      });
  </script>
  </body>
</html>
