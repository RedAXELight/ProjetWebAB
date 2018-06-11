<?php
/**
* User: Brian Rodrigues Fraga
* User: Alexandre.baseia
* Date: 24.05.2018
*/

session_start();
require "controleur/controleur.php";
//selection des possibilités
try {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'vue_accueil':
                accueil();
                break;
            case 'vue_login':
                login();
                break;
            case 'inscription':
                inscription();
                break;
            case 'enregistrer':
                enregistrer();
                break;
            case 'vue_ajout_vendeur':
                vendeur();
                break;
            case 'ajout_vendeur':
                add_vendeur();
                break;
            case 'ajout_produit':
                add_produit();
                break;

            default:
            throw new Exception("Action non valide");
        }
    } else {
    accueil();
    }
} catch (Exception $e) {
    erreur($e->getMessage());
}
