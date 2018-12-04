<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'ProduitDAO.php');
    require_once(PATH_MODELS.'ImageDAO.php');
    require_once(PATH_ENTITY.'Produit.php');
    require_once(PATH_ENTITY.'Image.php');
    $produitDAO = new ProduitDAO();
    $imageDAO = new ImageDAO();

    if(!isset($_GET['id'])){
			if(isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['statut']) && isset($_POST['type']) && isset($_POST['prix'])){
				if(!empty($_POST['nom']) && !empty($_POST['quantite']) && !empty($_POST['statut']) && !empty($_POST['type']) && !empty($_POST['prix'])){

					$error = false;
			    $nom 			= htmlspecialchars($_POST['nom']);
					$quantite = htmlspecialchars($_POST['quantite']);
					$statut 	= htmlspecialchars($_POST['statut']);
					$type 	= htmlspecialchars($_POST['type']);
					$prix 	= htmlspecialchars($_POST['prix']);

          if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

						if($_FILES['image']['size'] <= 3000000){
				      $informationsImage = pathinfo($_FILES['image']['name']);
				      $extentionImage    = $informationsImage['extension'];
				      $extentionsAccepte = array('png', 'jpg', 'jpeg');

				      if(in_array($extentionImage, $extentionsAccepte)){
				        $img_taille = $_FILES['image']['size'];
				        $img_nom    = basename($_FILES['image']['name']);
								$name 			= time().rand().rand().'.'.$extentionImage;
				        $link  = 'assetsAdmin/global/img/upload/'.$name;
				        move_uploaded_file($_FILES['image']['tmp_name'], $link);

                $produit = new Produit(null, $nom, $quantite, null, $statut, $type, $prix);
      					$insert = $produitDAO->newProduit($produit);
                if($insert == false){
                  $error = 'INSERT';
                } else {
                  $idProd = $produitDAO->getLastProduitID();
                  $image = new Image($img_taille, $extentionImage, $img_nom, $link, $idProd);
        					$insert = $imageDAO->newImage($image);
                  if($insert == false){
                    $error = 'INSERT';
                  }
                }

							} else {
								$error = 'IMAGE';
							}
						} else {
							$error = 'IMAGE';
						}
					} else {
            $produit = new Produit(null, $nom, $quantite, null, $statut, $type, $prix);
            $insert = $produitDAO->newProduit($produit);
            if($insert == false){
              $error = 'INSERT';
            }
          }
					if($error == false){
						header('Location: ?page=products');
				  } else {
            header('Location: ?page='.$page.'&error='.$error);
          }
				} elseif(!isset($_GET['error'])) {
					header('Location: ?page='.$page.'&error=INCOMPLET');
				}
			}
	  } else {
			$id = htmlspecialchars($_GET['id']);
			$prodImg = $produitDAO->getProduitByIDJoinImage($id);
			if($prodImg == null){
				header('Location: ?page='.$page.'&error=ID');
			} else {
        if(isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['statut']) && isset($_POST['type']) && isset($_POST['prix'])){
  				if(!empty($_POST['nom']) && !empty($_POST['quantite']) && !empty($_POST['statut']) && !empty($_POST['type']) && !empty($_POST['prix'])){

  					$error = false;
  			    $nom 			= htmlspecialchars($_POST['nom']);
  					$quantite = htmlspecialchars($_POST['quantite']);
  					$statut 	= htmlspecialchars($_POST['statut']);
  					$type 	= htmlspecialchars($_POST['type']);
  					$prix 	= htmlspecialchars($_POST['prix']);

            $produit = new Produit($id, $nom, $quantite, null, $statut, $type, $prix);
            $insert = $produitDAO->updateProduit($produit);

            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

  						if($_FILES['image']['size'] <= 3000000){
  				      $informationsImage = pathinfo($_FILES['image']['name']);
  				      $extentionImage    = $informationsImage['extension'];
  				      $extentionsAccepte = array('png', 'jpg', 'jpeg');

  				      if(in_array($extentionImage, $extentionsAccepte)){
  				        $img_taille = $_FILES['image']['size'];
  				        $img_nom    = basename($_FILES['image']['name']);
  								$name 			= time().rand().rand().'.'.$extentionImage;
  				        $link  = 'assetsAdmin/global/img/upload/'.$name;
  				        move_uploaded_file($_FILES['image']['tmp_name'], $link);
                  
                  $imageDAO->dellImageByProdId($id);
                  $image = new Image($img_taille, $extentionImage, $img_nom, $link, $id);
        					$imageDAO->newImage($image);

                }
              }
            }
            if($insert){
              header('Location: ?page='.$page.'&error=SUCCESS&id='.$id);
            }else {
              header('Location: ?page='.$page.'&error=ERREUR&id='.$id);
            }

          }
        }
      }
		}
		if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
      $alert = choixAlertAdmin($error);
		}
    require_once(PATH_VIEWS_ADMIN.$page.'.php');
  }
