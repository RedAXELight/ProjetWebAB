<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.baseia
 * Date: 24.05.2018
 * Time: 09:20
 */

ob_start();
$titre = "Login";
$intitule = "Formulaire de login";
?>

    <!-- ________________________ Gestion de la connection et du type d'utilisateur connecté ______________________________-->

<?php
if (isset($resultats)) {
    // les données dans le formulaire sont exactes
    $ligne = $resultats->fetch();
    // Test pour savoir si on est admin, vendeur ou client
    if ($ligne['UserRole_idUserRole'] == '3') {
        echo "Bonjour " . $ligne['usrName'] . " " . $ligne['usrSurname'] . ". Vous êtes bien connecté en tant que client";
        // Création de la session
        $_SESSION['login'] = $ligne['usrName'] . " " . $ligne['usrSurname'];
        $_SESSION['typeUser'] = "Client";
    } else {
        if ($ligne['UserRole_idUserRole'] == '2') {
            echo "Bonjour " . $ligne['usrName'] . " " . $ligne['usrSurname'] . ". Vous êtes bien connecté en tant que vendeur";
            // Création de la session
            $_SESSION['login'] = $ligne['usrName'] . " " . $ligne['usrSurname'];
            $_SESSION['typeUser'] = "Vendeur";
        } else {
            if ($ligne['UserRole_idUserRole'] == '1') {
                echo "Bonjour " . $ligne['usrName'] . " " . $ligne['usrSurname'] . ". Vous êtes bien connecté en tant qu'administrateur";
                //enregistrement du nom de l'administrateur connécté dans une variable globale
                $_POST['NomAdmin'] = $ligne['usrName'];
                // Création de la session
                $_SESSION['login'] = $ligne['usrName'] . " " . $ligne['usrSurname'];
                $_SESSION['typeUser'] = "Administrateur";
            } else
                echo "Erreur de login";
        }

    }
} else {
    if (isset($_SESSION['login'])) {
        header("location:index.php");
    }
    ?>

    <!--_________________________________________Ci-dessous l'affichage du formulaire______________________________________-->

    <div class="form-group">
        <form class='form' role="form" method='POST' action="index.php?action=vue_login">
            <table class="table table-hover">
                <tr>
                    <td>Login</td>
                    <td>
                        <input type="text" placeholder="Entrez votre login" name="fLogin"
                               value="<?= @$_POST['fLogin'] ?>"/>
                        <!-- code php pour éviter de retaper le contenu en cas d'erreur -->
                    </td>
                </tr>
                <tr>
                    <td>Mot de passe</td>
                    <td>
                        <input type="password" placeholder="Entrez votre mot de passe" name="fPass"
                               value="<?= @$_POST['fPass'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td><input class="btn" type="submit" value="Login"></td>
                    <td><input class="btn" type="reset" value="Effacer"></td>
                </tr>
            </table>
        </form>
    </div>

<?php } ?>
    <hr/>

<?php
$contenu = ob_get_clean();
require 'gabarit.php';
?>
