
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
					<h1>Produit <small>edition</small></h1>
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
					<form class="form-horizontal form-row-seperated" method="post" action="?page=productsE<?=isset($id)? '&id='.$id : ''?>" enctype="multipart/form-data">
						<div class="portlet light">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-basket font-green-sharp"></i>
										<span class="caption-subject font-green-sharp bold uppercase">
										Editer produit </span>
									</div>
									<div class="actions btn-set">
										<a href="?page=products" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</a>
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
															<input type="text" class="form-control" name="nom" placeholder="" <?=isset($id)? 'value="'.$prodImg[0]->getNom().'"' : ''?>>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Quantité: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="quantite" placeholder="" <?=isset($id)? 'value="'.$prodImg[0]->getStock().'"' : ''?>>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Prix: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<input type="text" class="form-control" name="prix" placeholder="" <?=isset($id)? 'value="'.$prodImg[0]->getPrix().'"' : ''?>>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Statut: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<select class="table-group-action-input form-control input-medium" name="statut">
																<option value="">Select...</option>
																<option value="disponible" <?=isset($id) && $prodImg[0]->getStatut()=="disponible"? 'selected' : ''?>>Disponible</option>
																<option value="publie" <?=isset($id) && $prodImg[0]->getStatut()=="publie"? 'selected' : ''?>>Publié</option>
																<option value="indisponible" <?=isset($id) && $prodImg[0]->getStatut()=="indisponible"? 'selected' : ''?>>Indisponible</option>
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
																<option value="sandwich" <?=isset($id) && $prodImg[0]->getType()=="sandwich"? 'selected' : ''?>>Sandwich</option>
																<option value="boisson" <?=isset($id) && $prodImg[0]->getType()=="boisson"? 'selected' : ''?>>Boisson</option>
																<option value="dessert" <?=isset($id) && $prodImg[0]->getType()=="dessert"? 'selected' : ''?>>Dessert</option>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Ingredient: <span class="required">
														* </span>
														</label>
														<div class="col-md-10">
															<div class="form-control height-auto">
																<div class="scroller" style="height:275px;" data-always-visible="1">
																	<ul class="list-unstyled">
																		<li>
																			<label>Sauce</label>
																			<ul class="list-unstyled">
																				<?php
																					foreach($ingreListe as $ingredient){
																						if($ingredient->getType() == 'sauce'){
																				?>
																				<li>
																					<label><?='<input type="checkbox" name="'.$ingredient->getNom().'" value="'.$ingredient->getIngreId().'">'.$ingredient->getNom()?></label>
																				</li>
																				<?php
																					}
																				}
																				?>
																			</ul>
																		</li>
																		<li>
																			<label>Garniture</label>
																			<ul class="list-unstyled">
																				<?php
																					foreach($ingreListe as $ingredient){
																						if($ingredient->getType() == 'garniture'){
																				?>
																				<li>
																					<label><?='<input type="checkbox" name="'.$ingredient->getNom().'" value="'.$ingredient->getIngreId().'">'.$ingredient->getNom()?></label>
																				</li>
																				<?php
																					}
																				}
																				?>
																			</ul>
																		</li>
																		<li>
																			<label>Viande</label>
																			<ul class="list-unstyled">
																				<?php
																					foreach($ingreListe as $ingredient){
																						if($ingredient->getType() == 'viande'){
																				?>
																				<li>
																					<label><?='<input type="checkbox" name="'.$ingredient->getNom().'" value="'.$ingredient->getIngreId().'">'.$ingredient->getNom()?></label>
																				</li>
																				<?php
																					}
																				}
																				?>
																			</ul>
																		</li>
																	</ul>
																</div>
															</div>
															<span class="help-block">
															selectionner au moins un produit </span>
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
														<?=isset($id)? '<a href="'.$prodImg[1]->getLink().'" class="fancybox-button" data-rel="fancybox-button">
														<img class="img-responsive" src="'.$prodImg[1]->getLink().'" alt="'.$prodImg[1]->getName().'">
														</a>' : ''?>
													</td>
													<td>
														<?=isset($id)? '<input type="text" class="form-control" name="imgName" value="'.$prodImg[1]->getName().'">' : ''?>
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
