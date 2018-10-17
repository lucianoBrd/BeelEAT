
<?php require_once(PATH_VIEWS.'header.php');?>


<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?php require_once(PATH_VIEWS.'menu.php');?>
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
					<form class="form-horizontal form-row-seperated" method="post" action="ecommerce_products_edit.php<?=isset($id)? '?id='.$id : ''?>" enctype="multipart/form-data">
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
<?php require_once(PATH_VIEWS.'footer.php');?>

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
