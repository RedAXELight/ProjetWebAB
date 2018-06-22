<?php
/**
* User: Brian Rodrigues Fraga
* User: Alexandre Baseia
* Date: 22.06.2018
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
