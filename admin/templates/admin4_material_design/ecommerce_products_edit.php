<?php
	define('link', '../../../');
	define('incomplet', '<div class="note note-danger note-shadow">
		<p>
			 NOTE: Vous devez remplir tous les champs.
		</p>
	</div>');
	define('imgIncorrect', '<div class="note note-danger note-shadow">
		<p>
			 NOTE: L\'image est incorrecte.
		</p>
	</div>');
	define('idIncorrect', '<div class="note note-danger note-shadow">
		<p>
			 NOTE: Impossible de récupérer les informations. <a href="ecommerce_products.php">Retour</a>
		</p>
	</div>');
	session_start();
	require(link.'src/connection.php');

  if(!isset($_SESSION['connect'])){
		header('location: '.link);
	} elseif($_SESSION['admin'] == true) {
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
				      $extentionsAccepte = array('png', 'gif', 'jpg', 'jpeg');

				      if(in_array($extentionImage, $extentionsAccepte)){
				        $img_taille = $_FILES['image']['size'];
				        $img_nom    = basename($_FILES['image']['name']);
								$name 			= time().rand().rand().'.'.$extentionImage;
				        $nomUpload  = '../../assets/global/img/upload/'.$name;
				        move_uploaded_file($_FILES['image']['tmp_name'], $nomUpload);

								$link = "admin/assets/global/img/upload/".$name;;

				        $req = $db->prepare('INSERT INTO images(img_size, img_type, img_name, link, produit_id)
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
			$req = $db->prepare('SELECT * FROM produit LEFT JOIN images ON images.produit_id = produit.id_prod WHERE id_prod=?');
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
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>BeelEAT | Admin</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="../../assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
			<img src="../../assets/admin/layout4/img/logo-light.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE ACTIONS -->
		<!-- DOC: Remove "hide" class to enable the page header actions -->
		<div class="page-actions">
			<div class="btn-group">
				<button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<span class="hidden-sm hidden-xs">Actions&nbsp;</span><i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="javascript:;">
						<i class="icon-docs"></i> Nouveau Menu </a>
					</li>
					<li>
						<a href="javascript:;">
						<i class="icon-tag"></i> Modifier Menu </a>
					</li>
				</ul>
			</div>
		</div>
		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide">
					</li>
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-bell"></i>
						<span class="badge badge-success">
						2 </span>
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3><span class="bold">2</span> notifications</h3>
								<a href="extra_profile.html">voir tout</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
										<span class="time">just now</span>
										<span class="details">
										<span class="label label-sm label-icon label-success">
										<i class="fa fa-plus"></i>
										</span>
										Nouvelle commande de sandwich. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">3 mins</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Menu modifié. </span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<li class="separator hide">
					</li>

					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						Luciano </span>
						<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
						<img alt="" class="img-circle" src="../../assets/admin/layout4/img/avatar.png"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="extra_profile.html">
								<i class="icon-user"></i> Mon Profile </a>
							</li>

							<li class="divider">
							</li>
							<li>
								<a href="<?= link.'disconnection.php' ?>">
								<i class="icon-key"></i> Déconnexion </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar md-shadow-z-2-i  navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start">
					<a href="index.php">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
				<li class="active open">
					<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">Commerce</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="ecommerce_index.html">
							<i class="icon-home"></i>
							Dashboard</a>
						</li>
						<li>
							<a href="ecommerce_orders.html">
							<i class="icon-basket"></i>
							Commande</a>
						</li>
						<li class="active">
							<a href="ecommerce_products.php">
							<i class="icon-handbag"></i>
							Produit</a>
						</li>
						<li>
							<a href="ecommerce_products_edit.html">
							<i class="icon-pencil"></i>
							Modifier Produit</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Form Stuff</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="form_controls_md.html">
							<span class="badge badge-roundless badge-danger">new</span>Material Design<br>
							Form Controls</a>
						</li>
						<li>
							<a href="form_controls.html">
							Bootstrap<br>
							Form Controls</a>
						</li>
						<li>
							<a href="form_layouts.html">
							Form Layouts</a>
						</li>
						<li>
							<a href="form_editable.html">
							<span class="badge badge-warning">new</span>Form X-editable</a>
						</li>
						<li>
							<a href="form_wizard.html">
							Form Wizard</a>
						</li>
						<li>
							<a href="form_validation.html">
							Form Validation</a>
						</li>
						<li>
							<a href="form_image_crop.html">
							<span class="badge badge-danger">new</span>Image Cropping</a>
						</li>
						<li>
							<a href="form_fileupload.html">
							Multiple File Upload</a>
						</li>
						<li>
							<a href="form_dropzone.html">
							Dropzone File Upload</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">Login Options</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="login.html">
							Login Form 1</a>
						</li>
						<li>
							<a href="login_2.html">
							Login Form 2</a>
						</li>
						<li>
							<a href="login_3.html">
							Login Form 3</a>
						</li>
						<li>
							<a href="login_soft.html">
							Login Form 4</a>
						</li>
						<li>
							<a href="extra_lock.html">
							Lock Screen 1</a>
						</li>
						<li>
							<a href="extra_lock2.html">
							Lock Screen 2</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Dashboard <small>accueil</small></h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
				<div class="page-toolbar">

				</div>
				<!-- END PAGE TOOLBAR -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb hide">
				<li>
					<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Dashboard
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<?php
				if(isset($error)){
					switch($error){
						case 1: echo incomplet;
										break;
						case 2: echo imgIncorrect;
										break;
						case 3: echo idIncorrect;
										break;
					}
				}
			?>

			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" method="post" action="ecommerce_products_edit.php" enctype="multipart/form-data">
						<div class="portlet light">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-basket font-green-sharp"></i>
										<span class="caption-subject font-green-sharp bold uppercase">
										Edit Product </span>
										<span class="caption-helper">Man Tops</span>
									</div>
									<div class="actions btn-set">
										<a href="ecommerce_products.php" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</a>
										<button type="submit" class="btn green-haze btn-circle"><i class="fa fa-check"></i> Save</button>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_general" data-toggle="tab">
												General </a>
											</li>
											<li>
												<a href="#tab_images" data-toggle="tab">
												Images </a>
											</li>
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-2 control-label">Nom: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="nom" placeholder="" <?=isset($id)? 'value="'.$pNom.'"' : ''?>>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Quantité: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="quantite" placeholder="" <?=isset($id)? 'value="'.$pStock.'"' : ''?>>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Prix: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="prix" placeholder="" <?=isset($id)? 'value="'.$pPrix.'"' : ''?>>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Statut: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<select class="table-group-action-input form-control input-medium" name="statut">
																<option value="">Select...</option>
																<option value="disponible" <?=isset($id) && $pStatut=="disponible"? 'selected' : ''?>>Disponible</option>
																<option value="publie" <?=isset($id) && $pStatut=="publie"? 'selected' : ''?>>Publié</option>
																<option value="indisponible" <?=isset($id) && $pStatut=="indisponible"? 'selected' : ''?>>Indisponible</option>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Type: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<select class="table-group-action-input form-control input-medium" name="type">
																<option value="">Select...</option>
																<option value="sandwich" <?=isset($id) && $pType=="sandwich"? 'selected' : ''?>>Sandwich</option>
																<option value="boisson" <?=isset($id) && $pType=="boisson"? 'selected' : ''?>>Boisson</option>
																<option value="dessert" <?=isset($id) && $pType=="dessert"? 'selected' : ''?>>Dessert</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_images">
												<div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
													<a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn yellow">
														<input type="file" name="image"/>
													</a>
												</div>
												<div class="row">
													<div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12">
													</div>
												</div>
												<table class="table table-bordered table-hover">
												<thead>
												<tr role="row" class="heading">
													<th width="16%">
														 Image
													</th>
													<th width="25%">
														 Label
													</th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td>
														<?=isset($id)? '<a href="'.link.$pLink.'" class="fancybox-button" data-rel="fancybox-button">
														<img class="img-responsive" src="'.link.$pLink.'" alt="'.$pImgName.'">
														</a>' : ''?>
													</td>
													<td>
														<?=isset($id)? '<input type="text" class="form-control" name="imgName" value="'.$pImgName.'">' : ''?>
													</td>
												</tr>

												</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2018 &copy; BeelEAT.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script type="text/javascript" src="../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="../../assets/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/datatable.js"></script>
<script src="../../assets/admin/pages/scripts/ecommerce-products-edit.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

<?php
}
?>
