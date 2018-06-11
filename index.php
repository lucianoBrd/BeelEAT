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
      header('location: ../?error=1&pass=1');
      $error = 1;
    }

    // Test mail existe
    $req = $db->prepare('SELECT count(*) as numberEmail FROM users WHERE email = ?');
    $req->execute(array($email));

    while($email_verification = $req->fetch()){
      if($email_verification['numberEmail'] != 0){
        header('location: ../?error=1&email=1');
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
      header('location: ../?success=1');
    }

  }

?>
<?php
  if(!isset($_SESSION['connect'])){
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
    <title>PHP - Bienvenue</title>
    <meta name="author" content="Luciano">
    <link type="text/css" rel="stylesheet" href="design/default.css">
  </head>
  <body>

    <header>
      <h1>Inscription</h1>
    </header>

    <div class="container">
      <p>Bienvenue sur le site, inscrivez-vous pour plus d'information.</p>
      <p id="p_marge">Deja inscrit ? <a href="connection.php">Connectez-vous</a></p>
      <?php
        if(isset($_GET['error'])){
          if(isset($_GET['pass'])){
            echo '<p id="error">Les mots de passe ne sont pas identiques.</p>';
          } else if(isset($_GET['email'])){
            echo '<p id="error">Adresse Email deja utilisée.</p>';
          }
        } else if(isset($_GET['success'])){
          echo '<p id="success">Inscription prise en compte.</p>';
        }
      ?>
      <form method="post" action="index.php">
        <table>
          <tr>
            <td>Pseudo</td>
            <td><input required class="form" placeholder="Name" type="text" name="pseudo"/></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><input required class="form" placeholder="example@domaine.com" type="email" name="email"/></td>
          </tr>
          <tr>
            <td>Mot de passe</td>
            <td><input required class="form" placeholder="********" type="password" name="password"/></td>
          </tr>
          <tr>
            <td>Confirmer mot de passe</td>
            <td><input required class="form" placeholder="********" type="password" name="password_confirm"/></td>
          </tr>
        </table>
        <button class="form, centre" id="send" type="submit" name="inscription">Inscription</button>
      </form>
    </div>
    <?php
      } else{
    ?>
    <!DOCTYPE html>
    <html lang="fr" dir="ltr">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--
        Document Title
        =============================================
        -->
        <title>Beel EAT | Accueil</title>
        <!--
        Favicons
        =============================================
        -->
        <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
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
          <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.html">Beel EAT</a>
              </div>
              <div class="collapse navbar-collapse" id="custom-collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Accueil</a>
                    <ul class="dropdown-menu">
                      <li><a href="#commande">Commander</a></li>
                      <li><a href="#commande">Inscription / Connection</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a class="dropdown-toggle" href="documentation.html" data-toggle="dropdown">Mon compte</a>
                    <ul class="dropdown-menu">
                      <li><a href="">Informations</a></li>
                      <li><a href="disconnection.php">Déconnection</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <section class="home-section home-parallax home-fade home-full-height bg-dark-30" id="home" data-background="assets/images/section-1.jpg">
            <div class="titan-caption">
              <div class="caption-content">
                <div class="font-alt mb-30 titan-title-size-1">Hello &amp; <?= $_SESSION['pseudo'] ?></div>
                <div class="font-alt mb-40 titan-title-size-4">Beel EAT</div><a class="section-scroll btn btn-border-w btn-round" href="#commande">Commander</a>
              </div>
            </div>
          </section>
          <div class="main">
            <section class="module" id="about">
              <div class="container">
                <div class="row">
                  <div class="col-sm-8 col-sm-offset-2">
                    <h2 class="module-title font-alt">Bienvenue sur Beel EAT</h2>
                    <div class="module-subtitle font-serif large-text">Commander votre repas en ligne et recevez une notification quand il est prêt !</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2 col-sm-offset-5">
                    <div class="large-text align-center"><a class="section-scroll" href="#commande"><i class="fa fa-angle-down"></i></a></div>
                  </div>
                </div>
              </div>
            </section>
            <hr class="divider-w">
            <section class="module pb-0" id="commande">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Choisissez ce que vous souhaiter.</h2>
                    <div class="module-subtitle font-serif"></div>
                  </div>
                </div>
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <ul class="filter font-alt" id="filters">
                      <li><a class="current wow fadeInUp" href="#" data-filter="*">Tout nos produits</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".menu" data-wow-delay="0.2s">Menu</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".sandwich" data-wow-delay="0.4s">Sandwich</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".boisson" data-wow-delay="0.6s">Boisson</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".dessert" data-wow-delay="0.6s">Dessert</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">
                <li class="work-item menu"><a href="portfolio-single-1.html">
                    <div class="work-image"><img src="assets/images/work-1.jpg" alt="Portfolio Item"/></div>
                    <div class="work-caption font-alt">
                      <h3 class="work-title">Plat Dessert Boisson</h3>
                      <div class="work-descr">Menu</div>
                    </div></a></li>
                <li class="work-item menu"><a href="portfolio-single-1.html">
                    <div class="work-image"><img src="assets/images/work-2.jpg" alt="Portfolio Item"/></div>
                    <div class="work-caption font-alt">
                      <h3 class="work-title">Plat Dessert</h3>
                      <div class="work-descr">Menu</div>
                    </div></a></li>
                <li class="work-item sandwich"><a href="portfolio-single-1.html">
                    <div class="work-image"><img src="assets/images/work-3.jpg" alt="Portfolio Item"/></div>
                    <div class="work-caption font-alt">
                      <h3 class="work-title">Wrap</h3>
                      <div class="work-descr">Sandwich</div>
                    </div></a></li>
                <li class="work-item sandwich"><a href="portfolio-single-1.html">
                    <div class="work-image"><img src="assets/images/work-4.jpg" alt="Portfolio Item"/></div>
                    <div class="work-caption font-alt">
                      <h3 class="work-title">Panini</h3>
                      <div class="work-descr">Sandwich</div>
                    </div></a></li>
                <li class="work-item dessert"><a href="portfolio-single-1.html">
                    <div class="work-image"><img src="assets/images/work-5.jpg" alt="Portfolio Item"/></div>
                    <div class="work-caption font-alt">
                      <h3 class="work-title">Donuts</h3>
                      <div class="work-descr">Dessert</div>
                    </div></a></li>
                <li class="work-item boisson"><a href="portfolio-single-1.html">
                    <div class="work-image"><img src="assets/images/work-6.jpg" alt="Portfolio Item"/></div>
                    <div class="work-caption font-alt">
                      <h3 class="work-title">Coca-Cola</h3>
                      <div class="work-descr">Boisson</div>
                    </div></a></li>
                    <li class="work-item boisson"><a href="portfolio-single-1.html">
                        <div class="work-image"><img src="assets/images/work-7.jpg" alt="Portfolio Item"/></div>
                        <div class="work-caption font-alt">
                          <h3 class="work-title">Orangina</h3>
                          <div class="work-descr">Boisson</div>
                        </div></a></li>
              </ul>
            </section>

            <hr class="divider-d">
            <footer class="footer bg-dark">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6">
                    <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">Beel EAT</a>, All Rights Reserved</p>
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

    <?php
      }
    ?>
  </body>
</html>
