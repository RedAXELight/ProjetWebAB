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

<!-- Section: form choix et ajout de produit -->
<section id="contact" class="home-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if (isset($erreur)){
                    echo "<div class='alert alert-danger'>".$erreur."</div>";
                }
                ?>
                <div class="form-group wow bounceInDown" data-wow-delay="0.4s">
                    <form class="form" role="form" data-toggle="validator" method="POST" action="index.php?action=ajout_vendeur">
                        <table class="table table-hover">
                         <!--   <input type="radio" name="Batterie" value="Batterie">-->
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>


<?php
$contenu = ob_get_clean();
require 'gabarit.php';
?>
