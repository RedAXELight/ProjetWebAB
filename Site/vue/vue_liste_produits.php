<?php
/**
* User: Brian Rodrigues Fraga
* Date: 14.06.2018
*/
// tampon de flux stocké en mémoire
ob_start();
$titre="GalaxSat - Produits";
$intitule="Liste de produits";
$SousMenu="Made by GalaxSat";
$Credits="Icons made by Freepik from www.flaticon.com";

$nbr_produits = 21;
?>

<!-- Section: about -->
<section id="produits" class="home-section text-center">
  <div class="heading-about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow bounceInDown" data-wow-delay="0.1s">
            <div class="section-heading">
              <h2>Nos produits</h2>
              <i class="fa fa-2x fa-angle-down"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- marge -->
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-50">
      </div>
    </div>
    <!-- les produits -->

    <div class="row">
    <?php for ($i=$nbr_produits;$i>0;$i--) {
        if ($nbr_produits > 0) {?>
      <div class="col-md-3" style="padding: 10px;">
        <div class="wow bounceInUp" data-wow-delay="0.2s">
          <div class="team boxed-grey">
            <div class="inner">
              <h5>Sample</h5>
              <p class="subtitle">Sample</p>
              <!--<div class="avatar"><img src="img/team/1.jpg" alt="" class="img-responsive img-circle" /></div>-->
            </div>
          </div>
        </div>
      </div>
  <?php }
} ?>
    </div>
</div>
</section>
<!-- /Section: about -->

<?php
$contenu = ob_get_clean();
require "gabarit.php";
?>
