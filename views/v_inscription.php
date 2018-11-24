
<?php require_once(PATH_VIEWS.'header.php');?>

<?php require_once(PATH_VIEWS.'menu.php');?>

<div class="main">
  <!--<section class="module bg-dark-30" data-background="assets/images/section-1.jpg">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h1 class="module-title font-alt mb-0">S'inscrire</h1>
        </div>
      </div>
    </div>
  </section> -->
  <section class="module module-video bg-dark-30" data-background="assets/images/section-1.jpg">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title font-alt mb-0"></h2>
        </div>
      </div>
    </div>
    <div class="video-player" data-property="{videoURL:'https://youtu.be/WCHk5rYsEsQ', containment:'.module-video', startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>
  </section>
  <section class="module">
    <div class="container">
      <div class="row">
        <div id="error" class="col-sm-6 col-sm-offset-3">

          <?php require_once(PATH_VIEWS.'alert.php');?>

          <h4 class="font-alt">Inscription</h4>
          <hr class="divider-w mb-10">
          <form class="form" method="post" action="?page=inscription">
            <div class="form-group">
              <input class="form-control" id="E-mail" type="text" name="email" placeholder="Email"/>
            </div>
            <div class="form-group">
              <input class="form-control" id="username" type="text" name="pseudo" placeholder="Username"/>
            </div>
            <div class="form-group">
              <input class="form-control" id="password" type="password" name="password" placeholder="Password"/>
            </div>
            <div class="form-group">
              <input class="form-control" id="re-password" type="password" name="password_confirm" placeholder="Re-enter Password"/>
            </div>
            <div class="form-group">
              <button class="btn btn-block btn-round btn-b">S'inscire</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php require_once(PATH_VIEWS.'footer.php');?>
