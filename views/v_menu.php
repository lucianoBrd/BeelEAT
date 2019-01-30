<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main>
    <div class="page-loader">
      <div class="loader">Loading...</div>
    </div>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="../">Beel EAT</a>
        </div>
        <div class="collapse navbar-collapse" id="custom-collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php
              if(!isset($_SESSION['connect'])){
            ?>
            <li class="dropdown"><a href="?page=inscription">Inscription</a>
            <?php
              }
              if(isset($_SESSION['connect'])){
            ?>
            <li class="dropdown"><a class="dropdown-toggle" href="../" data-toggle="dropdown">Accueil</a>
              <ul class="dropdown-menu">
                <li><a href="?page=accueil#commande">Commander</a></li>
              </ul>
            </li>

            <?php
              }
              if(isset($_SESSION['connect'])){
            ?>
            <li class="dropdown"><a class="dropdown-toggle" href="" data-toggle="dropdown">Mon compte</a>
              <ul class="dropdown-menu">
                <li><a href="?page=mesCommandes">Mes commandes</a></li>
                <li><a href="?page=disconnection">Déconnection</a></li>
              </ul>
            </li>
            <?php
              }
            ?>
            <?php
              if(!isset($_SESSION['connect'])){
            ?>
            <li class="dropdown"><a href="../"><button class="btn btn-border-w btn-round btn-xs pull-left" type="button">Connexion</button>&nbsp;</a></li>
            <?php
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
