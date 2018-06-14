<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.BASEIA
 * Date: 14.06.2018
 * Time: 08:08
 */

ob_start();
$titre = "Modifier un produit";
$intitule = "Modification d'un produit d'un produit";
$SousMenu = "Bonjour vendeur " .$_SESSION['login']. ", vous pouvez modifier un produit";
//Il semble que la description du produit ne se convertisse pas en UTF-8
?>

    <table>
        <?php foreach ($resultats as $resultat) : ?><!--Ici on utilise la variable $resultats retournée dans la fonction GetProd, cela permet de faire sortir les elements obtenus avec la requete afin de les utiliser ici-->
        <!--Variables pour récuperer le contenu du foreach-->
        <?php
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
        ?>


        <?php endforeach; ?>
    </table>

    <!-- Section: form choix et ajout de produit -->+
    <section id="contact" class="home-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group wow bounceInDown" data-wow-delay="0.4s">
                        <form class="form" role="form" data-toggle="validator" method="POST" action="index.php?action=modifierproduit">
                            <table class="table table-hover">
                                <tr>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">ID : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" class="hidden" type="text" name="id" value="<?=@$Id?>"/></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Nom : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="text" name="cnom" value="<?=@$Nom ?>"/></td>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Masse [Kg] : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="text" name="masse" value="<?=@$Masse ?>"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Prix : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="text" name="prix" value="<?=@$Prix ?>"></td>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Puissance panneaux solaires [W/h] : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="solar" value="<?=@$Solaire ?>"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Hauteur [cm] : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="height" value="<?=@$Height ?>"></td>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Largeur [cm] : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="width" value="<?=@$Width ?>"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Longueur [cm] : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="length" value="<?=@$Length ?>"></td>
                                    <td style="text-align: center;vertical-align: middle; width: 20%;">Nombre de batteries possibles : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="battery" value="<?=@$Batterie ?>"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; width: 20%;">Stock : </td>
                                    <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="stock" value="<?=@$Stock ?>"></td>
                                    <td style="text-align: center;padding-top: 10px;width: 20%;">Description du CubeSat : </td>
                                    <td colspan="3"><textarea class="form-control" style="min-width: 98%; resize: vertical;" rows="10" maxlength="1000" name="description"><?=@$Description ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><input class="btn" type="reset" value="Effacer"/></td>
                                    <td><input class="btn btn-skin" type="submit" value="Confirmer"/></td>
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
require 'gabarit.php';
?>