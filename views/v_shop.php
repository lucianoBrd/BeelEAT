
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

<div class="main" id="<?=isset($id)?$id:''?>">
  <section class="module-small">
    <div class="container">
      <!--
      <form method="post" action="?page=newComm<?=isset($id)?'&id='.$id:''?>" enctype="multipart/form-data">
      !-->
      <div class="row">

        <?php require_once(PATH_VIEWS.'alert.php');?>

        <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title font-alt"><?=$menu != null?$menu->getNom():''?></h2>
          <div class="module-subtitle font-serif"><?=$menu != null?$menu->getPrix():''?>€</div>
          <div class="module-subtitle font-serif">Sandwich</div>
        </div>
      </div>
      <div class="row multi-columns-row">
        <?php
          $i=0;
          foreach ($prodListe as $produit) {
            if($produit[0]->getType() == 'sandwich'){
              $ingreListe = $listeIngreDAO->getListeIngredientById($produit[0]->getProdId());
        ?>
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="shop-item">
                  <div class="shop-item-image"><img src="<?=$produit[1]->getLink()?>" alt="<?=$produit[1]->getName()?>"/>
                    <div class="shop-item-detail"><button id="myBtn<?=$i?>" name="sandwich" class="btn btn-round btn-b choose open-modal" value="<?=$produit[0]->getProdId()?>"><span class="icon-basket">Choisir</span></button></div>
                  </div>
                  <h4 class="shop-item-title font-alt"><?=$produit[0]->getNom()?></h4>
                </div>
              </div>

              <!-- The Modal -->
              <div id="modal<?=$i?>" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close closed">&times;</span>
                  <section class="module-small">
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-3 mb-sm-20">
                          <select class="form-control" name="sauce">
                            <option value="0" selected="selected">Sauce</option>
                            <?php
                              foreach($ingreListe as $ingredient){
                                if($ingredient->getType() == 'sauce'){
                            ?>
                              <?='<option value="'.$ingredient->getIngreId().'">'.$ingredient->getNom()?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-3 mb-sm-20">
                          <div class="module-subtitle font-serif">Garniture</div>
                            <?php
                              foreach($ingreListe as $ingredient){
                                if($ingredient->getType() == 'garniture'){
                            ?>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="<?=$ingredient->getIngreId()?>" name="garniture">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                <?=$ingredient->getNom()?>
                              </label>
                            </div>
                            <?php
                              }
                            }
                            ?>
                        </div>
                        <div class="col-sm-3 mb-sm-20">
                          <select class="form-control" name="viande">
                            <option value="0" selected="selected">Viande</option>
                            <?php
                              foreach($ingreListe as $ingredient){
                                if($ingredient->getType() == 'viande'){
                            ?>
                            <li>
                              <?='<option value="'.$ingredient->getIngreId().'">'.$ingredient->getNom()?></option>
                            </li>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <div class="btn btn-block btn-round btn-g closed sousChoix">Choisir</div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>

              </div>


        <?php
            $i++;
            }
          }
        ?>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="module-subtitle font-serif">Boisson</div>
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
        <div class="col-sm-12 align-center"><button class="btn btn-b btn-round" id="send">Valider</button></div>
      </div>
    </div>
  <!--
  </form>
  !-->
  </section>

<?php require_once(PATH_VIEWS.'footer.php');?>
