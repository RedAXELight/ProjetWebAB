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
            $_SESSION = [];
            require "vue/accueil.php";
        } else
            require "vue/vue_login.php";
    }
}
