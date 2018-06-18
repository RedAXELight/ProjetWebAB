<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

// tampon de flux stocké en mémoire
ob_start();
$titre="GalaxSat - Produit en détail";
$intitule=$resultat['csName'];
$SousMenu=$resultat['Description'];;
?>




<?php
  $contenu = ob_get_clean();
  require "gabarit.php";
?>
