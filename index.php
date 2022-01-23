<?php
session_start();
require_once 'init/functions.php';
// lecture des notifications
if (isset($_SESSION['successMessage'])) {
  $successMessage = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}
// lecture des notifications
if (isset($_SESSION['errorMessage'])) {
  $errorMessage = $_SESSION['errorMessage'];
  unset($_SESSION['errorMessage']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="Clickncollect.">
  <!--<link rel="shortcut icon" href="../assets/img/favicon.ico">
  	<link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet" /> -->
  	<link rel="stylesheet" href="assets/libraries/bootstrap-4.6.0-dist/css/bootstrap.min.css" />
  	<!-- <link rel="stylesheet" href="assets/libraries/bootswatch/slate/bootstrap.min.css" /> -->
  	<link rel="stylesheet" href="assets/css/style.css" />
  	<script type="text/javascript" src="assets/js/tarteaucitron.js-1.3/tarteaucitron.js"></script>
  	<script type="text/javascript">
  		tarteaucitron.init({
  			"privacyUrl": "", /* Privacy policy url */

  			"hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
  			"cookieName": "tarteaucitron", /* Cookie name */

  			"orientation": "bottom", /* Banner position (top - bottom) */
  			"showAlertSmall": true, /* Show the small banner on bottom right */
  			"cookieslist": true, /* Show the cookie list */

  			"adblocker": false, /* Show a Warning if an adblocker is detected */
  			"AcceptAllCta": true, /* Show the accept all button when highPrivacy on */
  			"highPrivacy": true, /* Disable auto consent */
  			"handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

  			"removeCredit": false, /* Remove credit link */
  			"moreInfoLink": true, /* Show more info link */
  			"useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */

      //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

      "readmoreLink": "/cookiespolicy" /* Change the default readmore link */
    });
  </script>
  <title>Document</title>
</head>
<body class="bodyIndex">

	<nav class="navbar navbar-expand-lg naColor mb-2 sticky-top">
    <div class="logoDiv pb-2">
    <a class="navbar-brand p-2 LogoName" href="index.php">
    <img src="assets/img/CCLogo.png" class="d-inline-block align-top" height="30" alt="logo"> 
    Épicerie Lullie
  </a>
  </div>
  <div class="collapse navbar-collapse justify-content-end">
  <ul class="navbar-nav">
    <?php

      /********************************************************************
      * NAVBAR CLIENT 
      ********************************************************************/

      if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 1984){
        ?>

        <li class="nav-item active">
          <a class="nav-link" href="views/catalogue.php">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="views/cart.php">Panier</a>
        </li>

        <li>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <img src="assets/img/loginLogo.png" height="30" alt="log pict">
              Mon Compte
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="views/userProfile.php">Mon profil</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="views/userLogout.php">Déconnection</a>
            </div>
          </div>
        </li>


        <?php
      }

      /********************************************************************
      * NAVBAR VENDEUR 
      ********************************************************************/

      elseif (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 1983){
        ?>

        <li class="nav-item active">
          <a class="nav-link" href="views/catalogue.php">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reception des commandes</a>
        </li>

        <li>
         <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            
            Gestion des produits
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="views/adminItemList.php">Liste des produits</a>
            <a class="dropdown-item" href="views/itemCreate.php">Ajouter un produit</a>
          </div>
        </li>

        <li>
         <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="assets/img/loginLogo.png" height="30" alt="log pict">
            Mon Compte
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="views/userProfile.php">Mon profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="views/userLogout.php">Déconnection</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="views/cart.php">Panier</a>
      </li>
      <?php
    }

      /********************************************************************
      * NAVBAR ADMIN 
      ********************************************************************/

      elseif (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 1982){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="views/adminUserList.php">Gestion des clients</a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="views/catalogue.php">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reception des commandes</a>
        </li>
        <li>
         <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            
            Gestion des produits
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="views/adminItemList.php">Liste des produits</a>
            <a class="dropdown-item" href="views/itemCreate.php">Ajouter un produit</a>
          </div>
        </li>

        <li>
         <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="assets/img/loginLogo.png" height="30" alt="log pict">
            Mon Compte
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="views/userProfile.php">Mon profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="views/userLogout.php">Déconnection</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="views/cart.php">Panier</a>
      </li>

      <?php 

      /********************************************************************
      * NAVBAR VISITEUR 
      ********************************************************************/

    } else {  ?>
      <li class="nav-item active">
        <a class="nav-link" href="views/catalogue.php">Catalogue</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="views/userConnexion.php">S'identifier</a>
      </li>
    <?php } ?>
  </ul>
  </div>
</nav>
<h1 class="pt-4"><img src="assets/img/Lullie.png" alt="" class="img-fluid"></h1>
<div class="container-fluid">
  <div>
    <!-- LECTURE DES NOTIFICATIONS  -->
   <?= isset($successMessage) ? '<div class="successMes rounded-pill p-2">'.$successMessage.'</div>' : '' ?>
   <?= isset($errorMessage) ? '<div class="errorMes rounded-pill p-2">'.$errorMessage.'</div>' : '' ?>
 </div>
 <div class="row justify-content-md-center">
  <!--BANNIERE PRESENTATION-->
  <div class="col-12">
    <img class="w-100 img-fluid" src="assets/img/accueil_banniere.jpg" alt="Bannière d'accueil">
  </div>
  <!--EXPLICATION CLICKNCOLLECT-->
  <div class="col-12 text-center">
    <img class="w-100 img-fluid" src="assets/img/banClicknCo.png" alt="Bannière click&collect">
  </div>

<!--DEUX MODULES RAYONS-->

 <!--MODULE 1-->
 <div class="col-5 mr-5 my-5">
   <!--CARROUSSEL PROMO ?-->
   <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselCaptions" data-slide-to="1"></li>
      <li data-target="#carouselCaptions" data-slide-to="2"></li>
      <li data-target="#carouselCaptions" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner rounded">
      <div class="carousel-item active">
       <a href="#" target="_blank"><img src="assets/img/imageF&L.jpg" class="w-100 img-fluid" alt="Fruits et légumes"></a>
       <div class="carousel-caption d-none d-md-block">
        <h5>Promotions au rayon primeur</h5>
      </div>
    </div>
    <div class="carousel-item">
     <a href="#" target="_blank"><img src="assets/img/bread.jpg" class="w-100 img-fluid" alt="Boulangerie"></a>
     <div class="carousel-caption d-none d-md-block">
      <h5 class="slide2">Promotions au rayon boulangerie</h5>
    </div>
  </div>
  <div class="carousel-item">
   <a href="#" target="_blank"> <img src="assets/img/pork.jpg" class="w-100 img-fluid" alt="Viande"></a>
   <div class="carousel-caption d-none d-md-block">
    <h5 class="slide2">Promotion au rayon boucherie</h5>
  </div>
</div>
<div class="carousel-item">
 <a href="#" target="_blank"> <img src="assets/img/sale.jpg" class="w-100 img-fluid" alt="Soldes"></a>
 <div class="carousel-caption d-none d-md-block">
  <h5>Soldes</h5>
</div>
</div>
</div>
<a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
</div>
</div> <!-- Fin div carousel ?-->







<!--MODULE 2-->
<div class="card-group col-5 ml-5 my-5">
  <div class="row">
   <!--RAYONS-->
   <div class="card border-white col-6">
     <img class="img-fluid" src="assets/img/coffee.jpg" alt="café">
   </div>
   <div class="card border-white col-6">
     <img class="img-fluid" src="assets/img/yogurt.jpg" alt="yaourt">
   </div>
   <div class="card border-white col-6">
     <img class="img-fluid" src="assets/img/jam.jpg" alt="conserves">
   </div>
   <div class="card border-white col-6">
     <img class="img-fluid" src="assets/img/shampoo.jpg" alt="shampooing">
   </div>
 </div>
</div>


<div class="fantom py-5">
 
</div>

</div><!--Fin div ROW ?-->
</div> <!--Fin div Container ?-->

<!-- FOOTER   -->
<footer>
  <div class="row footerRow">
    <div class="col-12 col-lg-4 pl-5 pt-5">
      <h4>A propos</h4>
      <p class="text-justify">
        Ceci est un projet réalisé en binome. Ce site de click & collect est fictif, vous pouvez vous inscrire, simuler un achat avec un panier...
        Toute reproduction est interdite.
      </p>
      <p>
        Aucune donnée recueillie n'est transmise à de tierces personnes physiques ou morales dans un but commercial.
      </p>
      <h4>Auteurs : </h4>
      <p>Ludovic Morin</p>
      <p>Aurélie Lebrun</p>
      <p>Développeur web</p>
      <p>2021</p>
    </div>
    <div class="col-12 col-lg-4 pt-5 pl-5 border-left border-white">

      <h4>Crédits des images et fonds utilisés sur le site</h4>
      <p>
        <a href="https://pixabay.com/fr/">Pixabay</a>
      </p>
      <p>
        Image par <a href="https://pixabay.com/fr/users/tibine-238708/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=399286">Sabine Schulte</a>
      </p>
      <p>
        Image par <a href="https://pixabay.com/fr/users/christoph-47781/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=171653">Christoph</a>
      <p>
        Image par <a href="https://pixabay.com/fr/users/jarmoluk-143740/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=428094">Michal Jarmoluk</a>
      </p>
      <p>
        Image par <a href="https://pixabay.com/fr/users/bijutoha-127394/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1860642">Biju Toha</a>
      </p>
      <p>
       Image par <a href="https://pixabay.com/fr/users/ponce_photography-2473530/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1442034">Aline Ponce</a>
      </p>
      <p>
        Image par <a href="https://pixabay.com/fr/users/publicdomainpictures-14/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=69429">PublicDomainPictures</a>
      </p>
      <p>
         de <a href="https://pixabay.com/fr/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1442034">Pixabay</a>
      </p>
    </div>
    <div class="col-12 col-lg-4 pt-5 border-left border-white">
      <h4 class="mb-3">NOVEI FORMATION</h4>
      <a href="https://lamanu.fr/" target="_blank"><img src="../assets/img/logo_La_Manu_formation.png" alt="logo la Manu" class="mx-auto d-block w-50"/></a>
    </div>
  </div>
</footer>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.elevateZoom-3.0.8.min.js"></script>
<script src="assets/libraries/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  tarteaucitron.user.gtagUa = 'UA-XXXXXXXX-X';
tarteaucitron.user.gtagMore = function () { /* add here your optionnal gtag() */ };
(tarteaucitron.job = tarteaucitron.job || []).push('gtag');
</script>


</body>
</html>