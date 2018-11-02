
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

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
<?php require_once(PATH_VIEWS.'footer.php');?>
