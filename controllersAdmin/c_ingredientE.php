<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'IngredientDAO.php');
    require_once(PATH_ENTITY.'Ingredient.php');
    $ingredientDAO = new IngredientDAO();

    if(!isset($_GET['id'])){
			if(isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['statut'])){
				if(!empty($_POST['nom']) && !empty($_POST['quantite']) && !empty($_POST['statut'])){

					$error = false;
			    $nom 			= htmlspecialchars($_POST['nom']);
					$quantite = htmlspecialchars($_POST['quantite']);
					$statut 	= htmlspecialchars($_POST['statut']);

          $ingredient = new Ingredient(null, $nom, $quantite, null, $statut);
          $insert = $ingredientDAO->newIngredient($ingredient);
          if($insert == false){
            $error = 'INSERT';
          }

					if($error == false){
						header('Location: ?page=ingredient');
				  } else {
            header('Location: ?page='.$page.'&error='.$error);
          }
				} elseif(!isset($_GET['error'])) {
					header('Location: ?page='.$page.'&error=INCOMPLET');
				}
			}
	  } else {
			$id = htmlspecialchars($_GET['id']);
			$ingredient = $ingredientDAO->getIngredientByID($id);
			if($ingredient == null){
				header('Location: ?page='.$page.'&error=ID');
			} else {
        if(isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['statut'])){
  				if(!empty($_POST['nom']) && !empty($_POST['quantite']) && !empty($_POST['statut'])){

  					$error = false;
  			    $nom 			= htmlspecialchars($_POST['nom']);
  					$quantite = htmlspecialchars($_POST['quantite']);
  					$statut 	= htmlspecialchars($_POST['statut']);

            $ingredient = new Ingredient($id, $nom, $quantite, null, $statut);
            $insert = $ingredientDAO->updateIngredient($ingredient);

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
