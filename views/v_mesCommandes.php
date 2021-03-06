
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

<section class="module">
  <div class="container">
    <div class="row">

      <h4 class="font-alt mb-0">Mes Commandes</h4>
      <hr class="divider-w mt-10 mb-20">
      <div class="panel-group" id="accordion">
      <?php
        require_once(PATH_VIEWS.'alert.php');
        $i=sizeof($listeComm);
        foreach ($listeComm as $commande) {
      ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title font-alt"><a <?= $i!=sizeof($listeComm)? 'class="collapsed"' : ''?> data-toggle="collapse" data-parent="#accordion" href="#comm<?=$i?>">Commande <?=$commande[0]->getCommId().' '.$commande[0]->getDateComm()?></a></h4>
            </div>
            <div class="panel-collapse collapse <?= $i==sizeof($listeComm)? 'in' : ''?>" id="comm<?=$i?>">
              <div class="panel-body">
                <table class="table table-striped table-border checkout-table">
                  <tbody>
                    <tr>
                      <th>Item</th>
                      <th class="hidden-xs">Prix</th>
                      <th>Quantité</th>
                      <th>Total</th>
                      <th>Statut</th>
                    </tr>
                    <tr>
                      <td>
                        <h5 class="product-title font-alt"><?=sizeof($commande) == 4?$commande[1]->getNom():$commande[1][0]->getNom()?></h5>
                        <?php
                          if(sizeof($commande) == 4){
                            if($commande[2] != null){
                              foreach ($commande[2] as $prod) {
                                echo '<h6>'.$prod[0]->getNom().'</h6>
                                      <img src="'.$prod[1]->getLink().'" alt="'.$prod[1]->getName().'"/>';
                                if($prod[0]->getType() == "sandwich" && $commande[3] != null){
                                  echo '<ul>';
                                  foreach ($commande[3] as $ingre) {
                                    echo '<li><h7>'.$ingre->getNom().'</h7></li>';
                                  }
                                  echo '</ul>';
                                }
                              }
                            }
                          } else {
                            echo '<h6>'.$commande[1][0]->getNom().'</h6>
                                  <img src="'.$commande[1][1]->getLink().'" alt="'.$commande[1][1]->getName().'"/>';
                            if($commande[1][0]->getType() == "sandwich" && $commande[2] != null){
                              echo '<ul>';
                              foreach ($commande[2] as $ingre) {
                                echo '<li><h7>'.$ingre->getNom().'</h7></li>';
                              }
                              echo '</ul>';
                            }
                          }
                        ?>
                      </td>
                      <td class="hidden-xs">
                        <h5 class="product-title font-alt"><?=sizeof($commande) == 4?$commande[1]->getPrix():$commande[1][0]->getPrix()?>€</h5>
                      </td>
                      <td>
                        <input class="form-control" type="number" name="" value="1" readonly=""/>
                      </td>
                      <td>
                        <h5 class="product-title font-alt"><?=sizeof($commande) == 4?$commande[1]->getPrix():$commande[1][0]->getPrix()?>€</h5>
                      </td>
                      <td>
                        <h5 class="product-title font-alt"><?=$commande[0]->getStatutComm()?></h5>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      <?php
        $i--;
        }
      ?>
        </div>
      </div>
    </div>
  </div>
</section>



<?php require_once(PATH_VIEWS.'footer.php');?>
