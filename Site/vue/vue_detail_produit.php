<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

// tampon de flux stocké en mémoire
ob_start();
$titre="GalaxSat - Accueil";
$intitule=$resultat['csName'];
$SousMenu=$resultat['Description'];;
$Credits="Icons made by Freepik from www.flaticon.com";
?>




<?php
  $contenu = ob_get_clean();
  require "gabarit.php";
?>
