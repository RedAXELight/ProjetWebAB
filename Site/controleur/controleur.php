<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

require "modele/modele.php";

// Affichage de la page de l'accueil
function accueil()
{
    require "vue/accueil.php";
}

function erreur($e)
{
    $_SESSION['erreur'] = $e;
    require "vue/vue_erreur.php";
}

//--------------------------USERS--------------------------------
function login() //Fonction pour le login du formulaire
{
    if (isset ($_POST['fLogin']) && isset ($_POST['fPass']))
    {
        $resultats = getLogin($_POST);
        require "vue/vue_login.php";
    }
    else
    {
        // détruit la session de la personne connectée après appuyé sur Logout
        if (isset($_SESSION['login'])) {
            session_destroy();
            require "vue/vue_accueil.php";
        } else
            require "vue/vue_login.php";
    }
}

function enregistrer() {
      $nom = @$_POST['nom'];
      $prenom = @$_POST['prenom'];
      $adresse = @$_POST['adresse'];
      $ville = @$_POST['ville'];
      $npa = @$_POST['npa'];
      $email = @$_POST['email'];
      $login = @$_POST['login'];
      $password = @$_POST['password'];
      $confirm_password = @$_POST['confirm_password'];

      $erreur = 0;

      if ($password != $confirm_password) {$erreur = 9;}
      if ($password == ''){$erreur = 8;}
      if ($login == ''){$erreur = 7;}
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){$erreur = 6;}
      if (($npa < 999) || ($npa > 100000)){$erreur = 5;}
      if ($ville == ''){$erreur = 4;}
      if ($adresse == ''){$erreur = 3;}
      if ($prenom == ''){$erreur = 2;}
      if ($nom == ''){$erreur = 1;}

      if ($erreur == 0){
          $operation = enregistrer_user(@$_POST);
          if ($operation == ''){
              $erreur = 'ce login est déjà utilisé !';
          }else{
              $erreur = 'requête envoyé avec succès';
              require "vue/vue_login.php";
          }
      }else{
          switch ($erreur) {
              case '1':
                  $erreur = 'le champ nom est incorrect !';
                  break;
              case '2':
                  $erreur = 'le champ prénom est incorrect !';
                  break;
              case '3':
                  $erreur = 'le champ adresse est incorrect !';
                  break;
              case '4':
                  $erreur = 'le champ ville est incorrect !';
                  break;
              case '5':
                  $erreur = 'le champ NPA est incorrect !';
                  break;
              case '6':
                  $erreur = 'le champ Email est incorrect !';
                  break;
              case '7':
                  $erreur = 'le champ login est incorrect !';
                  break;
              case '8':
                  $erreur = 'le champ mot de passe est incorrect !';
                  break;
              case '9':
                  $erreur = 'le champ de la confimation du mot de passe ne correspond pas au champ au mot de passe';
                  break;
              default:
                  $erreur = 'une erreur inconnu est arrivé !';
                  break;
          }
          require "vue/inscription.php";
      }
}
