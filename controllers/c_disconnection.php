<?php
  // Initialise la session
  session_start();
  // Desactiver la session
  session_unset();
  // Detruire la session
  session_destroy();
  //Detruire cookie : on enleve x secondes au temps
  setcookie('log', '', time()-3444, null, null, false, true);
  header('location: ../');
