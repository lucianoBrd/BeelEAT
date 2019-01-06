
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

        <?php require_once(PATH_VIEWS.'alert.php');?>

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
        foreach($menuImgListe as $menu){
          echo '<li class="work-item menu"><a href="?page=shop&id='.$menu[0]->getMenuId().'">
              <div class="work-image"><img src="'.$menu[1]->getLink().'" alt="'.$menu[1]->getName().'"/></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">'.$menu[0]->getNom().'</h3>
                <div class="work-descr">Menu</div>
              </div></a></li>';
        }
        foreach($produitImgListe as $produit){
          $href = '?page=checkout&id='.$produit[0]->getProdId();
          if($produit[0]->getType() == "sandwich"){
            $href = '?page=shop&prod='.$produit[0]->getProdId();
          }
          echo '<li class="work-item '.$produit[0]->getType().'"><a href="'.$href.'">
              <div class="work-image"><img src="'.$produit[1]->getLink().'" alt="'.$produit[1]->getName().'"/></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">'.$produit[0]->getNom().'</h3>
                <div class="work-descr">'.$produit[0]->getType().'</div>
              </div></a></li>';
        }
      ?>

    </ul>
  </section>

<?php require_once(PATH_VIEWS.'footer.php');?>
