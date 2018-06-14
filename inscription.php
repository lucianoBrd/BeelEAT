<?php
// ctrl+n -> new fichier
// peut utiliser structure mvc pour php pour les fichiers
  session_start();
  // On a besoin de ce fichier : on l'implemente au debut de ce code
  require('src/connection.php');

  if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
    $pseudo           = $_POST['pseudo'];
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $error = 0;

    // Test mdp identiques
    if($password != $password_confirm){
      header('location: ../inscription.php?error=1&pass=1');
      $error = 1;
    }

    // Test mail existe
    $req = $db->prepare('SELECT count(*) as numberEmail FROM users WHERE email = ?');
    $req->execute(array($email));

    while($email_verification = $req->fetch()){
      if($email_verification['numberEmail'] != 0){
        header('location: ../inscription.php?error=1&email=1');
        $error = 1;
      }
    }
    $req->closeCursor();

    if($error == 0){
      // Hash
      $secret = sha1($email).time();
      $secret = sha1($secret).time().time();

      // Crypatge Mdp
      // Grain de sel : 1254
      $password = "aq1".sha1($password."1254")."25";

      // Envoie de la requete
      $req = $db->prepare('INSERT INTO users(pseudo, email, password, key_secret) VALUES (?, ?, ?, ?)');
      $req->execute(array($pseudo, $email, $password, $secret)) or die(print_r($req->errorInfo()));
      header('location: ../inscription.php?success=1');
    }

  }

?>

<!DOCTYPE html>
<html lang="en-fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
  Document Title
  =============================================
  -->
  <title>Beel EAT | Inscription</title>
  <!--
  Favicons
  =============================================
  -->
  <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/logo.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/logo.png">
  <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/logo.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/logo.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/logo.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/logo.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/images/favicons/logo.png">
  <meta name="theme-color" content="#ffffff">
  <!--
  Stylesheets
  =============================================

  -->
  <!-- Default stylesheets-->
  <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Template specific stylesheets-->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="assets/lib/animate.css/animate.css" rel="stylesheet">
  <link href="assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
  <link href="assets/lib/flexslider/flexslider.css" rel="stylesheet">
  <link href="assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
  <link href="assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
  <link href="assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
  <!-- Main stylesheet and color file-->
  <link href="assets/css/style.css" rel="stylesheet">
  <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet">
</head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="../">Beel EAT</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a class="dropdown-toggle" href="../" data-toggle="dropdown">Accueil</a>
                <ul class="dropdown-menu">
                  <li><a href="#commande">Commander</a></li>
                  <li><a href="inscription.php">Inscription</a></li>
                </ul>
              </li>

              <li class="dropdown"><a class="dropdown-toggle" href="" data-toggle="dropdown">Mon compte</a>
                <ul class="dropdown-menu">
                  <li><a href="">Informations</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="../"><button class="btn btn-border-w btn-round btn-xs pull-left" type="button">Connexion</button>&nbsp;</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="main">
        <!--<section class="module bg-dark-30" data-background="assets/images/section-1.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">S'inscrire</h1>
              </div>
            </div>
          </div> -->
        </section>
        <section class="module module-video bg-dark-30" data-background="assets/images/section-1.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt mb-0"></h2>
              </div>
            </div>
          </div>
          <div class="video-player" data-property="{videoURL:'https://youtu.be/LvG2_aFvjVA', containment:'.module-video', startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <?php
                  if(isset($_GET['error'])){
                    if(isset($_GET['pass'])){
                      echo '<div class="alert alert-danger" role="alert">
                              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Les mots de passe ne sont pas identiques.
                            </div>';
                    } else if(isset($_GET['email'])){
                      echo '<div class="alert alert-danger" role="alert">
                              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Adresse Email deja utilisée.
                            </div>';
                    }
                  } else if(isset($_GET['success'])){
                    echo '<div class="alert alert-success" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Inscription prise en compte.
                          </div>';
                  }
                ?>
                <h4 class="font-alt">Inscription</h4>
                <hr class="divider-w mb-10">
                <form class="form" method="post" action="inscription.php">
                  <div class="form-group">
                    <input class="form-control" id="E-mail" type="text" name="email" placeholder="Email"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="username" type="text" name="pseudo" placeholder="Username"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="re-password" type="password" name="password_confirm" placeholder="Re-enter Password"/>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-block btn-round btn-b">S'inscire</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="../">Beel EAT</a>, All Rights Reserved</p>
              </div>
          </div>
        </footer>
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--
    JavaScripts
    =============================================
    -->
    <script src="assets/lib/jquery/dist/jquery.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/lib/wow/dist/wow.js"></script>
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
