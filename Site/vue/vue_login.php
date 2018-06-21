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
    $ligne = $resultats;
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
            } else {
            echo "Erreur de login";
            if (isset($erreur)) {
                echo $erreur;
            }
            }
        }
    }
} else {
    if (isset($_SESSION['login'])) {
        header("location:index.php");
    }
    ?>

    <!--_________________________________________Ci-dessous l'affichage du formulaire______________________________________-->

    <section id="service" class="home-section text-center">
      <div class="heading-about">
         <div class="container">
           <div class="row">
             <div class="col-lg-8 col-lg-offset-2">
               <div class="wow bounceInDown" data-wow-delay="0.1s">
                 <div class="section-heading">
                   <h2>Login</h2>
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

    <!-- Section: form connexion -->
    <section id="contact" class="home-section text-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group wow bounceInDown" data-wow-delay="0.4s">
                        <div class="form-group">
                            <form class='form' role="form" method='POST' data-toggle="validator" action="index.php?action=vue_login">
                                <table class="table table-hover">
                                    <tr>
                                        <td><label>Login : </label></td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Entrez votre login" name="fLogin"
                                            value="<?= @$_POST['fLogin'] ?>"/>
                                            <!-- code php pour éviter de retaper le contenu en cas d'erreur -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Mot de passe : </label></td>
                                        <td>
                                            <input type="password" class="form-control" placeholder="Entrez votre mot de passe" name="fPass"
                                            value="<?= @$_POST['fPass'] ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>reCAPTCHA : </label></td>
                                        <td><div class="g-recaptcha" data-sitekey="6LcU-F8UAAAAAMrWfGgpC51HFfbU0cqAMP_Mmp3w"></div></td>
                                    </tr>
                                    <tr>
                                        <td><input class="btn" type="reset" value="Effacer"></td>
                                        <td><input class="btn btn-skin" type="submit" value="Login"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<hr/>

<?php
$contenu = ob_get_clean();
require 'gabarit.php';
?>
