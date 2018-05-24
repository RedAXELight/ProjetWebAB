<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.baseia
 * Date: 24.05.2018
 * Time: 08:39
 */

require "modele/modele.php";

function accueil()
{
    require "vue/vue_accueil.php";
}

function erreur($e)
{
    $_SESSION['erreur'] = $e;
    require "vue/vue_erreur.php";
}
