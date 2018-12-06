
<?php require_once(PATH_VIEWS_ADMIN.'header.php');?>


<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?php require_once(PATH_VIEWS_ADMIN.'menu.php');?>
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
			<?php require_once(PATH_VIEWS_ADMIN.'alertAdmin.php');?>

			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" method="post" action="?page=ingredientE<?=isset($id)? '&id='.$id : ''?>" enctype="multipart/form-data">
						<div class="portlet light">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-basket font-green-sharp"></i>
										<span class="caption-subject font-green-sharp bold uppercase">
										Edit ingrdedient </span>
										<span class="caption-helper">Man Tops</span>
									</div>
									<div class="actions btn-set">
										<a href="?page=ingredient" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</a>
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
										</ul>
										<div class="tab-content no-space">
											<div class="tab-pane active" id="tab_general">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-2 control-label">Nom: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="nom" placeholder="" <?=isset($id)? 'value="'.$ingredient->getNom().'"' : ''?>>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Quantité: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="quantite" placeholder="" <?=isset($id)? 'value="'.$ingredient->getStock().'"' : ''?>>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Statut: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<select class="table-group-action-input form-control input-medium" name="statut">
																<option value="">Select...</option>
																<option value="disponible" <?=isset($id) && $ingredient->getStatut()=="disponible"? 'selected' : ''?>>Disponible</option>
																<option value="indisponible" <?=isset($id) && $ingredient->getStatut()=="indisponible"? 'selected' : ''?>>Indisponible</option>
															</select>
														</div>
													</div>
												</div>
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
<?php require_once(PATH_VIEWS_ADMIN.'footer.php');?>

<script>
        jQuery(document).ready(function() {
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
        });
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
