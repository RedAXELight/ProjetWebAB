<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

// ---------------------------------------------
// getBD()
// Fonction : connexion avec le serveur : instancie et renvoie l'objet PDO
// Sortie : $connexion

function getBD()
{
  // connexion au server de BD MySQL et à la BD
  $connexion = new PDO('mysql:host=localhost; dbname=snows', 'root', '');
  // permet d'avoir plus de détails sur les erreurs retournées
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $connexion;
}

// -----------------------------------------------------
// Fonctions liées aux snows

// getSnows()
// Fonction : Récupérer les données des snows
// Sortie : $resultats

function getSnows()
{
  // Connexion à la BD et au serveur
  $connexion = getBD();

  // Création de la string pour la requête
  $requete = "SELECT * FROM tblsurfs ORDER BY idsurf;";
  // Exécution de la requête
  $resultats = $connexion->query($requete);
  return $resultats;
}

// ------------------------ Sélection d'un snow --------------------

function getASnow()
{
  $connexion= getBD();
  $requete= "SELECT * FROM tblsurfs WHERE idsurf='".@$_GET['ID']."';";
  $resultat = $connexion->query($requete);
  return $resultat;
}

// ------------------------ Ajouter un snow ------------------------

function addSnowDB(){
    $connexion= getBD();
    $requete= "INSERT INTO tblsurfs (idsurf, marque, boots, type, disponibilite, statut) VALUES ('".@$_POST['fID']."', '".@$_POST['fMarque']."', '".@$_POST['fBoots']."', '".@$_POST['fType']."', '".@$_POST['fDispo']."', '');";
    $resultat = $connexion->query($requete);
    return $resultat;
}

// ------------------------ supprimer un snow ----------------------

function delSnowDB(){
    $connexion= getBD();
    $requete= "DELETE FROM tblsurfs WHERE idsurf = '".@$_GET['ID']."';";
    $resultat = $connexion->query($requete);
    return $resultat;
}

function editSnowDB(){  //bug, ID est vide alors qu'il devrais avoir l'id du snow en question
    $connexion= getBD();
    $requete= "UPDATE tblsurfs SET idsurf = '".@$_POST['fID']."',marque = '".@$_POST['fMarque']."', boots = '".@$_POST['fBoots']."', type = '".@$_POST['fType']."', disponibilite = '".@$_POST['fDispo']."' WHERE idsurf = '".@$_GET['ID']."';";
    $resultat = $connexion->query($requete);
    return $resultat;
}

function newSnow() {
// Initialisation du panier
$_SESSION['panier'] = array();
//subdivision du panier
$_SESSION['panier']['idsurf'] = array();
$_SESSION['panier']['marque'] = array();
$_SESSION['panier']['boots'] = array();
$_SESSION['panier']['type'] = array();
}

// -----------------------------------------------------
// Fonctions liées aux utilisateurs

// ---------------------------------------------------
// getLogin()
// Fonction : Récupérer les données du login de la BD
// Sortie : $resultats

function getLogin($post)
{
  // connexion à la BD snows
  $connexion = getBD();

  // Requête pour sélectionner la personne loguée
  if ($post['fUserType'] == 'Client')
  {
    $requete = "SELECT * FROM tblclients WHERE login= '".$post['fLogin']."' AND passwd='".$post['fPass']."';";
  }
  else
  {
    $requete = "SELECT * FROM tblvendeurs WHERE login= '".$post['fLogin']."' AND passwd='".$post['fPass']."';";
  }

  // Exécution de la requête et renvoi des résultats
  $resultats = $connexion->query($requete);
  return $resultats;
}
