<?php
  define('ID_INCORRECT', '<div class="alert alert-danger" role="alert">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>Alert!</strong> Une erreur est survenue.
  </div>');

  session_start();
  require('src/connection.php');

  if(!isset($_SESSION['connect'])){
    header('location: ../');
  } elseif($_SESSION['admin'] == false) {
    if(isset($_GET['1'])){

      $req = $db->prepare('INSERT INTO commande(user_comm, prix_comm, statut_comm, menu_comm)
                           VALUES (?, ?, ?, ?)');
      $req->execute(array($_SESSION['id'], $_GET['prix'], 'preparation', $_GET['id']));

      $req = $db->query('SELECT * FROM commande WHERE id_comm=(SELECT MAX(id_comm) FROM commande)');
      while($produit = $req->fetch()){
        $idComm = $produit['id_comm'];
      }
      $req->closeCursor();

      $req = $db->prepare('INSERT INTO liste_prod_comm(id_prod, id_comm)
                           VALUES (?, ?)');
      $req->execute(array($_GET['1'], $idComm));
      if(isset($_GET['2'])){
        $req = $db->prepare('INSERT INTO liste_prod_comm(id_prod, id_comm)
                             VALUES (?, ?)');
        $req->execute(array($_GET['2'], $idComm));
      }
      if(isset($_GET['3'])){
        $req = $db->prepare('INSERT INTO liste_prod_comm(id_prod, id_comm)
                             VALUES (?, ?)');
        $req->execute(array($_GET['3'], $idComm));
      }
      header('Location: ../?commande=true#about');
    }
    if(isset($_GET['id']) && !isset($_GET['1'])){
      $id = htmlspecialchars($_GET['id']);
      $menu = array();
      $i = 0;
      foreach ( $_POST as $post => $val )  {
        $menu[$i] = $val;
        $i++;
      }
      $re = $db->prepare('SELECT * FROM menu WHERE id_menu = ?');
      $re->execute(array($id));
      if($re->rowCount() == 0){
        header('Location: shop_checkout.php?error=1');
      }
      while($prod = $re->fetch()){
        $nom = $prod['nom_menu'];
        $prix = $prod['prix_menu'];
      }
    }

    if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
		}
  } else {
    header('location: admin/');
  }
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    Document Title
    =============================================
    -->
    <title>Beel EAT | Commander</title>
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
                  <li><a href="disconnection.php">Déconnection</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="main">
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt">Commande</h1>
              </div>
            </div>
            <hr class="divider-w pt-20">
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-striped table-border checkout-table">
                  <tbody>
                    <tr>
                      <th>Item</th>
                      <th class="hidden-xs">Prix</th>
                      <th>Quantité</th>
                      <th>Total</th>
                      <th>Supprimer</th>
                    </tr>
                    <tr>
                      <td>
                        <h5 class="product-title font-alt"><?=$nom?></h5>
                        <?php
                          foreach ($menu as $prod) {
                            $re = $db->prepare('SELECT * FROM produit WHERE id_prod = ?');
                            $re->execute(array($prod));
                            while($produit = $re->fetch()){
                              echo '<h6>'.$produit['nom_prod'].'</h6>';
                            }
                          }
                        ?>
                      </td>
                      <td class="hidden-xs">
                        <h5 class="product-title font-alt"><?=$prix?>€</h5>
                      </td>
                      <td>
                        <input class="form-control" type="number" name="" value="1" max="50" min="1"/>
                      </td>
                      <td>
                        <h5 class="product-title font-alt"><?=$prix?>€</h5>
                      </td>
                      <td class="pr-remove"><a href="#" title="Remove"><i class="fa fa-times"></i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3 col-sm-offset-9">
                <div class="form-group">
                  <a class="btn btn-block btn-round btn-d pull-right" href="shop_checkout.php?<?php
                      $i = 1;
                      echo 'id='.$id.'&prix='.$prix;
                      foreach ($menu as $prod) {
                        echo '&'.$i.'='.$prod;
                        $i++;
                      }
                    ?>">Valider la commande</a>
                </div>
              </div>
            </div>
            <hr class="divider-w">
            <div class="row mt-70">
              <div class="col-sm-5 col-sm-offset-7">
                <div class="shop-Cart-totalbox">
                  <h4 class="font-alt">Total commande</h4>
                  <table class="table table-striped table-border checkout-table">
                    <tbody>
                      <tr>
                        <th>Total de la commande :</th>
                        <td><?=$prix?>€</td>
                      </tr>
                      <tr>
                        <th>Frais de livraisons :</th>
                        <td>0.00€</td>
                      </tr>
                      <tr class="shop-Cart-totalprice">
                        <th>Total :</th>
                        <td><?=$prix?>€</td>
                      </tr>
                    </tbody>
                  </table>
                  <button class="btn btn-lg btn-block btn-round btn-d" type="submit">Valider la commande</button>
                </div>
              </div>
            </div>
          </div>
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