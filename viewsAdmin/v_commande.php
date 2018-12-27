
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
					<h1>Dashboard <small><?=$page?></small></h1>
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
			<!-- BEGIN PAGE CONTENT INNER -->
			<?php require_once(PATH_VIEWS_ADMIN.'alertAdmin.php');?>
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-basket font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Commande</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<div class="table-actions-wrapper">
									<span>
									</span>
									<select class="table-group-action-input form-control input-inline input-small input-sm">
										<option value="">Select...</option>
										<option value="Cancel">Cancel</option>
										<option value="Cancel">Hold</option>
										<option value="Cancel">On Hold</option>
										<option value="Close">Close</option>
									</select>
									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
								</div>
								<table class="table table-striped table-bordered table-hover" id="datatable_orders">
								<thead>
								<tr role="row" class="heading">
									<th width="2%">
										<input type="checkbox" class="group-checkable">
									</th>
									<th width="5%">
										 Numero&nbsp;commande
									</th>
									<th width="15%">
										 Date&nbsp;commande
									</th>
									<th width="15%">
										 Client
									</th>
									<th width="10%">
										 Prix
									</th>
									<th width="10%">
										 Statut
									</th>
									<th width="20%">
										 Actions
									</th>
								</tr>
								</thead>
								<tbody>
									<?php
										$compt = 0;
										foreach ($listeComm as $commande){
											if($compt%2 == 0){
												$class = 'odd';
											} else {
												$class = 'even';
											}
											$type="danger";
											switch($commande[0]->getStatutComm()){
												case "preparation" : $change = "Changer Attente Recuperation";
																						 break;
												case "attente_recuperation" : $change = "Changer Termine";
										 												 break;
												case "termine" : $type = "success";
																				 break;
											}
											if($commande[0]->getStatutComm() == "termine"){
												$type="success";
											}
										?>
											<tr role="row" class="<?=$class?>">
												<td><div class="group-checkable"><span><input type="checkbox" name="id[]" value="1"></span></div></td>
												<td class="sorting_1">
                          <?=$commande[0]->getCommId()?>
                          <h5><?=$commande[1]->getNom()?></h5>
                          <?php
                            if($commande[2] != null){
                              foreach ($commande[2] as $prod) {
                                echo '<h6>'.$prod[0]->getNom().'</h6>
                                      <img class="img-responsive" src="'.$prod[1]->getLink().'" alt="'.$prod[1]->getName().'"/>';
																if($prod[0]->getType() == "sandwich" && $commande[4] != null){
																	echo '<ul>';
																	foreach ($commande[4] as $ingre) {
																		echo '<li><h7>'.$ingre->getNom().'</h7></li>';
																	}
																	echo '</ul>';
																}
                              }
                            }
                          ?>
                        </td>
												<td><?=$commande[0]->getDateComm()?></td>
												<td><?=$commande[3]->getPseudo()?><br/><?=$commande[3]->getEmail()?></td>
												<td><?=$commande[0]->getPrixComm()?></td>
												<td><span class="label label-sm label-<?=$type?>"><?=$commande[0]->getStatutComm()?></span></td>
												<td>
													<div class="margin-bottom-5">
														<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Détails</button>
													</div>
													<!-- Button to trigger modal -->
													<?php
														if($commande[0]->getStatutComm() != "termine"){
													?>
													<a href="#myModal<?=$commande[0]->getCommId()?>" role="button" class="btn btn-sm red filter-cancel" data-toggle="modal"><i class="fa fa-check"></i><?=$change?></a>
													<!-- Modal -->
													<div id="myModal<?=$commande[0]->getCommId()?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
																	<h4 class="modal-title">Confirmer changement</h4>
																</div>
																<div class="modal-body">
																	<p>
																		 Changer le statut de la commande ?
																	</p>
																</div>
																<div class="modal-footer">
																	<button class="btn default" data-dismiss="modal" aria-hidden="true">Fermer</button>
																	<a href="?page=changeStatut&before=commande&id=<?=$commande[0]->getCommId()?>&user=<?=$commande[3]->getId()?>" class="btn blue">Confirmer</a>
																</div>
															</div>
														</div>
													</div>
													<?php
														}
													?>
												</td>
											</tr>
									<?php
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
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php require_once(PATH_VIEWS_ADMIN.'footer.php');?>

<script>
jQuery(document).ready(function() {
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
