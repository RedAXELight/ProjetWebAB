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
                    <form class="form" role="form" data-toggle="validator" method="POST" action="index.php?action=ajout_produit">
                        <table class="table table-hover">
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Nom : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="text" name="cnom" value="<?=@$_POST['cnom'] ?>"/></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Masse [Kg] : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="text" name="masse" value="<?=@$_POST['masse'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Prix : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="text" name="prix" value="<?=@$_POST['prix'] ?>"></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Puissance panneaux solaires [W/h] : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="solar" value="<?=@$_POST['solar'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Hauteur [cm] : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="height" value="<?=@$_POST['height'] ?>"></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Largeur [cm] : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="width" value="<?=@$_POST['width'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Longueur [cm] : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="length" value="<?=@$_POST['length'] ?>"></td>
                                <td style="text-align: center;vertical-align: middle; width: 20%;">Nombre de batteries possibles : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="battery" value="<?=@$_POST['battery'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 20%;">Stock : </td>
                                <td><input style="margin-bottom: 0px; width: 60%;" type="number" name="stock" value="<?=@$_POST['stock'] ?>"></td>
                                <td style="text-align: center;padding-top: 10px;width: 20%;">Description du CubeSat : </td>
                                <td colspan="3"><textarea class="form-control" style="min-width: 98%; resize: vertical;" rows="10" maxlength="1000" name="description"><?=@$_POST['description'] ?></textarea></td>
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
