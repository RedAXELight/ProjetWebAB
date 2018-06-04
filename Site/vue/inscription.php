<?php
/**
* User: Brian Rodrigues Fraga
* Date: 28.05.2018
*/

// tampon de flux stocké en mémoire
ob_start();
$titre="GalaxSat - inscription";
$intitule = "Inscrivez-vous";
$SousMenu="Afin de profiter de nos offres";
?>

<section id="service" class="home-section text-center bg-gray">

  <div class="heading-about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow bounceInDown" data-wow-delay="0.4s">
            <div class="section-heading">
              <h2>Inscription</h2>
              <i class="fa fa-2x fa-angle-down"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: form inscription -->
<section id="contact" class="home-section text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
          <?php if (isset($erreur)){
          echo "<div class='alert alert-danger'>".$erreur."</div>";
          }
          ?>
        <div class="form-group wow bounceInDown" data-wow-delay="0.4s>
          <form class="form" role="form" data-toggle="validator" method="POST" action="index.php?action=enregistrer">
            <table class="table table-hover">
              <tr>
                <td><label>Nom : </label></td>
                <td><input type="text" class="form-control" placeholder="Entrez votre nom" name="nom" value="<?= @$_POST['nom']; ?>" required></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td><label>Prenom : </label></td>
                <td><input type="text" class="form-control" placeholder="Entrez votre prénom" name="prenom" value="<?= @$_POST['prenom']; ?>" required></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td><label>Adresse : </label></td>
                <td><input type="text" class="form-control" placeholder="Entrez votre adresse" name="adresse" value="<?= @$_POST['adresse']; ?>" required></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td><label>Ville : </label></td>
                <td><input type="text" class="form-control" placeholder="Entrez votre ville" name="ville" value="<?= @$_POST['ville']; ?>" required></td>
                <td><label>NPA : </label></td>
                <td><input type="number" class="form-control" placeholder="1234" name="npa" min="1000" max="99999" value="<?= @$_POST['npa']; ?>" required></td>
              </tr>
              <tr>
                <td><label>Email : </label></td>
                <td><input type="email" class="form-control" placeholder="Entrez votre email" name="email" value="<?= @$_POST['email']; ?>" required></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td><label>Login : </label></td>
                <td><input type="text" class="form-control" placeholder="Entrez votre login" name="login" value="<?= @$_POST['login']; ?>" required></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="align-center"><label>Mot de passe : </label></td>
                <td>
                  <?php if (isset($_POST['erreur'])) : ?>
                    <input type="password" class="form-control" placeholder="Entrez votre mot de passe" class="inputError" name="password" value="<?= @$_POST['password'];?>" required>
                  <?php else : ?>
                    <input type="password" class="form-control" placeholder="Entrez votre mot de passe" name="password" required>
                  <?php endif ?>
                </td>
                <td><label>Confirmer le mot de passe : </label></td>
                <td><input type="password" class="form-control" placeholder="Répétez le mot de passe" name="confirm_password" required>
                </tr>
                <tr>
                  <td></td>
                  <td><div class="g-recaptcha" data-sitekey="6Lc6L08UAAAAALOJt6xF1OIQY9AvrJ6_7H0K6a3Y"></div></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><input class="btn" type="reset" value="Effacer"/></td>
                  <td><input class="btn btn-skin" type="submit" value="Confirmer"/></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>

    </div>
  </section>

  <?php
  $contenu = ob_get_clean();
  require "gabarit.php";
  ?>
