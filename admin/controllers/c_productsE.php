<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    $page = 'products';
    if(!isset($_GET['id'])){
			if(isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['statut']) && isset($_POST['type']) && isset($_POST['prix'])){
				if(!empty($_POST['nom']) && !empty($_POST['quantite']) && !empty($_POST['statut']) && !empty($_POST['type']) && !empty($_POST['prix'])){

					$error = 0;
			    $nom 			= htmlspecialchars($_POST['nom']);
					$quantite = htmlspecialchars($_POST['quantite']);
					$statut 	= htmlspecialchars($_POST['statut']);
					$type 	= htmlspecialchars($_POST['type']);
					$prix 	= htmlspecialchars($_POST['prix']);

					$req = $db->prepare('INSERT INTO produit(nom_prod, stock_prod, statut_prod, type_prod, prix_prod)
															 VALUES (?, ?, ?, ?, ?)');
					$req->execute(array($nom, $quantite, $statut, $type, $prix)) or die(print_r($req->errorInfo()));

					if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
						$req = $db->query('SELECT * FROM produit WHERE id_prod=(SELECT MAX(id_prod) FROM produit)');
						while($produit = $req->fetch()){
							$idProd = $produit['id_prod'];
						}
						$req->closeCursor();
						if($_FILES['image']['size'] <= 3000000){
				      $informationsImage = pathinfo($_FILES['image']['name']);
				      $extentionImage    = $informationsImage['extension'];
				      $extentionsAccepte = array('png', 'jpg', 'jpeg');

				      if(in_array($extentionImage, $extentionsAccepte)){
				        $img_taille = $_FILES['image']['size'];
				        $img_nom    = basename($_FILES['image']['name']);
								$name 			= time().rand().rand().'.'.$extentionImage;
				        $nomUpload  = '../../assets/global/img/upload/'.$name;
				        move_uploaded_file($_FILES['image']['tmp_name'], $nomUpload);

								$link = "admin/assets/global/img/upload/".$name;;

				        $req = $db->prepare('INSERT INTO image(img_size, img_type, img_name, link, produit_id)
				                             VALUES (?, ?, ?, ?, ?)');
				        $req->execute(array($img_taille, $extentionImage, $img_nom, $link, $idProd)) or die(print_r($req->errorInfo()));
							} else {
								$error = 1;
								$req = $db->prepare('DELETE FROM produit WHERE id_prod=?');
								$req->execute(array($idProd));
								header('Location: ecommerce_products_edit.php?error=2');
							}
						} else {
							$error = 1;
							$req = $db->prepare('DELETE FROM produit WHERE id_prod=?');
							$req->execute(array($idProd));
							header('Location: ecommerce_products_edit.php?error=2');
						}
					}
					if($error == 0){
						header('Location: ecommerce_products.php');
				  }
				} elseif(!isset($_GET['error'])) {
					header('Location: ecommerce_products_edit.php?error=1');
				}
			}
	  } else {
			$id = htmlspecialchars($_GET['id']);
			$req = $db->prepare('SELECT * FROM produit LEFT JOIN image ON image.produit_id = produit.id_prod WHERE id_prod=?');
			$req->execute(array($id));
			if($req->rowCount() == 0){
				header('Location: ecommerce_products_edit.php?error=3');
			}
			while($produit = $req->fetch()){
				$pNom 		= $produit['nom_prod'];
				$pStock 	= $produit['stock_prod'];
				$pPrix 		= $produit['prix_prod'];
				$pStatut 	= $produit['statut_prod'];
				$pType 		= $produit['type_prod'];
				$pLink		= $produit['link'];
				$pImgName = $produit['img_name'];
			}
		}
		if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
		}
    require_once(PATH_VIEWS.'productsE.php');
  }
