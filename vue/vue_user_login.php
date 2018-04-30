<?php
  $titre ='Rent A Snow - Login/Logout';

// vue_login.php
// Date de création : 28/11/16
// Date de modification : 
// Auteur : PBA
// Fonction : vue pour l'affichage la connexion utilisateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2>Login / Logout</h2>

<article>
  <?php
  if (isset($resultats))
  {
    // les données dans le formulaire sont exactes
    $ligne=$resultats->fetch();
    // Test pour savoir si on est vendeur ou client
    if (isset($ligne['idClient']))
    {
      echo "Bonjour ".$ligne['prenomClient']." ".$ligne['nomClient'].". Vous êtes bien connecté en tant que client";
      // Création de la session
      $_SESSION['login']=$ligne['prenomClient']." ".$ligne['nomClient'];
      $_SESSION['typeUser']="Client";
    }
    else
    {
      if (isset($ligne['idVendeur']))
      {
        echo "Bonjour ".$ligne['prenomVendeur']." ".$ligne['nomVendeur'].". Vous êtes bien connecté en tant que vendeur";
        // Création de la session
        $_SESSION['login']=$ligne['prenomVendeur']." ".$ligne['nomVendeur'];
        $_SESSION['typeUser']="Vendeur";
      }
      else
        echo "Erreur de login";
    }
  }
  else
  {
  if (isset($_SESSION['login']))
  {
    session_destroy();
    header ("location:index.php");
  }
  ?>

  <form class='form' method='POST' action="index.php?action=vue_login">
  <table class="table">
    <tr>
      <td>Login</td>
      <td>
        <input type="text" placeholder="Entrez votre login" name="fLogin" value="<?=@$_POST['fLogin'] ?>"/>
        <!-- code php pour éviter de retaper le contenu en cas d'erreur --> 
      </td>
    </tr>
    <tr>
      <td>Mot de passe</td>
      <td>
        <input type="password" placeholder="Entrez votre mot de passe" name="fPass" value="<?=@$_POST['fPass'] ?>"/>
      </td>
    </tr>
    <tr>
      <td>Client : <input type="radio" name="fUserType" value="Client" checked></td> 
      <td>Vendeur : <input type="radio" name="fUserType" value="Vendeur"></td> 
    </tr>
    <tr>
      <td><input type="submit" value="Login"></td> 
      <td><input type="reset" value="Effacer"></td> 
    </tr>    
  </table>
  </form>

<?php } ?>
</article>
<hr/>

<?php 
  $contenu = ob_get_clean();
  require 'gabarit.php';
?>  
      
      
      