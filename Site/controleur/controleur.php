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

function contact()
{
  require "vue/contact.php";
}
// ----------------- Fonctions en lien avec les snows ---------------------

function snows()
{
    if ((isset($_POST['fID']))&&(isset($_POST['fMarque']))&&(isset($_POST['fBoots']))&&(isset($_POST['fType']))&&(isset($_POST['fDispo']))){
        if (@$_GET['edit'] == 1){
            editSnowDB();
            @$_POST['errormessage'] = "edition envoyé avec succès !";
        }
        else {
            addSnowDB();
            @$_POST['errormessage'] = "ajout envoyé avec succès !";
        }
    }
    if (isset($_GET['addpanier'])) {
        if (!isset($_SESSION['panier'])) {
            newPanier();
            //ajout d'un aticle
        }else{
            //ajout d'un aticle
        }
    }

    $resultats = getSnows(); // pour récupérer les données des snows dans la BD
    require 'vue/vue_snows.php';
}

function addSnow()
{
    require 'vue/vue_add_snow.php';
}

function editASnow()
{
    $snow = getASnow();
    require 'vue/vue_upd_snow.php';
}

function delSnow()
{
    delSnowDB();
    @$_POST['errormessage'] = "suppression envoyé avec succès !";
    require 'vue/vue_del_snow.php';
}


// --------------------- Fonction utiliateur --------------------------

function login()
{
    if (isset ($_POST['fLogin']) && isset ($_POST['fPass'])) {
        $resultats = getLogin($_POST);
        require "vue/vue_user_login.php";
    } else {
        // détruit la session de la personne connectée après appuyé sur Logout
        if (isset($_SESSION['login'])) {
            session_destroy();
            require "vue/vue_accueil.php";
        } else
            require "vue/vue_user_login.php";
    }
}

// ---------------------- Fonction lié au panier -------------------------------

function panier(){
  require 'vue/vue_panier.php';
}
