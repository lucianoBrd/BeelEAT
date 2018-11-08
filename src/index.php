<?php
  define('favicons', '<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/logo.png">
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
  <meta name="theme-color" content="#ffffff">');

  define('stylesheets', '<!-- Default stylesheets-->
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
  <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet">');

  define('titre', 'Beel EAT');
  define('separateur', ' | ');
  define('page', 'Se connecter');
  define('chargement', 'Loading...');
  define('navMenu', 'Toggle navigation');
  define('menuAccueil', 'Accueil');
  define('menuAccueilCommander', 'Commander');
  define('menuAccueilInscription', 'Inscription');
  define('menuCompte', 'Mon compte');
  define('menuCompteInfo', 'Informations');
  define('boutonConnexion', 'Connexion');
  define('oublie', 'Mot de passe oublié ?');
  define('autoConnect', 'Connexion automatique');

  define('erreur', '<div class="alert alert-danger" role="alert">
  <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Authentification impossible.
  </div>');
  define('success', '<div class="alert alert-success" role="alert">
  <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Succès!</strong> Vous etes maintenant connecte.
  </div>');
  define('COMMANDE_FALSE', '<div class="alert alert-danger" role="alert">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Une erreur est survenue.
  </div>');
  define('COMMANDE_TRUE', '<div class="alert alert-success" role="alert">
  <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Succès!</strong> Votre commande à bien été passée, vous allez recevoir un email avec tous les détails.
  </div>');

  define('footer', '<hr class="divider-d">
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
  <script src="assets/js/main.js"></script>');

  session_start();
  require('src/connection.php');

  // Verifie si cookie existe
  if(!empty($_COOKIE['log']) && !isset($_SESSION['connect'])){
    $log = htmlspecialchars($_COOKIE['log']);

    $req = $db->prepare('SELECT * FROM users WHERE key_secret = ?');
    $req->execute(array($log));
    while($user = $req->fetch()){
      if($user['pseudo'] != null){
        $_SESSION['connect'] = 1;
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        header('location: ../?success=1');
      }
    }
    $req->closeCursor();
  }

  if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $error    = 1;

    // Crypter
    $password = "aq1".sha1($password."1254")."25";

    $req = $db->prepare('SELECT * FROM users WHERE email = ?');
    $req->execute(array($email));

    while($user = $req->fetch()){
      //print_r(users): print_r afficher tableau
      if($password == $user['password']){
        $_SESSION['connect'] = 1;
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        $error = 0;
        // Creer cookie
        if(isset($_POST['check_connect'])){
          setcookie('log', $user['key_secret'], time() + 365*24*3600, null, null, false, true);
        }
        header('location: ../?success=1');
      }
    }
    if($error == 1){
      header('location: ../?error=1&email='.$email.'');
    }
    $req->closeCursor();

  }

?>
<?php
  if(!isset($_SESSION['connect'])){
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
  <title><?= titre.separateur.page ?></title>
  <!--
  Favicons
  =============================================
  -->
  <?= favicons ?>
  <!--
  Stylesheets
  =============================================

  -->
  <?= stylesheets ?>
</head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader"><?= chargement ?></div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only"><?= navMenu ?></span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="../"><?= titre ?></a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a class="dropdown-toggle" href="../" data-toggle="dropdown"><?= menuAccueil ?></a>
                <ul class="dropdown-menu">
                  <li><a href="#commande"><?= menuAccueilCommander ?></a></li>
                  <li><a href="inscription.php"><?= menuAccueilInscription ?></a></li>
                </ul>
              </li>

              <li class="dropdown"><a class="dropdown-toggle" href="documentation.html" data-toggle="dropdown"><?= menuCompte ?></a>
                <ul class="dropdown-menu">
                  <li><a href=""><?= menuCompteInfo ?></a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="../"><button class="btn btn-border-w btn-round btn-xs pull-left" type="button"><?= boutonConnexion ?></button>&nbsp;</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="main">
        <section class="module bg-dark-30" data-background="assets/images/section-1.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0"><?= page ?></h1>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 mb-sm-40">
                <?php
                  if(isset($_GET['error'])){
                    echo erreur;
                  } else if(isset($_GET['success'])){
                    echo success;
                  }
                ?>
                <h4 class="font-alt"><?= page ?></h4>
                <hr class="divider-w mb-10">
                <form class="form" method="post" action="../">
                  <div class="form-group">
                    <input class="form-control" id="E-mail" required type="text" name="email" placeholder="E-mail" value="<?= isset($_GET['email']) ? $_GET['email'] : '' ?>"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="password" required type="password" name="password" placeholder="Password"/>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-block btn-round btn-b"><?= boutonConnexion ?></button>
                  </div>
                  <div class="form-group"><a href=""><?= oublie ?></a></div>
                  <div class="checkbox">
                    <label>
                      <input checked type="checkbox" value="" name="check_connect">
                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                      <?= autoConnect ?>
                    </label>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
        <?= footer ?>
  </body>
</html>
<?php
} elseif ($_SESSION['admin'] == false) {
  if(isset($_GET['commande'])){
    $commande = htmlspecialchars($_GET['commande']);
  }
  $req = $db->prepare('SELECT * FROM produit JOIN image ON image.produit_id = produit.id_prod WHERE statut_prod = "publie"');
  $req->execute(array());
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
          <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="../">Beel EAT</a>
              </div>
              <div class="collapse navbar-collapse" id="custom-collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown"><a class="dropdown-toggle" href="../" data-toggle="dropdown">Accueil</a>
                    <ul class="dropdown-menu">
                      <li><a class="section-scroll" href="#commande">Commander</a></li>
                      <li><a href="inscription.php">Inscription</a></li>
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
                <div class="font-alt mb-30 titan-title-size-1">Hello <?= $_SESSION['pseudo'] ?></div>
                <div class="font-alt mb-40 titan-title-size-4">Beel EAT</div><a class="section-scroll btn btn-border-w btn-round" href="#commande">Commander</a>
              </div>
            </div>
          </section>
          <div class="main">
            <section class="module" id="about">
              <div class="container">
                <div class="row">
                  <?php
                    if(isset($commande)){
                      switch($commande){
                        case 'true' : echo COMMANDE_TRUE;
                                      break;
                        case 'false' : echo COMMANDE_FALSE;
                                       break;
                      }
                    }
                  ?>
                  <div class="col-sm-8 col-sm-offset-2">
                    <h2 class="module-title font-alt">Bienvenue sur Beel EAT</h2>
                    <div class="module-subtitle font-serif large-text">Commandez votre repas en ligne et recevez une notification quand il est prêt !</div>
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
                    <h2 class="module-title font-alt">Choisissez ce que vous souhaitez.</h2>
                    <div class="module-subtitle font-serif"></div>
                  </div>
                </div>
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <ul class="filter font-alt" id="filters">
                      <li><a class="current wow fadeInUp" href="#" data-filter="*">Tous nos produits</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".menu" data-wow-delay="0.2s">Menu</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".sandwich" data-wow-delay="0.4s">Sandwich</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".boisson" data-wow-delay="0.6s">Boisson</a></li>
                      <li><a class="wow fadeInUp" href="#" data-filter=".dessert" data-wow-delay="0.6s">Dessert</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">
                <?php
                  while($produit = $req->fetch()){
                    echo '<li class="work-item '.$produit['type_prod'].'"><a href="shop_checkout.html">
                        <div class="work-image"><img src="'.$produit['link'].'" alt="'.$produit['img_name'].'"/></div>
                        <div class="work-caption font-alt">
                          <h3 class="work-title">'.$produit['nom_prod'].'</h3>
                          <div class="work-descr">'.$produit['type_prod'].'</div>
                        </div></a></li>';
                  }
                  $req = $db->prepare('SELECT * FROM menu LEFT JOIN image ON image.produit_id = id_menu WHERE statut_menu = "publie"');
                  $req->execute(array());
                  while($produit = $req->fetch()){
                    if($produit['link'] == null){
                      $linkImg = 'assets/images/section-1.jpg';
                    } else {
                      $linkImg = $produit['link'];
                    }
                    echo '<li class="work-item menu"><a href="shop.php?id='.$produit['id_menu'].'">
                        <div class="work-image"><img src="'.$linkImg.'" alt="'.$produit['img_name'].'"/></div>
                        <div class="work-caption font-alt">
                          <h3 class="work-title">'.$produit['nom_menu'].'</h3>
                          <div class="work-descr">Menu</div>
                        </div></a></li>';
                  }
                ?>

              </ul>
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

<?php
} else {
  header('location: admin/');
}
?>