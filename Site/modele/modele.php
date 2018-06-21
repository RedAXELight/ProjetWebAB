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

//
//-------------------------USERS-------------------------------

//compare les données envoyées par le formulaire avec celle de la bd
function getLogin($post)
{
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $privatekey = "6LcU-F8UAAAAAIlo3VsLDyhiKIiJPd4lXJH3rKUN";
    $reponseAPI = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

    $dataAPI = json_decode($reponseAPI);

   /* if(isset($dataAPI->success) AND $dataAPI->success==true){*/
        // connexion à la BD GalaxSat
        $connexion = getBD();
        // passe les variables en local et sécurise la faille XSS
        $Login = htmlspecialchars(@$_POST['fLogin']);
        $Pass = htmlspecialchars(@$_POST['fPass']);
        // prepare la requête à executer dans la base de données
        $resultats = $connexion->prepare("SELECT * FROM users WHERE usrLogin = :login AND usrPassword = :password");
        // execute la requête avec les variables et récupère les résultats dans la variable $resultats
        $resultats->execute([
            'login' => $Login,
            'password' => $Pass
        ]);
        //retourne la valeur de la variable résultat
        return $resultats;
    /*}else{
        $erreur = "Le Recapcha n'a pas été validé !";
    }*/
}

// verifie si le login existe, si ce n'est pas le cas, il enregitre le nouvel utilisateur dans la BD
function enregistrer_user($donnees)
{
    // connexion à la BD
    $connexion = getBD();
    // passe les variables en local et sécurise la faille XSS
    $login = htmlspecialchars(@$donnees['login']);
    $prenom = htmlspecialchars(@$donnees['prenom']);
    $nom = htmlspecialchars(@$donnees['nom']);
    $adresse = htmlspecialchars(@$donnees['adresse']);
    $npa = htmlspecialchars(@$donnees['npa']);
    $ville = htmlspecialchars(@$donnees['ville']);
    $password = htmlspecialchars(@$donnees['password']);
    $email = htmlspecialchars(@$donnees['email']);
    // requête pour verifier si le login existe
    $requete_verify = $connexion->prepare("SELECT usrLogin FROM users WHERE usrLogin = :login");
    $requete_verify->execute([
        'login' => $login,
        ]);

    $ligne_login = $requete_verify->fetch();
    //Requête pour verifier si le mail existe
    $requete_verify = $connexion->prepare("SELECT usrMail FROM users WHERE usrLogin = :login");
    $requete_verify->execute([
        'login' => $login,
        ]);
    $ligne_email = $requete_verify->fetch();
    //si ils n'existent pas, on va enregistrer l'utilisateur
    if (($ligne_login == false) && ($ligne_email == false)) {
        $resultats = $connexion->prepare("INSERT INTO users (usrSurname, usrName, usrAddress, usrNPA, usrlieu, usrPassword, UserRole_idUserRole, usrLogin, usrMail) VALUES (:prenom, :nom, :adresse, :npa, :ville, :password, '3', :login, :email)");
        $resultats->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'adresse' => $adresse,
            'npa' => $npa,
            'ville' => $ville,
            'password' => $password,
            'login' => $login,
            'email' => $email,

            ]);
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
    $requete_verify = "SELECT usrLogin FROM users WHERE usrLogin = '" . @$donnees['login'] . "';";
    $resultats = $connexion->query($requete_verify);
    $ligne_login = $resultats->fetch();
    //Requête pour verifier si le mail existe
    $requete_verify = "SELECT usrLogin FROM users WHERE usrLogin = '" . @$donnees['login'] . "';";
    $resultats = $connexion->query($requete_verify);
    $ligne_email = $resultats->fetch();
    //si ils n'existent pas, on va enregistrer l'utilisateur
    if (($ligne_login == false) && ($ligne_email == false)) {
        $requete = "INSERT INTO users (usrSurname, usrName, usrAddress, usrNPA, usrlieu, usrPassword, UserRole_idUserRole, usrLogin, usrMail) VALUES ('" . @$donnees['prenom'] . "', '" . $donnees['nom'] . "', '" . @$donnees['adresse'] . "', '" . @$donnees['npa'] . "', '" . @$donnees['ville'] . "', '" . $donnees['password'] . "', '2', '" . $donnees['login'] . "', '" . $donnees['email'] . "');";
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

function get_produits()
{
    // connexion à la base de données
    $connexion = getBD();
    // definir la requête SQL
    $requete = "SELECT * FROM cubesat WHERE Disponible = 1 ORDER BY idCubeSat;";
    // permet d'exécuter la requête et de retourner les résultats de la requête
    $resultats = $connexion->query($requete);
    // retourne les résultats de la fonction
    return $resultats;
}

//Va chercher les infos d'un seul produit pour la modification ou l'affichage en détail d'un produit
function sendMail($datamail)
{
    ini_set('SMTP', 'smtp.heavnwolf.ch');//remplacer le nom du smtp
    $to = 'Alexandre.baseia@cpnv.ch'/*; Brian.rodrigues-fraga@cpnv.ch'*/;
    $subject = $datamail['subject'];
    $from = $datamail['email'];
    $message = $datamail['message'];
    $toSend = "Envoyé par : ".$from."\n..".$message;
    $toSend = mb_convert_encoding($toSend, "UTF-8");
    mail($to, $subject, $toSend);
}

//-----------------------Produits--------------------------
//Fonction d'ajout du produit
function AddProduit($Sat)
{
    $Descr = $Sat['description'];
    // connexion à la BD snows
    $connexion = getBD();
    $requete = "INSERT INTO cubesat (csName, csMass, csPrice, SolarPanel, Height, Width, Length, BatterySpace, Stock, Description) VALUES ('" . $Sat['cnom'] . "','" . $Sat['masse'] . "','" . $Sat['prix'] . "','" . $Sat['solar'] . "','" . $Sat['height'] . "','" . $Sat['width'] . "','" . $Sat['length'] . "','" . $Sat['battery'] . "','" . $Sat['stock'] . "','" . htmlentities($Descr, ENT_SUBSTITUTE, "UTF-8") . "');";
    $resultats = $connexion->query($requete); //Permet de retourner le résultat de la requête (Si par exemple on voulait directement afficher le produit entré cela pourrait être utile)
    return $resultats;
}

//Va chercher les infos d'un seul produit pour la modification
function GetProduit($idcible)
{
    //connexion à la bd
    $connexion = getBD();
    $requete = "SELECT * FROM cubesat WHERE idCubeSat = '" . $idcible . "';";
    $resultats = $connexion->query($requete);
    return $resultats; //dans ce cas de figure il est utile de retourner la variable resultat
}

//fonction de modification d'un produit
function UpdateProduit($ValModif)
{
    //connexion à la bd
    $connexion = getBD();
    $requete = "UPDATE cubesat SET csName = '" . $ValModif['cnom'] . "', csMass = '" . $ValModif['masse'] . "', csPrice = '" . $ValModif['prix'] . "', SolarPanel = '" . $ValModif['solar'] . "', Height = '" . $ValModif['height'] . "', Width = '" . $ValModif['width'] . "', Length = '" . $ValModif['length'] . "', BatterySpace = '" . $ValModif['battery'] . "', Stock = '" . $ValModif['stock'] . "', Description = '" . htmlentities($ValModif['description'], ENT_SUBSTITUTE, "UTF-8") . "' WHERE idCubeSat = '" . $ValModif['id'] . "' ;";
    $resultats = $connexion->query($requete);
    return $resultats;
}

//Désactivation de l'affichage d'un produit
function Suppression($idCible)
{
    //connexion à la bd
    $connexion = getBD();
    $requete = "UPDATE cubesat SET Disponible = 0 WHERE idCubeSat = '" . $idCible . "';";
    $resultats = $connexion->query($requete);
    return $resultats;
}
