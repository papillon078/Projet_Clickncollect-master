<nav class="navbar navbar-expand-sm naColor mb-2 sticky-top">
   <div class="logoDiv">
  <a class="navbar-brand p-2 LogoName" href="../index.php">
    <img src="../assets/img/CCLogo.png" class="d-inline-block align-top px-2" alt="Logo">
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
          <a class="nav-link" href="catalogue.php">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Panier</a>
        </li>

        <li>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <img src="../assets/img/loginLogo.png" height="30" alt="log pict">
              Mon Compte
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="userProfile.php">Mon profil</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="userLogout.php">Déconnection</a>
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
          <a class="nav-link" href="catalogue.php">Catalogue</a>
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
            <a class="dropdown-item" href="adminItemListe.php">Liste des produits</a>
            <a class="dropdown-item" href="itemCreate.php">Ajouter un produit</a>
          </div>
        </li>

        <li>
         <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="../assets/img/loginLogo.png" height="30" alt="log pict">
            Mon Compte
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="userProfile.php">Mon profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="userLogout.php">Déconnection</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="cart.php">Panier</a>
      </li>
      <?php
    }

      /********************************************************************
      * NAVBAR ADMIN 
      ********************************************************************/

      elseif (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 1982){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="adminUserList.php">Gestion des clients</a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="catalogue.php">Catalogue</a>
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
            <a class="dropdown-item" href="adminItemList.php">Liste des produits</a>
            <a class="dropdown-item" href="itemCreate.php">Ajouter un produit</a>
          </div>
        </li>

        <li>
         <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="../assets/img/loginLogo.png" height="30" alt="log pict">
            Mon Compte
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="userProfile.php">Mon profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="userLogout.php">Déconnection</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="cart.php">Panier</a>
      </li>

      <?php 

      /********************************************************************
      * NAVBAR VISITEUR 
      ********************************************************************/

    } else {  ?>
      <li class="nav-item active">
        <a class="nav-link" href="catalogue.php">Catalogue</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="userConnexion.php">S'identifier</a>
      </li>
    <?php } ?>
  </ul>
</div>
</nav>