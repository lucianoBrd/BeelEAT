<?php
  define('ID_INCORRECT', '<div class="alert alert-danger" role="alert">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Une erreur est survenue.
  </div>');

  session_start();
  require('src/connection.php');

  if(!isset($_SESSION['connect'])){
    header('location: ../');
  } elseif($_SESSION['admin'] == false) {
    require('admin/entities/Produit.php');
    if(isset($_GET['id'])){
      $id = htmlspecialchars($_GET['id']);
      $prod = array();
      $re = $db->prepare('SELECT * FROM liste_prod JOIN produit ON liste_prod.id_prod = produit.id_prod WHERE id_menu = ?');
      $re->execute(array($id));
      if($re->rowCount() == 0){
        header('Location: shop.php?error=1');
      }
      $i = 0;
      while($produit = $re->fetch()){
        $prod[$i] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['type_prod']);
        $i++;
      }

      $re = $db->prepare('SELECT * FROM menu WHERE id_menu = ?');
      $re->execute(array($id));
      while($menu = $re->fetch()){
        $titre = $menu['nom_menu'];
        $prix = $menu['prix_menu'];
      }
    } elseif(!isset($_GET['error'])) {
      header('Location: shop.php?error=1');
    }
    if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
		}
  } else {
    header('location: admin/');
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
  <title>Beel EAT | Shop</title>
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
        <section class="module-small">
          <div class="container">
            <form method="post" action="shop_checkout.php?id=<?=isset($id)?$id:''?>" enctype="multipart/form-data">
            <div class="row">
              <?php
        				if(isset($error)){
        					switch($error){
        						case 1: echo ID_INCORRECT;
        										break;
        					}
        				}
        			?>
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt"><?=isset($id)?$titre:''?></h2>
                <div class="module-subtitle font-serif"><?=isset($id)?$prix:''?>€</div>
                <div class="module-subtitle font-serif">Sandwich</div>
                <input type="text" name="sandwich" placeholder="" value="" style="display: none;">
              </div>
            </div>
            <div class="row multi-columns-row">
              <?php
                foreach ($prod as $produit) {
                  if($produit->getType() == 'sandwich'){
                    $req = $db->prepare('SELECT * FROM image WHERE produit_id = ?');
                    $req->execute(array($produit->getProdId()));
                    if($req->rowCount() == 0){
                      $linkImg = 'assets/images/section-1.jpg';
                      $nameImg = $produit->getNom();
                    } else {
                      while($image = $req->fetch()){
                        $linkImg = $image['link'];
                        $nameImg = $image['img_name'];
                      }
                    }
                    echo '<div class="col-sm-6 col-md-3 col-lg-3">
                      <div class="shop-item">
                        <div class="shop-item-image"><img src="'.$linkImg.'" alt="'.$nameImg.'"/>
                          <div class="shop-item-detail"><button name="sandwich" class="btn btn-round btn-b choose" value="'.$produit->getProdId().'"><span class="icon-basket">Choisir</span></button></div>
                        </div>
                        <h4 class="shop-item-title font-alt">'.$produit->getNom().'</h4>
                      </div>
                    </div>';
                  }
                }
              ?>
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                    <div class="module-subtitle font-serif">Boisson</div>
                    <input type="text" name="boisson" placeholder="" value="" style="display: none;">
                  </div>
                </div>
                <?php
                  foreach ($prod as $produit) {
                    if($produit->getType() == 'boisson'){
                      $req = $db->prepare('SELECT * FROM image WHERE produit_id = ?');
                      $req->execute(array($produit->getProdId()));
                      if($req->rowCount() == 0){
                        $linkImg = 'assets/images/section-1.jpg';
                        $nameImg = $produit->getNom();
                      } else {
                        while($image = $req->fetch()){
                          $linkImg = $image['link'];
                          $nameImg = $image['img_name'];
                        }
                      }
                      echo '<div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="shop-item">
                          <div class="shop-item-image"><img src="'.$linkImg.'" alt="'.$nameImg.'"/>
                            <div class="shop-item-detail"><button name="boisson" class="btn btn-round btn-b choose" value="'.$produit->getProdId().'"><span class="icon-basket">Choisir</span></button></div>
                          </div>
                          <h4 class="shop-item-title font-alt">'.$produit->getNom().'</h4>
                        </div>
                      </div>';
                    }
                  }
                ?>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                    <div class="module-subtitle font-serif">Dessert</div>
                    <input type="text" name="dessert" placeholder="" value="" style="display: none;">
                  </div>
                </div>
                <?php
                  foreach ($prod as $produit) {
                    if($produit->getType() == 'dessert'){

                      $req = $db->prepare('SELECT * FROM image WHERE produit_id = ?');
                      $req->execute(array($produit->getProdId()));
                      if($req->rowCount() == 0){
                        $linkImg = 'assets/images/section-1.jpg';
                        $nameImg = $produit->getNom();
                      } else {
                        while($image = $req->fetch()){
                          $linkImg = $image['link'];
                          $nameImg = $image['img_name'];
                        }
                      }

                      echo '<div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="shop-item">
                          <div class="shop-item-image"><img src="'.$linkImg.'" alt="'.$nameImg.'"/>
                            <div class="shop-item-detail"><button name="dessert" class="btn btn-round btn-b choose" value="'.$produit->getProdId().'"><span class="icon-basket">Choisir</span></button></div>
                          </div>
                          <h4 class="shop-item-title font-alt">'.$produit->getNom().'</h4>
                        </div>
                      </div>';
                    }
                  }
                ?>
            </div>
            <div class="row mt-30">
              <div class="col-sm-12 align-center"><button type="submit" class="btn btn-b btn-round" id="send">Valider</button></div>
            </div>
          </div>
        </form>
        </section>
        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">TitaN</a>, All Rights Reserved</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
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

    <script src="js/shop.js"></script>
  </body>
</html>
