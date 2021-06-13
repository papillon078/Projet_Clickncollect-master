<?php
if (!isAdmin() && !isSeller()) {
  header('location: ../index.php');
  exit();
} else {
// -----------------------------------------------------------------------------
//                              INITIALISATION
// -----------------------------------------------------------------------------
//Création de la regex pour le NOM 
  define('REGEX_NAME', '/^[0-9a-zA-ZÀ-ÿ\' -%+]+$/');
//Création de la regex pour la DESCRIPTION 
  define('REGEX_DESCRIPTION', '/^[0-9a-zA-ZÀ-ÿ\' -%+]+$/');
 //Création de la regex pour la TAILLE / DIMENSIONS
  define('REGEX_SIZE', '/^[0-9a-z ]+$/');
// -----------------------------------------------------------------------------
//                   RÉCUPÉRATION DE LA LISTE DES MENUS A JOUR
// -----------------------------------------------------------------------------
// création d'une instance de classe produit
  $item = new Item();
  $menuList = $item->getMenuList();

//------------------------------------------------------------------------------
//            RÉCUPÉRATIONS ET VALIDATIONS DES DONNÉES DU FORMULAIRE
//------------------------------------------------------------------------------
  if (isset($_POST['submit'])) {
//Récupération de la liste des categories (rayons) de produits à jour
    $item->categories = isset($_POST['categoryName']) ? htmlspecialchars(trim($_POST['categoryName'])) : '';
  $itemCategory = $item->getItemCategory();

  // DETERMINATION DE LA REFERENCE
    
    $code = str_split($itemCategory->name,3);
    $nextID = $item->getLastId() +1;
    $ref = sprintf("%'.05d", $nextID);
    

  // récupération des données du formulaire
    $item->reference = $code[0].'-'.$ref;
    $item->name = isset($_POST['itemName']) ? htmlspecialchars($_POST['itemName']) : '';
    $item->smallPicture = isset($_FILES['smallPicture']['name']) ? 
    htmlspecialchars(trim('../assets/productPictures/smallPictures/' . $_FILES['smallPicture']['name'])) : '';
    $item->largePicture = isset($_FILES['largePicture']['name']) ? 
    htmlspecialchars(trim('../assets/productPictures/largePictures/' . $_FILES['largePicture']['name'])) : '';
    $item->description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $item->size = isset($_POST['size']) ? htmlspecialchars($_POST['size']) : '';
    $item->weight = isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : '';
    $item->packagings = isset($_POST['packagingName']) ? htmlspecialchars(trim($_POST['packagingName'])) : '';
    $item->taxeFreePrice = isset($_POST['taxeFreePrice']) ? htmlspecialchars($_POST['taxeFreePrice']) : '';
    $item->menus = isset($_POST['menu']) ? htmlspecialchars(trim($_POST['menu'])) : '';
    $item->taxes = isset($_POST['rate']) ? htmlspecialchars(trim($_POST['rate'])) : '';

  //informations d'upload des fichiers
    $content_dirSP = '../assets/productPictures/smallPictures/';
    $tmp_smallPictures = $_FILES['smallPicture']['tmp_name'];
    $name_smallPictures = $_FILES['smallPicture']['name'];

    $content_dirLP = '../assets/productPictures/largePictures/';
    $tmp_largePictures = $_FILES['largePicture']['tmp_name'];
    $name_largePictures = $_FILES['largePicture']['name'];
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP CATEGORIE
  //----------------------------------------------------------------------
    
    if (!isset($item->categories) && empty($item->categories)) {
      $item->formErrors['categoryName'] = 'Ce champs est vide';
    } elseif ($item->categories < 1 || $item->categories > 14) {
      $item->formErrors['categoryName'] = 'Veuillez choisir une catégorie';
    }


  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP NOM DU PRODUIT
  //----------------------------------------------------------------------
    if (empty($item->name)) {
      $item->formErrors['itemName'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_NAME, $item->name)) {
      $item->formErrors['itemName'] = 'Ce champ n\'est pas valide';
    } elseif (strlen($item->name) < 2 || strlen($item->name) > 50) {
      $item->formErrors['itemName'] = 'Le nom doit comporter entre 2 et 50 caractères';
    }
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP IMAGE DU PRODUIT
  //----------------------------------------------------------------------
    if (empty($_FILES['smallPicture']['name'])) {
      $item->formErrors['smallPicture'] = 'veuillez choisir un fichier';
    } elseif (($_FILES['smallPicture']['type'] != 'image/jpeg') && ($_FILES['smallPicture']['type'] != 'image/png')) {
      $item->formErrors['smallPicture'] = 'veuillez choisir un fichier jpeg ou png';
    } elseif (!is_uploaded_file($tmp_smallPictures)) {
      $item->formErrors['smallPicture'] = 'Le fichier est introuvable';
    } elseif (!move_uploaded_file($tmp_smallPictures, $content_dirSP . $name_smallPictures)) {
      $item->formErrors['smallPicture'] = 'Impossible de copier le fichier dans le dossier de destination';
    }

    if (empty($_FILES['largePicture']['name'])) {
      $item->formErrors['largePicture'] = 'veuillez choisir un fichier';
    } elseif (($_FILES['largePicture']['type'] != 'image/jpeg') && ($_FILES['largePicture']['type'] != 'image/png')) {
      $item->formErrors['largePicture'] = 'veuillez choisir un fichier jpeg ou png';
    } elseif (!is_uploaded_file($tmp_largePictures)) {
      $item->formErrors['largePicture'] = 'Le fichier est introuvable';
    } elseif (!move_uploaded_file($tmp_largePictures, $content_dirLP . $name_largePictures)) {
      $item->formErrors['largePicture'] = 'Impossible de copier le fichier dans le dossier de destination';
    }
    
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP DESCRIPTION
  //----------------------------------------------------------------------
    if (empty($item->description)) {
      $item->formErrors['description'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_DESCRIPTION, $item->description)) {
      $item->formErrors['description'] = 'Ce champ n\'est pas valide';
    } elseif (strlen($item->description) < 5 || strlen($item->description) > 249) {
      $item->formErrors['description'] = 'La description de l\'article doit comporter entre 5 et 249 caractères';
    }

  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP TAILLE / DIMENSION
  //----------------------------------------------------------------------

    if (!empty($item->size) && !preg_match(REGEX_SIZE, $item->size)) {
      $item->formErrors['size'] = 'Ce champ n\'est pas valide';
    } elseif (!empty($item->size) && (strlen($item->size) < 2 || strlen($item->size) > 50)) {
      $item->formErrors['size'] = 'Les dimensions ou la taille de l\'article doit comporter entre 2 et 50 caractères';
    }

//----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP POIDS
  //----------------------------------------------------------------------
    if (!empty($item->weight) &&  strlen($item->weight) < 1) {
      $item->formErrors['weight'] = 'Ce champ n\'est pas valide';
    }


//----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP CONDITONNEMENT
  //----------------------------------------------------------------------
    
    if (!isset($item->packagings) && empty($item->packagings)) {
      $item->formErrors['packagingName'] = 'Ce champs est vide';
    } elseif ($item->packagings < 1 || $item->packagings > 6) {
      $item->formErrors['packagingName'] = 'Veuillez choisir un conditionnement';
    }

   //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP PRIX
  //----------------------------------------------------------------------
    if (empty($item->taxeFreePrice)) {
      $item->formErrors['taxeFreePrice'] = 'Ce champ est vide';
    } elseif (strlen($item->taxeFreePrice) < 1) {
      $item->formErrors['taxeFreePrice'] = 'Le prix de l\'article n\'est pas correct ';
    }

//----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP MENU
  //----------------------------------------------------------------------
    
    if (!isset($item->menus) && empty($item->menus)) {
      $item->formErrors['menu'] = 'Ce champs est vide';
    } elseif ($item->menus < 1 || $item->menus > 50) {
      $item->formErrors['menu'] = 'Veuillez choisir un menu valide';
    }

  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP TVA
  //----------------------------------------------------------------------
    
    if (!isset($item->taxes) && empty($item->taxes)) {
      $item->formErrors['rate'] = 'Ce champs est vide';
    } elseif ($item->taxes < 1 || $item->taxes > 4) {
      $item->formErrors['rate'] = 'Veuillez choisir un taux de TVA valide';
    }


  // vérification que tous les champs sont prêts à être envoyés
    if (empty($item->formErrors)) {
    // insertion des données de l'article
      $success = $item->addItem();
    // édition du message de notification
    // $success == TRUE en cas de succès sinon FALSE
      if ($success) {
        $_SESSION['successMessage'] = 'Le produit a été ajouté avec succès ';
        header('Location: ../index.php');
        exit();
      }
    }
  }
}
?>
