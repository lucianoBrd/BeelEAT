<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'ProduitDAO.php');
    require_once(PATH_MODELS.'ImageDAO.php');
    require_once(PATH_MODELS.'ListeProdDAO.php');
    require_once(PATH_MODELS.'MenuDAO.php');
    require_once(PATH_ENTITY.'Produit.php');
    require_once(PATH_ENTITY.'Menu.php');
    require_once(PATH_ENTITY.'Image.php');
    $produitDAO = new ProduitDAO();
    $imageDAO = new ImageDAO();
    $listeProdDAO = new ListeProdDAO();
    $menuDAO = new MenuDAO();
    $prodListe = $produitDAO->getProduitDispo();

    if($prodListe == null){
      header('Location: ?page='.$page.'&error=ID');
    }

    if(!isset($_GET['id'])){
		  if(isset($_POST['nom']) && isset($_POST['statut']) && isset($_POST['prix'])){
				if(!empty($_POST['nom']) && !empty($_POST['statut']) && !empty($_POST['prix'])){

					$error = false;
			    $nom 			= htmlspecialchars($_POST['nom']);
					$statut 	= htmlspecialchars($_POST['statut']);
					$prix 	= htmlspecialchars($_POST['prix']);

          $menuListe = array();
          $i = 0;
          foreach ( $_POST as $post => $val )  {
            if($post != 'nom' && $post != 'statut' && $post != 'prix'){
              $menuListe[$i] = $val;
              $i++;
            }
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
				        $link  = 'assetsAdmin/global/img/upload/'.$name;
				        move_uploaded_file($_FILES['image']['tmp_name'], $link);

                $menu = new Menu(null, $nom, null, $statut, $prix);
                $insert = $menuDAO->newMenu($menu);
                if($insert == false){
                  $error = 'INSERT';
                } else {
                  $listeProdDAO->newListeProd($menuListe);
                  $idMenu = $menuDAO->getLastMenuID();
                  $image = new Image($img_taille, $extentionImage, $img_nom, $link, $idMenu);
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
            $menu = new Menu(null, $nom, null, $statut, $prix);
            $insert = $menuDAO->newMenu($menu);
            if($insert == false){
              $error = 'INSERT';
            } else {
              $listeProdDAO->newListeProd($menuListe);
            }
          }
					if($error == false){
						header('Location: ?page=menuB');
				  } else {
            header('Location: ?page='.$page.'&error='.$error);
          }
				} elseif(!isset($_GET['error'])) {
					header('Location: ?page='.$page.'&error=INCOMPLET');
				}
			}
	  } else {
			$id = htmlspecialchars($_GET['id']);

		}
		if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
      $alert = choixAlertAdmin($error);
		}
    require_once(PATH_VIEWS_ADMIN.$page.'.php');
  }
