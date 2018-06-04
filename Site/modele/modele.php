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
  $connexion = new PDO('mysql:host=localhost; dbname=cubesat', 'root', '');
  // permet d'avoir plus de détails sur les erreurs retournées
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $connexion;
}

// -----------------------------------------------------



//-------------------------USERS-------------------------------

//compare les données envoyées par le formulaire avec celle de la bd
function getLogin($post)
{
    // connexion à la BD GalaxSat
    $connexion = getBD();
    // Requête pour sélectionner la personne loguée
    if ($post['fUserType'] == 'Client')
    {
        $requete = "SELECT * FROM Users WHERE login= '".$post['fLogin']."' AND usrPassword='".$post['fPass']."' AND UserRole_idUserRole = 'client';";
    }
    else
    {
        $requete = "SELECT * FROM Users WHERE login= '".$post['fLogin']."' AND usrPassword='".$post['fPass']."';";
    }
    // Exécution de la requête et renvoi des résultats
    $resultats = $connexion->query($requete);
    return $resultats;
}

//verifie si le login existe, si ce n'est pas le cas, il enregitre le nouvel utilisateur dans la BD
function enregistrer_user($donnees) {
    //connexion à la BD
    $connexion = getBD();
    //Requête pour verifier si le login existe
    $requete_verify = "SELECT login FROM Users WHERE login= '".@$donnees['login']."';";
    $resultats = $connexion->query($requete_verify);
    //si n'existe pas, on va enregistrer l'utilisateur
    if ($resultats == ''){
        $requete= "INSERT INTO Users (usrSurname, usrName, usrAddress, usrNPA, usrlieu, usrPassword, UserRole_idUserRole, usrLogin, usrMail) VALUES ('".@$donnees['prenom']."', '".$donnees['nom']."', '".@$donnees['adresse']."', '".@$donnees['npa']."', '".@$donnees['ville']."', '".$donnees['password']."', '3', '".$donnees['login']."', '".$donnees['email']."');";
        $resultats = $connexion->query($requete);
    }else{
        $resultats = '';
    }
    return $resultats;
}
