<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:10
 */

require "modele/modele.php";

// Affichage de la page de l'accueil
function accueil()
{
  require "vue/vue_accueil.php";
}

function erreur($e)
{
  $_SESSION['erreur']=$e;
  require "vue/vue_erreur.php";
}

// ----------------- Fonctions en lien avec les snows ---------------------

function snows()
{
  $resultats=getSnows(); // pour récupérer les données des snows dans la BD
  require 'vue/vue_snows.php';
}

// --------------------- Fonction utiliateur --------------------------

function login()
{
  if (isset ($_POST['fLogin']) && isset ($_POST['fPass']))
  {
    $resultats = getLogin($_POST);
    require "vue/vue_user_login.php";
  }
  else
  {
    // détruit la session de la personne connectée après appuyé sur Logout
    if (isset($_SESSION['login'])) {
      session_destroy();
      require "vue/vue_accueil.php";
    }
    else
      require "vue/vue_user_login.php";
  }
}
