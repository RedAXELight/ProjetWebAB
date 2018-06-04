<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.baseia
 * Date: 04.06.2018
 * Time: 10:04
 */

ob_start();
$titre = "Ajouter un vendeur";
$intitule = "Ajout d'un vendeur";
$SousMenu = "Bonjour administrateur " .$_SESSION['login']. ", vous pouvez ajouter un vendeur";
?>



<?php
$contenu = ob_get_clean();
require 'gabarit.php';
?>
