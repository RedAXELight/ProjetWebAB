<?php
/**
* Created by PhpStorm.
* User: Alexandre.baseia
* Date: 28.05.2018
* Time: 09:27
*/
// Tampon de flux stocké en mémoire
ob_start();
$titre = "erreur";
$intitule = "Oups... Il semblerait qu'il y aie une erreur :(";
?>

<article>
    <header>
        <h2>Erreur</h2>
        <?php if (!isset($_SESSION['erreur']) && ($_SESSION['erreur']== "Accès non autorisé !"))
        echo "<p>L'action demandée est inconnue !</p>"
            ?>
        <h3><?=@$_SESSION['erreur'];?></h3>
    </header>
</article>
<hr/>

<?php
$contenu = ob_get_clean();
require 'gabarit.php';
