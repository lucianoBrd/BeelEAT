<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    $page = 'ingredient';
    if(isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['statut'])){
			if(!empty($_POST['nom']) && !empty($_POST['quantite']) && !empty($_POST['statut'])){

				$error = 0;
		    $nom 			= htmlspecialchars($_POST['nom']);
				$quantite = htmlspecialchars($_POST['quantite']);
				$statut 	= htmlspecialchars($_POST['statut']);

				$req = $db->prepare('INSERT INTO ingredient(nom_ingre, stock_ingre, statut_ingre)
														 VALUES (?, ?, ?)');
				$req->execute(array($nom, $quantite, $statut)) or die(print_r($req->errorInfo()));
				header('Location: ecommerce_ingredient.php');

			} elseif(!isset($_GET['error'])) {
				header('Location: ecommerce_ingredient_edit.php?error=1');
			}
		}
		if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
		}
    require_once(PATH_VIEWS.'ingredientE.php');
  }
