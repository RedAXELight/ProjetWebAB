<?php
/**
 * User: Brian Rodrigues Fraga
 * User: Alexandre.baseia
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

    $requete = "SELECT * FROM users WHERE usrLogin= '" . $post['fLogin'] . "' AND usrPassword='" . $post['fPass'] . "';";


    // Exécution de la requête et renvoi des résultats
    $resultats = $connexion->query($requete);
    return $resultats;
}

//verifie si le login existe, si ce n'est pas le cas, il enregitre le nouvel utilisateur dans la BD
function enregistrer_user($donnees)
{
    //connexion à la BD
    $connexion = getBD();
    //Requête pour verifier si le login existe
    $requete_verify = "SELECT usrLogin FROM Users WHERE usrLogin = '" . @$donnees['login'] . "';";
    $resultats = $connexion->query($requete_verify);
    $ligne_login = $resultats->fetch();
    //Requête pour verifier si le mail existe
    $requete_verify = "SELECT usrLogin FROM Users WHERE usrLogin = '" . @$donnees['login'] . "';";
    $resultats = $connexion->query($requete_verify);
    $ligne_email = $resultats->fetch();
    //si ils n'existent pas, on va enregistrer l'utilisateur
    if (($ligne_login == false) && ($ligne_email == false)) {
        $requete = "INSERT INTO Users (usrSurname, usrName, usrAddress, usrNPA, usrlieu, usrPassword, UserRole_idUserRole, usrLogin, usrMail) VALUES ('" . @$donnees['prenom'] . "', '" . $donnees['nom'] . "', '" . @$donnees['adresse'] . "', '" . @$donnees['npa'] . "', '" . @$donnees['ville'] . "', '" . $donnees['password'] . "', '3', '" . $donnees['login'] . "', '" . $donnees['email'] . "');";
        $resultats = $connexion->query($requete);
    } else {
        //si le login est bon, c'est que le mail existe déjà
        if ($ligne_login == false) {
            $resultats = '1';
        }
        //si le mail est bon, c'est que le login existe déjà
        if ($ligne_email == false) {
            $resultats = '2';
        }
    }
    return $resultats;
}

//verifie si le login existe, si ce n'est pas le cas, il enregitre le nouveau vendeur dans la BD
function enregistrer_vendeur($donnees)
{
    //connexion à la BD
    $connexion = getBD();
    //Requête pour verifier si le login existe
    $requete_verify = "SELECT usrLogin FROM Users WHERE usrLogin = '" . @$donnees['login'] . "';";
    $resultats = $connexion->query($requete_verify);
    $ligne_login = $resultats->fetch();
    //Requête pour verifier si le mail existe
    $requete_verify = "SELECT usrLogin FROM Users WHERE usrLogin = '" . @$donnees['login'] . "';";
    $resultats = $connexion->query($requete_verify);
    $ligne_email = $resultats->fetch();
    //si ils n'existent pas, on va enregistrer l'utilisateur
    if (($ligne_login == false) && ($ligne_email == false)) {
        $requete = "INSERT INTO Users (usrSurname, usrName, usrAddress, usrNPA, usrlieu, usrPassword, UserRole_idUserRole, usrLogin, usrMail) VALUES ('" . @$donnees['prenom'] . "', '" . $donnees['nom'] . "', '" . @$donnees['adresse'] . "', '" . @$donnees['npa'] . "', '" . @$donnees['ville'] . "', '" . $donnees['password'] . "', '2', '" . $donnees['login'] . "', '" . $donnees['email'] . "');";
        $resultats = $connexion->query($requete);
    } else {
        //si le login est bon, c'est que le mail existe déjà
        if ($ligne_login == false) {
            $resultats = '1';
        }
        //si le mail est bon, c'est que le login existe déjà
        if ($ligne_email == false) {
            $resultats = '2';
        }
    }
    return $resultats;
}

function AddProduit($Sat)
{
    $Descr = $Sat['description'];
    // connexion à la BD snows
    $connexion = getBD();
    $requete = "INSERT INTO cubesat (csName, csMass, csPrice, SolarPanel, Height, Width, Length, BatterySpace, Stock, Description) VALUES ('" . $Sat['cnom'] . "','" . $Sat['masse'] . "','" . $Sat['prix'] . "','" . $Sat['solar'] . "','" . $Sat['height'] . "','" . $Sat['width'] . "','" . $Sat['length'] . "','" . $Sat['battery'] . "','" . $Sat['stock'] . "','" . htmlentities($Descr, ENT_SUBSTITUTE, "UTF-8") . "');";
    $resultats = $connexion->query($requete); //Permet de retourner le résultat de la requête (Si par exemple on voulait directement afficher le snow entré cela pourrait être utile)
    return $resultats;
}