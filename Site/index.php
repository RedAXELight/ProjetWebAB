<?php

require "controleur/controleur.php";

try {
    if (isset($_GET['action'])) { //Prend l'action pour l'envoyer vers la fonction correspondante dans le controleur
        $action = $_GET['action'];
        switch ($action) {
            case 'vue_accueil':
                accueil();
                break;
            case 'vue_login':
                login();
                break;

            default:
                throw new Exception("Action non valide");
        }
    } else accueil();
} catch (Exception $e) {
    erreur($e->getMessage());
}