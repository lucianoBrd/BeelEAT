
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

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

<?php require_once(PATH_VIEWS.'footer.php');?>
