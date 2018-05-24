<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

session_start();
require "controleur/controleur.php";

try {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'vue_accueil':
                accueil();
                break;
            case 'vue_contact':
                contact();
                break;
            default :
                throw new Exception("Action non valide");
        }
    } else
        accueil();
} catch (Exception $e) {
    erreur($e->getMessage());
}
