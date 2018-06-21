<?php
/**
* User: Brian Rodrigues Fraga
* Date: 24.05.2018
*/

// tampon de flux stocké en mémoire
ob_start();
$titre="GalaxSat - Panier";
$intitule="Votre panier";

?>
<section id="service" class="home-section text-center">
    <div class="heading-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="wow bounceInDown" data-wow-delay="0.1s">
                    <div class="section-heading">
                        <h2>Panier</h2>
                        <i class="fa fa-2x fa-angle-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-lg-2 col-lg-offset-5">
    <hr class="marginbot-50">
  </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group wow bounceInDown" data-wow-delay="0.4s">
                    <form method="post" action="index.php?action=vue_panier">
                        <table class="table table-hover">
                            <tr>
                                <td colspan="4"><h3 style="margin: 8px;">Votre panier</h3></td>
                            </tr>
                            <tr>
                                <th>Libellé</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            if (creationPanier())
                            {
                                $nbArticles=count($_SESSION['panier']['libelleProduit']);
                                if ($nbArticles <= 0)
                                echo "<tr><td colspan='4'>Votre panier est vide </td></tr>";
                                else
                                {
                                    for ($i=0 ;$i < $nbArticles ; $i++)
                                    {
                                        echo "<tr>";
                                        echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
                                        echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                                        echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                                        echo "<td><a href=\"".htmlspecialchars("index.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
                                        echo "</tr>";
                                    }

                                    echo "<tr><td colspan=\"2\"> </td>";
                                    echo "<td colspan=\"2\">";
                                    echo "Total : ".MontantGlobal();
                                    echo "</td></tr>";

                                    echo "<tr><td colspan=\"4\">";
                                    echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                                    echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                                    echo "</td></tr>";
                                }
                            }
                            ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>
