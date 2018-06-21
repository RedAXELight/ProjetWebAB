<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 14.06.2018
 */
// tampon de flux stocké en mémoire
ob_start();
$titre = "GalaxSat - Produits";
$intitule = "Liste de produits";
$SousMenu = "Made by GalaxSat";
$Credits = "Icons made by Freepik from www.flaticon.com";

?>

<!-- Section: about -->
<section id="produits" class="home-section text-center">
    <div class="heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow bounceInDown" data-wow-delay="0.1s">
                        <div class="section-heading">
                            <h2>Nos produits</h2>
                            <i class="fa fa-2x fa-angle-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- marge -->
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-lg-offset-5">
                <hr class="marginbot-50">
            </div>
        </div>
        <!-- les produits -->
        <div class="row">
            <?php foreach ($resultats as $resultat) { ?>
                <div class="col-md-3 team" style="padding: 10px;">
                    <div class="wow bounceInUp" data-wow-delay="0.2s">
                        <div class="team boxed-grey">
                            <?php
                            echo "<a href='index.php?action=vue_detail_produit&id=".$resultat['idCubeSat']."'>"
                            ?>
                            <div class="inner">
                                <h5><?= $resultat['csName']; ?></h5>
                                <div class="avatar"><img src="img/cubesat/cubesat.gif" alt=""
                                                         class="img-responsive img-circle"/></div>
                                <p class="subtitle"><?= $resultat['Description']; ?></p>
                                <?php
                                if (isset($_SESSION['typeUser']) && $_SESSION['typeUser'] == "Vendeur")
                                {
                                echo "<a href='index.php?action=vue_modifier&id=".$resultat['idCubeSat']."'><img src='../img/modif.png'></a> - <a href='index.php?action=supprimer_produit&id=".$resultat['idCubeSat']."'><img src='../img/delete.png'></a>";
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- /Section: about -->

<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>
