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
?>

    <article>
        <header>
            <h2>Erreur</h2>
            <p>L'action demandée est inconnue !</p>
            <?=@$_SESSION['erreur'];?>
        </header>
    </article>
    <hr/>

<?php
$contenu = ob_get_clean();
require 'gabarit.php';
