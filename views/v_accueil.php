
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

<div class="main">
	<section class="module bg-dark-30" data-background="assets/images/section-1.jpg">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<h1 class="module-title font-alt mb-0">Se connecter</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="module">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 mb-sm-40">

					<?php require_once(PATH_VIEWS.'alert.php');?>

					<h4 class="font-alt">Se connecter</h4>
					<hr class="divider-w mb-10">
					<form class="form" method="post" action="../">
						<div class="form-group">
							<input class="form-control" id="E-mail" required type="text" name="email" placeholder="E-mail" value="<?= isset($_GET['email']) ? $_GET['email'] : '' ?>"/>
						</div>
						<div class="form-group">
							<input class="form-control" id="password" required type="password" name="password" placeholder="Password"/>
						</div>
						<div class="form-group">
							<button class="btn btn-block btn-round btn-b">Connexion</button>
						</div>
						<div class="form-group"><a href="">Mot de passe oublié ?</a></div>
						<div class="checkbox">
							<label>
								<input checked type="checkbox" value="" name="check_connect">
								<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
								Connexion automatique
							</label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php require_once(PATH_VIEWS.'footer.php');?>
