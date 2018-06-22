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
    /*$url = 'https://www.google.com/recaptcha/api/siteverify';
    $privatekey = "6LcU-F8UAAAAAIlo3VsLDyhiKIiJPd4lXJH3rKUN";
    $reponseAPI = file_get_contents($url . "?secret=" . $privatekey . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

    $dataAPI = json_decode($reponseAPI);

    if (isset($dataAPI->success) AND $dataAPI->success == true) {*/
    // connexion à la BD GalaxSat
    $connexion = getBD();
    // passe les variables en local et sécurise la faille XSS
    $Login = htmlspecialchars(@$_POST['fLogin']);
    $Pass = htmlspecialchars(@$_POST['fPass']);
    // prepare la requête à executer dans la base de données
    $resultats = $connexion->prepare("SELECT * FROM users WHERE usrLogin = :login");
    // execute la requête avec les variables et récupère les résultats dans la variable $resultats
    $resultats->execute([
        'login' => $Login,
    ]);
    // les données dans le formulaire sont exactes
    $ligne = $resultats->fetch();
    $password_DB = $ligne['usrPassword'];
    if (hash_equals($password_DB, crypt($Pass, '3alvMerHDtc0tYQfjf0Cv6RxHD1BtFRBtg8U5N8x'))) {
        //retourne la valeur de la variable résultat
        return $ligne;
    } else {
        $resultats = "mot de passe incorrect";
        return $resultats;
    }


    /*} else {
    $resultats = "Le Recapcha n'a pas été validé !";
    return $resultats;
}*/
}

// verifie si le login existe, si ce n'est pas le cas, il enregitre le nouvel utilisateur dans la BD
function enregistrer_user($donnees)
{
    /*$url = 'https://www.google.com/recaptcha/api/siteverify';
    $privatekey = "6LcU-F8UAAAAAIlo3VsLDyhiKIiJPd4lXJH3rKUN";
    $reponseAPI = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

    $dataAPI = json_decode($reponseAPI);

    if(isset($dataAPI->success) AND $dataAPI->success==true){*/
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
    $password = crypt($password, '3alvMerHDtc0tYQfjf0Cv6RxHD1BtFRBtg8U5N8x');
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
        $resultats = '0';
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
    /*} else {
    $resultats = '3';
}*/
    return $resultats;
}

//-----------------------Produits--------------------------

//verifie si le login existe, si ce n'est pas le cas, il enregitre le nouveau vendeur dans la BD
function enregistrer_vendeur($donnees)
{
    /*$url = 'https://www.google.com/recaptcha/api/siteverify';
    $privatekey = "6LcU-F8UAAAAAIlo3VsLDyhiKIiJPd4lXJH3rKUN";
    $reponseAPI = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

    $dataAPI = json_decode($reponseAPI);

    if(isset($dataAPI->success) AND $dataAPI->success==true){*/
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
    $password = crypt($password, '3alvMerHDtc0tYQfjf0Cv6RxHD1BtFRBtg8U5N8x');
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
        $resultats = $connexion->prepare("INSERT INTO users (usrSurname, usrName, usrAddress, usrNPA, usrlieu, usrPassword, UserRole_idUserRole, usrLogin, usrMail) VALUES (:prenom, :nom, :adresse, :npa, :ville, :password, '2', :login, :email)");
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
        $resultats = '0';
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
    /*} else {
    $resultats = '3';
}*/
    return $resultats;
    }

//Va chercher tous les produits dans la base de données
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

//----------------------- Mail --------------------------

    function sendMail($datamail)
    {
        ini_set('SMTP', 'smtp.heavnwolf.ch');//remplacer le nom du smtp
        $to = 'Alexandre.baseia@cpnv.ch'/*; Brian.rodrigues-fraga@cpnv.ch'*/
        ;
        $subject = $datamail['subject'];
        $from = $datamail['email'];
        $message = $datamail['message'];
        $toSend = "Envoyé par : " . $from . "\n.." . $message;
        $toSend = mb_convert_encoding($toSend, "UTF-8");
        mail($to, $subject, $toSend);
    }

//----------------------- Panier --------------------------

//permet d'initialiser un panier (créer un panier)
    function creationPanier()
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }

// permet d'ajouter un article à notre panier
    function ajouterArticle($libelleProduit, $qteProduit, $prixProduit)
    {

        //Si le panier existe
        if (creationPanier() && !isVerrouille()) {
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            } else {
                //Sinon on ajoute le produit
                array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
                array_push($_SESSION['panier']['qteProduit'], $qteProduit);
                array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            }
        } else {
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

// permet de supprimer un article du panier
    function supprimerArticle($libelleProduit)
    {
        //Si le panier existe
        if (creationPanier() && !isVerrouille()) {
            //Nous allons passer par un panier temporaire
            $tmp = array();
            $tmp['libelleProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
                if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit) {
                    array_push($tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                    array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                    array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
                }
            }

            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] = $tmp;

            //On efface notre panier temporaire
            unset($tmp);
        } else {
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

// permet de modifier la quantité des produits dans le panier
    function modifierQTeArticle($libelleProduit, $qteProduit)
    {
        //Si le panier éxiste
        if (creationPanier() && !isVerrouille()) {
            //Si la quantité est positive on modifie sinon on supprime l'article
            if ($qteProduit > 0) {
                //Recharche du produit dans le panier
                $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

                if ($positionProduit !== false) {
                    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
                }
            } else {
                supprimerArticle($libelleProduit);
            }
        } else {
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
    }

// montant de tout le panier
    function MontantGlobal()
    {
        $total = 0;
        for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }

// fonction de vérification du verrou
    function isVerrouille()
    {
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou']) {
            return true;
        } else {
            return false;
        }
    }

// Cette fonction vérifie seulement l'état du verrou sans affecter le panier.
    function compterArticles()
    {
        if (isset($_SESSION['panier'])) {
            return count($_SESSION['panier']['libelleProduit']);
        } else {
            return 0;
        }
    }

// cette fonction sert à supprimer le panier existant
    function supprimePanier()
    {
        unset($_SESSION['panier']);
    }
