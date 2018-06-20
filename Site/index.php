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
            case 'vue_produits':
                produits();
                break;
            case 'vue_detail_produit':
                produit_detail();
                break;
            case 'ajout_produit':
                add_produit();
                break;
            case 'vue_contact':
                contact();
                break;
            case 'contact':
                mailsend();
                break;
            case 'vue_modifier' :
                modifier_get($_GET['id']); //cette partie là va chercher le produit
                break;
            case 'modifierproduit' :
                modifierproduit($_POST); //cette partie là envoie un tableau POST avec les modification du formulaire
                break;
            case 'supprimer_produit':
                suppr($_GET['id']);
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
