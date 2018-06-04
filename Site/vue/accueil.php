<?php
/**
 * User: Brian Rodrigues Fraga
 * Date: 24.05.2018
 */

// tampon de flux stocké en mémoire
ob_start();
$titre="GalaxSat - Accueil";
$intitule="Bienvenue sur GalaxSat";
$SousMenu="VOUS NOUS DONNEZ VOS IDÉES, NOUS VOUS DONNONS LES ÉTOILES";
$Credits="Icons made by Freepik from www.flaticon.com";
?>

<!-- Section: about -->
<section id="about" class="home-section text-center">
  <div class="heading-about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow bounceInDown" data-wow-delay="0.4s">
            <div class="section-heading">
              <h2>Nos produits</h2>
              <i class="fa fa-2x fa-angle-down"></i>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-50">
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
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
      <div class="col-md-3">
        <div class="wow bounceInUp" data-wow-delay="0.5s">
          <div class="team boxed-grey">
            <div class="inner">
              <h5>Sample</h5>
              <p class="subtitle">Sample</p>
                <!--<div class="avatar"><img src="img/team/2.jpg" alt="" class="img-responsive img-circle" /></div>-->

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow bounceInUp" data-wow-delay="0.8s">
            <div class="team boxed-grey">
              <div class="inner">
                <h5>Sample</h5>
                <p class="subtitle">Sample</p>
                <!--<div class="avatar"><img src="img/team/3.jpg" alt="" class="img-responsive img-circle" /></div>-->

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wow bounceInUp" data-wow-delay="1s">
            <div class="team boxed-grey">
              <div class="inner">
                <h5>Sample</h5>
                <p class="subtitle">Sample</p>
                <!--<div class="avatar"><img src="img/team/4.jpg" alt="" class="img-responsive img-circle" /></div>-->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Section: about -->


<!-- Section: services -->
<section id="service" class="home-section text-center bg-gray">

  <div class="heading-about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="wow bounceInDown" data-wow-delay="0.4s">
            <div class="section-heading">
              <h2>Nos services</h2>
              <i class="fa fa-2x fa-angle-down"></i>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-lg-offset-5">
        <hr class="marginbot-50">
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="wow fadeInLeft" data-wow-delay="0.2s">
          <div class="service-box">
            <div class="service-icon">
              <img class="icons" src="img/icons/service-icon-1.png" alt="" />
            </div>
            <div class="service-desc">
              <h5>ISS</h5>
              <p>Nous vous offrons la possibilité de faire lancer, à la main, votre satellite par des astronautes</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="wow fadeInUp" data-wow-delay="0.2s">
          <div class="service-box">
            <div class="service-icon">
              <img class="icons" src="img/icons/service-icon-2.png" alt="" />
            </div>
            <div class="service-desc">
              <h5>CubeSat</h5>
              <p>Nous vous assurons des satellites légers, fonctionnels et résistant. De nombreux tests en interne vous garantissent une qualité irréprochable de nos CubeSats</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="wow fadeInUp" data-wow-delay="0.2s">
          <div class="service-box">
            <div class="service-icon">
              <img class="icons" src="img/icons/service-icon-3.png" alt="" />
            </div>
            <div class="service-desc">
              <h5>Lanceur</h5>
                <p>Nous possédons des partenariats avec des entreprises de micro-lanceur tel que <a href="https://www.rocketlabusa.com/">RocketLab</a> et leur fusée "<i>electron</i>"</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="wow fadeInRight" data-wow-delay="0.2s">
          <div class="service-box">
            <div class="service-icon">
              <img class="icons" src="img/icons/service-icon-4.png" alt="" />
            </div>
            <div class="service-desc">
              <h5>Au delà de nos frontières</h5>
              <p>Nous pouvons également envoyer votre CubeSat par-delà l'orbite terrestre en le plaçant dans des missions de lanceurs lourds</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Section: services -->


<?php
  $contenu = ob_get_clean();
  require "gabarit.php";
  ?>
