<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require(PATH_ENTITY.'Produit.php');
    $page = 'menu';
    $prod = array();
    $re = $db->prepare('SELECT * FROM produit WHERE statut_prod = "disponible" or statut_prod = "publie"');
    $re->execute(array());
    if($re->rowCount() == 0){
      header('Location: ecommerce_menu_edit.php?error=3');
    }
    $i = 0;
    while($produit = $re->fetch()){
      $prod[$i] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['type_prod']);
      $i++;
    }
    if(!isset($_GET['id'])){
		  if(isset($_POST['nom']) && isset($_POST['statut']) && isset($_POST['prix'])){
				if(!empty($_POST['nom']) && !empty($_POST['statut']) && !empty($_POST['prix'])){

					$error = 0;
			    $nom 			= htmlspecialchars($_POST['nom']);
					$statut 	= htmlspecialchars($_POST['statut']);
					$prix 	= htmlspecialchars($_POST['prix']);

          $menu = array();
          $i = 0;
          foreach ( $_POST as $post => $val )  {
            if($post != 'nom' && $post != 'statut' && $post != 'prix'){
              $menu[$i] = $val;
              $i++;
            }
          }


					$req = $db->prepare('INSERT INTO menu(nom_menu, statut_menu, prix_menu)
															 VALUES (?, ?, ?)');
					$req->execute(array($nom, $statut, $prix));

          $req = $db->query('SELECT * FROM menu WHERE id_menu=(SELECT MAX(id_menu) FROM menu)');
          while($produit = $req->fetch()){
            $idProd = $produit['id_menu'];
          }
          $req->closeCursor();

          foreach ( $menu as $id )  {
              $req = $db->prepare('INSERT INTO liste_prod(id_prod, id_menu)
    															 VALUES (?, ?)');
              $req->execute(array($id, $idProd));
          }

					if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

						if($_FILES['image']['size'] <= 3000000){
				      $informationsImage = pathinfo($_FILES['image']['name']);
				      $extentionImage    = $informationsImage['extension'];
				      $extentionsAccepte = array('png', 'jpg', 'jpeg');

				      if(in_array($extentionImage, $extentionsAccepte)){
				        $img_taille = $_FILES['image']['size'];
				        $img_nom    = basename($_FILES['image']['name']);
								$name 			= time().rand().rand().'.'.$extentionImage;
				        $nomUpload  = 'assets/global/img/upload/'.$name;
				        move_uploaded_file($_FILES['image']['tmp_name'], $nomUpload);

								$link = "admin/assets/global/img/upload/".$name;;

				        $req = $db->prepare('INSERT INTO image(img_size, img_type, img_name, link, produit_id)
				                             VALUES (?, ?, ?, ?, ?)');
				        $req->execute(array($img_taille, $extentionImage, $img_nom, $link, $idProd)) or die(print_r($req->errorInfo()));
							} else {
								$error = 1;
								$req = $db->prepare('DELETE FROM menu WHERE id_menu=?');
								$req->execute(array($idProd));
								header('Location: ecommerce_menu_edit.php?error=2');
							}
						} else {
							$error = 1;
							$req = $db->prepare('DELETE FROM menu WHERE id_menu=?');
							$req->execute(array($idProd));
							header('Location: ecommerce_menu_edit.php?error=2');
						}
					}
					if($error == 0){
						header('Location: ecommerce_menu.php');
				  }
				} elseif(!isset($_GET['error'])) {
					header('Location: ecommerce_menu_edit.php?error=1');
				}
			}
	  } else {
			$id = htmlspecialchars($_GET['id']);
			$req = $db->prepare('SELECT * FROM produit LEFT JOIN image ON image.produit_id = produit.id_prod WHERE id_prod=?');
			$req->execute(array($id));
			if($req->rowCount() == 0){
				header('Location: ecommerce_menu_edit.php?error=3');
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
    require_once(PATH_VIEWS.'menuE.php');
  }
