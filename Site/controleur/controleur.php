<?php
/**
* User: Brian Rodrigues Fraga
* User: Alexandre Baseia
* Date: 22.06.2018
*/

// pour aller chercher les fonctions qu'on a besoin
require "modele/modele.php";

// Affichage de la page de l'accueil
function accueil()
{
    $resultats = get_produits(); // pour récupérer les données des produits dans la BD
    require "vue/accueil.php";
}

// Affichage de la vue d'erreur
function erreur($e)
{
    $_SESSION['erreur'] = $e;
    require "vue/vue_erreur.php";
}

//-------------------------- USERS --------------------------------
// Fonction pour le login du formulaire
function login()
{
    if (isset ($_POST['fLogin']) && isset ($_POST['fPass'])) {
        $resultats = getLogin($_POST);
        if (($resultats == "mot de passe incorrect") || ($resultats == "Le Recapcha n'a pas été validé !")) {
            $erreur = $resultats;
        }
        require "vue/vue_login.php";
    } else {
        // détruit la session de la personne connectée après appuyé sur Logout
        if (isset($_SESSION['login'])) {
            session_destroy();
            $_SESSION = [];
            $resultats = get_produits(); // pour récupérer les données des produits dans la BD
            require "vue/accueil.php";
        } else
            require "vue/vue_login.php";
    }
}

// Fonction qui renvoie à la vue inscription
function inscription()
{
    require "vue/inscription.php";
}

// Fonction qui permet d'enregistrer les utilisateurs dans la base de données
function enregistrer()
{
    $nom = htmlspecialchars(@$_POST['nom']);
    $prenom = htmlspecialchars(@$_POST['prenom']);
    $adresse = htmlspecialchars(@$_POST['adresse']);
    $ville = htmlspecialchars(@$_POST['ville']);
    $npa = htmlspecialchars(@$_POST['npa']);
    $email = htmlspecialchars(@$_POST['email']);
    $login = htmlspecialchars(@$_POST['login']);
    $password = htmlspecialchars(@$_POST['password']);
    $confirm_password = htmlspecialchars(@$_POST['confirm_password']);

    $erreur = 0;
    // Verification des erreurs
    if ($password != $confirm_password) {
        $erreur = 9;
    }
    if ($password == '') {
        $erreur = 8;
    }
    if ($login == '') {
        $erreur = 7;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = 6;
    }
    if (($npa < 999) || ($npa > 100000)) {
        $erreur = 5;
    }
    if ($ville == '') {
        $erreur = 4;
    }
    if ($adresse == '') {
        $erreur = 3;
    }
    if ($prenom == '') {
        $erreur = 2;
    }
    if ($nom == '') {
        $erreur = 1;
    }

    // Si il n'y a pas d'erreur
    if ($erreur == 0) {
        $operation = enregistrer_user(@$_POST);
        if ($operation == '3') {
            $erreur = 'reCAPTCHA non validé';
            require "vue/inscription.php";
        } else if ($operation == '2') {
            $erreur = 'ce login est déjà utilisé !';
            require "vue/inscription.php";
        } else if ($operation == '1') {
            $erreur = 'cet email est déjà utilisé !';
            require "vue/inscription.php";
        } else {
            $erreur = 'requête envoyé avec succès';
            require "vue/vue_login.php";
        }
    // Si il y a une erreur
    } else {
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

// Fonction pour envoyé à la vue ajout vendeur
function vendeur()
{
    if (isset($_SESSION['typeUser']) && (($_SESSION['typeUser'] = "Administrateur"))) { //sécurise les pages et les fonctions réservées à certains utilisateurs
    require "vue/vue_ajout_vendeur.php";
    } else {
        $_SESSION['erreur'] = "Erreur 403 : Accès non autorisé !";
        require "vue/vue_erreur.php";
    }
}

// Fonction permetant d'ajouter un nouveau vendeur dans la base de données
function add_vendeur()
{
    $nom = htmlspecialchars(@$_POST['nom']);
    $prenom = htmlspecialchars(@$_POST['prenom']);
    $adresse = htmlspecialchars(@$_POST['adresse']);
    $ville = htmlspecialchars(@$_POST['ville']);
    $npa = htmlspecialchars(@$_POST['npa']);
    $email = htmlspecialchars(@$_POST['email']);
    $login = htmlspecialchars(@$_POST['login']);
    $password = htmlspecialchars(@$_POST['password']);
    $confirm_password = htmlspecialchars(@$_POST['confirm_password']);

    $erreur = 0; //controle du type d'erreur

    if ($password != $confirm_password) {
        $erreur = 9;
    }
    if ($password == '') {
        $erreur = 8;
    }
    if ($login == '') {
        $erreur = 7;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = 6;
    }
    if (($npa < 999) || ($npa > 100000)) {
        $erreur = 5;
    }
    if ($ville == '') {
        $erreur = 4;
    }
    if ($adresse == '') {
        $erreur = 3;
    }
    if ($prenom == '') {
        $erreur = 2;
    }
    if ($nom == '') {
        $erreur = 1;
    }

    // Si il y a pas d'erreur
    if ($erreur == 0) {
        $operation = enregistrer_vendeur(@$_POST);
        if ($operation == '2') {
            $erreur = 'ce login est déjà utilisé !';
            require "vue/vue_ajout_vendeur.php";
        } else if ($operation == '1') {
            $erreur = 'cet email est déjà utilisé !';
            require "vue/vue_ajout_vendeur.php";
        } else {
            $erreur = 'requête envoyé avec succès';
            require "vue/vue_login.php";
        }
    // Si il y a une erreur
    } else {
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

//-----------------------PRODUITS-----------------------------------
// Fonction pour afficher la vue de la liste des produits
function produits()
{
    $resultats = get_produits();
    require "vue/vue_liste_produits.php";
}

// Function permetant d'afficher tout les détails d'un produit dans la vue detail produit
function produit_detail()
{
    $id = @$_GET['id'];
    $resultats = GetProduit($id);
    require "vue/vue_detail_produit.php";
}

// Fonction ajouter et afficher la PAGE de produits
function add_produit()
{
    if (isset ($_POST['cnom']) && isset ($_POST['masse']) && isset ($_POST['prix']) && isset ($_POST['solar']) && isset ($_POST['height']) && isset ($_POST['width']) && isset ($_POST['length']) && isset ($_POST['battery']) && isset ($_POST['stock']) && isset ($_POST['description'])) {
        $resultats = AddProduit($_POST);
        $resultats = get_produits(); // pour récupérer les données des produits dans la BD
        require 'vue/vue_liste_produits.php';
    } else {
        require "vue/vue_ajout_produit.php";
    }
}


// Fonction permetant de rechercher des données de la page de modif
function modifier_get($id)
{
    if (isset($_SESSION['typeUser']) && (($_SESSION['typeUser'] = "Administrateur") || ($_SESSION['typeUser'] = "Vendeur"))) { //sécurise les pages et les fonctions réservées à certains utilisateurs
        $resultats = GetProduit($id);
        require 'vue/vue_modifier.php';
    } else {
        $_SESSION['erreur'] = "Erreur 403 : Accès non autorisé !";
        require "vue/vue_erreur.php";
    }

}

// Fonction pour Afficher la page de modif
function modifierproduit($ValModif)
{

    UpdateProduit($ValModif);
    $resultats = get_produits(); // pour récupérer les données des produits dans la BD
    require 'vue/vue_liste_produits.php';

}

// Fonction de suppression d'un produit
function suppr($id)
{
    if (isset($_SESSION['typeUser']) && (($_SESSION['typeUser'] = "Administrateur") || ($_SESSION['typeUser'] = "Vendeur"))) { //sécurise les pages et les fonctions réservées à certains utilisateurs
        $idCible = $id;
        Suppression($idCible);
        $resultats = get_produits(); // pour récupérer les données des produits dans la BD
        require 'vue/vue_liste_produits.php';
    } else {
        $_SESSION['erreur'] = "Erreur 403 : Accès non autorisé !";
        require "vue/vue_erreur.php";
    }
}

//----------------------------CONTACT----------------------------------
// Fonction pour envoyé un mail de contact (non fonctionnel :( ))
function mailsend()
{
    if (isset($_POST['email']) && isset ($_POST['subject']) && isset ($_POST['message'])) {
        sendMail($_POST);
        require "vue/contact.php";
    } else {
        require "vue/contact.php";
    }
}

// Fonction permetant d'afficher la vue de contact
function contact()
{
    require "vue/contact.php";
}

//----------------------------PANIER----------------------------------
// Fonction pour gérer un panier
function panier()
{
    $erreur = false;

    $action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));
    if ($action !== null) {
        if (!in_array($action, array('ajout', 'suppression', 'refresh')))
            $erreur = true;
        //récuperation des variables en POST ou GET
        $l = (isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null));
        $p = (isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null));
        $q = (isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null));
        //Suppression des espaces verticaux
        $l = preg_replace('#\v#', '', $l);
        //On verifie que $p soit un float
        $p = floatval($p);
        //On traite $q qui peut etre un entier simple ou un tableau d'entier
        if (is_array($q)) {
            $QteArticle = array();
            $i = 0;
            foreach ($q as $contenu) {
                $QteArticle[$i++] = intval($contenu);
            }
        } else {
            $q = intval($q);
        }
    }

    if (!$erreur) {
        switch ($action) {
            Case "ajout":
                ajouterArticle($l, $q, $p);
                break;
            Case "suppression":
                supprimerArticle($l);
                break;
            Case "refresh" :
                for ($i = 0; $i < count($QteArticle); $i++) {
                    modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
                }
                break;
            Default:
                break;
        }
    }
    require "vue/vue_panier.php";
}
