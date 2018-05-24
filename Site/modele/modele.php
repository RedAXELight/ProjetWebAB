<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.baseia
 * Date: 24.05.2018
 * Time: 08:27
 */


function getDB()
{
    //Set databse connexion
    $connexion = new PDO('mysql:host=localhost; dbname=cubesat', 'root', '');

    //Get more error details
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
}


//-------------------------USERS-------------------------------

//compare les données envoyées par le formulaire avec celle de la bd
function getLogin($post)
{
    // connexion à la BD snows
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