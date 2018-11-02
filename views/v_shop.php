
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

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
<?php require_once(PATH_VIEWS.'footer.php');?>
