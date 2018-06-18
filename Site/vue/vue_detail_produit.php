<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

// tampon de flux stocké en mémoire
ob_start();

foreach ($resultats as $resultat) : //Ici on utilise la variable $resultats retournée dans la fonction GetProd, cela permet de faire sortir les elements obtenus avec la requete afin de les utiliser ici-->
//Variables pour récuperer le contenu du foreach

//Les différents elements sont donc "etalés" ici et attribués à un nom qui permet d'afficher dans les champs du formulaire le contenus du produit choisi
$Id = $resultat['idCubeSat'];
$Nom = $resultat['csName'];
$Masse = $resultat['csMass'];
$Prix = $resultat['csPrice'];
$Solaire = $resultat['SolarPanel'];
$Height = $resultat['Height'];
$Width = $resultat['Width'];
$Length = $resultat['Length'];
$Batterie = $resultat['BatterySpace'];
$Stock = $resultat['Stock'];
$Description = $resultat['Description'];

endforeach;


$titre="GalaxSat - Produit n°".$Id;
$intitule=$resultat['csName'];
$SousMenu=$resultat['Description'];;
?>

<!--_________________________________________Ci-dessous l'affichage des détails______________________________________-->


<!-- Section: détails d'un produti -->+
<section id="contact" class="home-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group wow bounceInDown" data-wow-delay="0.4s">
                    <form class="form" role="form" data-toggle="validator" method="POST" action="index.php?action=panier">
                        <table class="table table-hover">
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Nom : </td>
                                <td><?php echo @$Nom; ?></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Masse [Kg] : </td>
                                <td><?php echo @$Masse ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Prix : </td>
                                <td><?php echo @$Prix ?></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Puissance panneaux solaires [W/h] : </td>
                                <td><?php echo @$Solaire ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Hauteur [cm] : </td>
                                <td><?php echo @$Height ?></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Largeur [cm] : </td>
                                <td><?php echo @$Width ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Longueur [cm] : </td>
                                <td><?php echo @$Length ?></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Nombre de batteries possibles : </td>
                                <td><?php echo @$Batterie ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 20%;">Stock : </td>
                                <td><?php echo @$Stock ?></td>
                                <td style="text-align: center;padding-top: 10px;width: 20%;">Description du CubeSat : </td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="btn btn-skin" type="submit" value="Ajouter au panier"/></td>
                                <td></td>
                                <td></td>
                            </tr>
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
