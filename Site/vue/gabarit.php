<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$titre;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet"/>
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="color/default.css" rel="stylesheet">

    <!-- =======================================================
      Theme Name: Squadfree
      Theme URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
      Author: BootstrapMade
      Author URL: https://bootstrapmade.com
    ======================================================= -->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<!-- Preloader -->
<div id="preloader">
    <div id="load"></div>
</div>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.html">
                <h1>GalaxSat</h1>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">

                <?php if ((@$_GET['action'] == "vue_accueil") || (!isset($_GET['action']))) : ?>
                    <li class="active"><a href="index.php">Accueil</a></li>
                <?php else : ?>
                    <li><a href="index.php">Accueil</a></li>
                <?php endif; ?>

                <li><a href="#about">About</a></li>

                <li><a href="#service">Service</a></li>

                <?php if (@$_GET['action'] == "vue_contact") : ?>
                    <li class="active"><a href="index.php?action=vue_contact">Contact</a></li>
                <?php else : ?>
                    <li><a href="index.php?action=vue_contact">Contact</a></li>
                <?php endif; ?>

                <li <?php if (@$_GET['action'] == "vue_login") echo 'class="active"'; ?>>
                    <a href="index.php?action=vue_login">
                        <?php if (isset($_SESSION['login'])) ://si la session login est active, affiche "logout" dans le menu  ?>
                        Logout</a>
                    <?php else : ?>
                        Login</a>
                    <?php endif ?>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Example menu</a></li>
                        <li><a href="#">Example menu</a></li>
                        <li><a href="#">Example menu</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Section: intro -->
<section id="intro" class="intro">

    <div class="slogan">
        <h2><span class="text_color"><?=@$intitule;?></span></h2>
        <h4><i><?=@$SousMenu;?></i></h4>
    </div>
    <div class="page-scroll">
        <a href="#service" class="btn btn-circle">
            <i class="fa fa-angle-double-down animated"></i>
        </a>
    </div>
</section>
<!-- /Section: intro -->

<?= $contenu; ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="wow shake" data-wow-delay="0.4s">
                    <div class="page-scroll marginbot-30">
                        <a href="#intro" id="totop" class="btn btn-circle">
                            <i class="fa fa-angle-double-up animated"></i>
                        </a>
                    </div>
                </div>
                <p>Template original  par &copy;SquadFREE. All rights reserved.</p>
                <div class="credits">
                    <!--
                      All the links in the footer should remain intact.
                      You can delete the links only if you purchased the pro version.
                      Licensing information: https://bootstrapmade.com/license/
                      Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Squadfree
                    -->
                    <a href="https://bootstrapmade.com/bootstrap-one-page-templates/">Bootstrap One Page Templates</a>
                    by BootstrapMade
                    <p>
                        <?=@$Credits;?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Core JavaScript Files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/wow.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<script src="contactform/contactform.js"></script>

</body>

</html>
