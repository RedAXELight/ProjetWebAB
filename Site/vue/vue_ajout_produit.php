<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.BASEIA
 * Date: 07.06.2018
 * Time: 09:33
 */

ob_start();
$titre = "Ajouter un produit";
$intitule = "Ajout d'un produit";
$SousMenu = "Bonjour vendeur " .$_SESSION['login']. ", vous pouvez ajouter un produit";
?>



<?php
$contenu = ob_get_clean();
require 'gabarit.php';
?>
