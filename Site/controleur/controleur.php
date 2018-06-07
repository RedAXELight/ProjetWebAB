<?php
/**
 * User: Brian Rodrigues Fraga
 * User: Alexandre.baseia
 * Date: 24.05.2018
 */

require "modele/modele.php";

// Affichage de la page de l'accueil
function accueil()
{
    require "vue/accueil.php";
}

// Si il y a une erreur, affiche la page d'erreur avec son message
function erreur($e)
{
    $_SESSION['erreur'] = $e;
    require "vue/vue_erreur.php";
}

//-------------------------- Utilisateurs --------------------------------

// Fonction pour le login du formulaire
function login()
{
    // Retire la faille XSS si il y en a
    $_POST['fLogin'] = htmlspecialchars($_POST['fLogin']);
    $_POST['fPass'] = htmlspecialchars($_POST['fPass']);

    // Si la variable fLogin et fPass son set
    if (isset ($_POST['fLogin']) && isset ($_POST['fPass']))
    {
        // On tente de se login à l'aide de la fonction dans modele.php
        $resultats = getLogin($_POST);
        // On renvois la page vue_login
        require "vue/vue_login.php";
    }
    else
    {
        // Détruit la session de la personne connectée après appuyé sur Logout
        if (isset($_SESSION['login'])) {
            session_destroy();
            $_SESSION = [];
            require "vue/accueil.php";
        } else
            require "vue/vue_login.php";
    }
}

// Affiche la vue inscription
function inscription(){
    require "vue/inscription.php";
}

// Fonction pour enregistrer un utilisateur
function enregistrer() {
      // Mettre les variables globales dans des variables locaux
      $nom = @$_POST['nom'];
      $prenom = @$_POST['prenom'];
      $adresse = @$_POST['adresse'];
      $ville = @$_POST['ville'];
      $npa = @$_POST['npa'];
      $email = @$_POST['email'];
      $login = @$_POST['login'];
      $password = @$_POST['password'];
      $confirm_password = @$_POST['confirm_password'];

      // Retire la faille XSS si il y en a
      $nom = htmlspecialchars($nom);
      $prenom = htmlspecialchars($prenom);
      $adresse = htmlspecialchars($adresse);
      $ville = htmlspecialchars($ville);
      $npa = htmlspecialchars($npa);
      $email = htmlspecialchars($email);
      $login = htmlspecialchars($login);
      $password = htmlspecialchars($password);
      $confirm_password = htmlspecialchars($confirm_password);

      //defini l'erreur à 0
      $erreur = 0;

      //verifie si il y a des erreurs dans un ou plusieurs champs <input> et defini une erreur à la variable erreur
      if ($password != $confirm_password) {$erreur = 9;}
      if ($password == ''){$erreur = 8;}
      if ($login == ''){$erreur = 7;}
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){$erreur = 6;}
      if (($npa < 999) || ($npa > 100000)){$erreur = 5;}
      if ($ville == ''){$erreur = 4;}
      if ($adresse == ''){$erreur = 3;}
      if ($prenom == ''){$erreur = 2;}
      if ($nom == ''){$erreur = 1;}

      // Si il n'y a pas d'erreur
      if ($erreur == 0){
          // On tente d'enregistrer à l'aide de la fonction dans modèle.php
          $operation = enregistrer_user(@$_POST);
          // Verifie si l'opération est reussi
          if ($operation == '2'){
              $erreur = 'ce login est déjà utilisé !';
              require "vue/inscription.php";
          }else if ($operation == '1') {
              $erreur = 'cet email est déjà utilisé !';
              require "vue/inscription.php";
          }else{
              $erreur = 'requête envoyé avec succès';
              require "vue/vue_login.php";
          }
      // Sinon on envoie un message de l'erreur
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
                  $erreur = 'le champ de confimation du mot de passe ne correspond pas au champ au mot de passe';
                  break;
              default:
                  $erreur = 'une erreur inconnu est arrivé !';
                  break;
          }
          require "vue/inscription.php";
      }
}

// Affiche la vue vendeur
function vendeur(){
    require "vue/vue_ajout_vendeur.php";
}

// Fonction permettant d'ajouter un utilisateur en tant que vendeur
function add_vendeur()
{
    // Mettre les variables globales dans des variables locaux
    $nom = @$_POST['nom'];
    $prenom = @$_POST['prenom'];
    $adresse = @$_POST['adresse'];
    $ville = @$_POST['ville'];
    $npa = @$_POST['npa'];
    $email = @$_POST['email'];
    $login = @$_POST['login'];
    $password = @$_POST['password'];
    $confirm_password = @$_POST['confirm_password'];

    //Retire la faille XSS si il y en a
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $adresse = htmlspecialchars($adresse);
    $ville = htmlspecialchars($ville);
    $npa = htmlspecialchars($npa);
    $email = htmlspecialchars($email);
    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $confirm_password = htmlspecialchars($confirm_password);

    // Defini l'erreur à 0
    $erreur = 0;

    // Verifie si il y a des erreurs dans un ou plusieurs champs <input> et defini une erreur à la variable erreur
    if ($password != $confirm_password) {$erreur = 9;}
    if ($password == ''){$erreur = 8;}
    if ($login == ''){$erreur = 7;}
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){$erreur = 6;}
    if (($npa < 999) || ($npa > 100000)){$erreur = 5;}
    if ($ville == ''){$erreur = 4;}
    if ($adresse == ''){$erreur = 3;}
    if ($prenom == ''){$erreur = 2;}
    if ($nom == ''){$erreur = 1;}

    // Si il n'y a pas d'erreur
    if ($erreur == 0){

        // On tente d'enregistrer à l'aide de la fonction dans modèle.php
        $operation = enregistrer_vendeur(@$_POST);

        // Verifie si l'opération est reussi
        if ($operation == '2'){
            $erreur = 'ce login est déjà utilisé !';
            require "vue/vue_ajout_vendeur.php";
        }else if ($operation == '1') {
            $erreur = 'cet email est déjà utilisé !';
            require "vue/vue_ajout_vendeur.php";
        }else{
            $erreur = 'requête envoyé avec succès';
            require "vue/vue_login.php";
        }
    // Sinon on envoie un message de l'erreur
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
                $erreur = 'le champ de confimation du mot de passe ne correspond pas au champ au mot de passe';
                break;
            default:
                $erreur = 'une erreur inconnu est arrivé !';
                break;
        }
        require "vue/vue_ajout_vendeur.php";
    }
}
