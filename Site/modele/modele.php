<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:15
 */

// ---------------------------------------------
// getBD()
// Fonction : connexion avec le serveur : instancie et renvoie l'objet PDO
// Sortie : $connexion

function getBD()
{
  // connexion au server de BD MySQL et à la BD
  $connexion = new PDO('mysql:host=localhost; dbname=snows', 'root', '***');
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

function getASnow($ID)
{
  $connexion= getBD();
  $requete= "SELECT * FROM tblsurfs WHERE idsurf='".$ID."';";
  $resultat = $connexion->query($requete);
  return $resultat;
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