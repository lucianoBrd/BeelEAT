
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

<div class="main">
  <section class="module-small">
    <div class="container">
      <form method="post" action="?page=newComm<?=isset($id)?'&id='.$id:''?>" enctype="multipart/form-data">
      <div class="row">

        <?php require_once(PATH_VIEWS.'alert.php');?>

        <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title font-alt"><?=$menu != null?$menu->getNom():''?></h2>
          <div class="module-subtitle font-serif"><?=$menu != null?$menu->getPrix():''?>€</div>
          <div class="module-subtitle font-serif">Sandwich</div>
          <input type="text" name="sandwich" placeholder="" value="" style="display: none;">
        </div>
      </div>
      <div class="row multi-columns-row">
        <?php
          foreach ($prodListe as $produit) {
            if($produit[0]->getType() == 'sandwich'){
              echo '<div class="col-sm-6 col-md-3 col-lg-3">
                <div class="shop-item">
                  <div class="shop-item-image"><img src="'.$produit[1]->getLink().'" alt="'.$produit[1]->getName().'"/>
                    <div class="shop-item-detail"><button name="sandwich" class="btn btn-round btn-b choose" value="'.$produit[0]->getProdId().'"><span class="icon-basket">Choisir</span></button></div>
                  </div>
                  <h4 class="shop-item-title font-alt">'.$produit[0]->getNom().'</h4>
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
            foreach ($prodListe as $produit) {
              if($produit[0]->getType() == 'boisson'){
                echo '<div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="shop-item">
                    <div class="shop-item-image"><img src="'.$produit[1]->getLink().'" alt="'.$produit[1]->getName().'"/>
                      <div class="shop-item-detail"><button name="boisson" class="btn btn-round btn-b choose" value="'.$produit[0]->getProdId().'"><span class="icon-basket">Choisir</span></button></div>
                    </div>
                    <h4 class="shop-item-title font-alt">'.$produit[0]->getNom().'</h4>
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
            foreach ($prodListe as $produit) {
              if($produit[0]->getType() == 'dessert'){
                echo '<div class="col-sm-6 col-md-3 col-lg-3">
                  <div class="shop-item">
                    <div class="shop-item-image"><img src="'.$produit[1]->getLink().'" alt="'.$produit[1]->getName().'"/>
                      <div class="shop-item-detail"><button name="dessert" class="btn btn-round btn-b choose" value="'.$produit[0]->getProdId().'"><span class="icon-basket">Choisir</span></button></div>
                    </div>
                    <h4 class="shop-item-title font-alt">'.$produit[0]->getNom().'</h4>
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
