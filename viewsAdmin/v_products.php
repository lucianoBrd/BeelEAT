
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
					<h1>Produit</h1>
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
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Produit</span>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-default btn-circle" href="?page=productsE" >
									<i class="fa fa-plus"></i> Nouveau produit
									</a>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<table class="table table-striped table-bordered table-hover" id="datatable_products">
								<thead>
								<tr role="row" class="heading">
									<th width="10%">
										 ID
									</th>
									<th width="15%">
										 Nom
									</th>
									<th width="15%">
										 Quantité
									</th>
									<th width="25%">
										 Date&nbsp;de&nbsp;création
									</th>
									<th width="10%">
										 Statut
									</th>
									<th width="10%">
										 Actions
									</th>
								</tr>
								</thead>
								<tbody>
									<?php
										$compt = 0;
										foreach ($prodListe as $produit){
											if($compt%2 == 0){
												$class = 'odd';
											} else {
												$class = 'even';
											}
											$type="success";
											if($produit->getStatut() == "indisponible"){
												$type="danger";
											}
											echo '<tr role="row" class="'.$class.'">
												<td class="sorting_1">'.$produit->getProdId().'</td>
												<td>'.$produit->getNom().'</td>
												<td>'.$produit->getStock().'</td>
												<td>'.$produit->getDate().'</td>
												<td><span class="label label-sm label-'.$type.'">'.$produit->getStatut().'</span></td>
												<td><a href="?page=productsE&id='.$produit->getProdId().'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Editer</a></td>
											</tr>';
										}
									?>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
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
