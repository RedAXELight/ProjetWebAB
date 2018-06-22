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
                                    $prix_total = MontantGlobal();
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
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
paypal.Button.render({

    env: 'sandbox', // sandbox | production

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create
    client: {
        sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
        production: 'AVerdf0Prbfm40V4MDE6F9nO1MLcgDGrEO6D0XIVQvzmb6w9LhkLjYNcKYGMS3u1tmU68ZM7nr3t2En3'
    },

    // Show the buyer a 'Pay Now' button in the checkout flow
    commit: true,

    // payment() is called when the button is clicked
    payment: function(data, actions) {

        // Make a call to the REST api to create the payment
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: { total: '<?=$prix_total ?>', currency: 'CHF' }
                    }
                ]
            }
        });
    },

    // onAuthorize() is called when the buyer approves the payment
    onAuthorize: function(data, actions) {

        // Make a call to the REST api to execute the payment
        return actions.payment.execute().then(function() {
            window.alert('Payment Complete!');
        });
    }

}, '#paypal-button-container');

</script>




<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>
