<?php
if (!isAdmin() && !isSeller()){
  header('location: ../index.php');
  exit();
} else {
// création d'une instance de classe item
  $item = new Item();
//redirection vers la page 1 des articles
  if (!isset($_GET['page']) || isset($_POST['fullList']) || !preg_match('/[0-9]+$/', $_GET['page'])) {
    $_SESSION['search'] = '';
    header('Location: ../views/adminItemList.php?page=1');
    exit();
  }
//recuperation et securisation du numero de la page en cours
  if (isset($_GET['page']) && $_GET['page']>0){
    $currentPageNumber = htmlspecialchars($_GET['page']);
  }
/*******************************************************************************
* affichage de la liste complète des produits SI on ne fait pas de recherche
******************************************************************************/
if ((!isset($_POST['submit']) || empty($_POST['keywords']) || isset($_POST['fullList'])) && (empty($_SESSION['search']) && !isset($_POST['categorySubmit']))){
  // récupération de la liste des articles
  $lenght = ($_GET['page']-1)*10;
  // appel de la méthode qui va executer la requête
  $itemList = $item->getItemShortList($lenght);
  $itemNumber = $item->getItemNumber();
  $totalNumber = $itemNumber/10+1;
  /*******************************************************************************
  *  si une recherche est lancée
  ******************************************************************************/
} elseif (isset($_POST['submit']) && !empty($_POST['keywords'])) {
  // écriture de la recherche dans un tableau de session
  // pour transmettre la recherche aux pages suivantes
  $_SESSION['search'] = htmlspecialchars($_POST['keywords']);
  // redirection vers la page1 de la recherche
  header('Location: ../views/adminItemList.php?page=1');
  exit();
  /*******************************************************************************
  *  pour parcourir les pages d'une recherche mise en mémoire
  ******************************************************************************/
}
elseif (!empty ($_SESSION['search'])) {
  // récupération des données de recherche
  $search = $_SESSION['search'];
  // conversion du numéro de la page pour obtenir le OFFSET pour la requête
  $lenght = ($_GET['page']-1)*10;
  // récupération de la liste des produits
  $itemList = $item->getSearchList($search, $lenght);
  $itemNumber = $item->getSearchResultNumber($search);
  $totalNumber = $itemNumber/10+1;
}

/******************************************************************************
*             pour parcourir les pages d'un rayon du magasin    
**************************************************************************** */ 
elseif (isset($_POST['categoryName'])) {
  $lenght = ($_GET['page']-1)*10;
  $cat = $_POST['categoryName'];
  $item->categories =htmlspecialchars($_POST['categoryName']);
  $itemList = $item->getItemListByCategories($lenght);
  $itemNumber = $item->getCategoryResultNumber($cat);
  $totalNumber = $itemNumber / 10 + 1;
}

/******************************************************************************
*                      mise à jour des stocks produits   
**************************************************************************** */ 

if (isset($_POST['stockSubmit'])) {
   
   $item->id = isset($_POST['itemId']) ? htmlspecialchars(intval($_POST['itemId'])) : '';
  $item->stock = isset($_POST['stock']) ? htmlspecialchars(intval($_POST['itemStock'])) + htmlspecialchars(intval($_POST['stock'])) : '';

   // validation de l'id du produit
    if (empty($item->id)) {
        $item->formErrors['id'] = 'Erreur veuillez recharger la page';
    } elseif ($item->id < 1 || $item->id > 10000) {
        $item->formErrors['id'] = 'Erreur veuillez recharger la page';
    }

    // validation du nouveau stock d'un produit
    if (empty($item->stock)) {
        $item->formErrors['stock'] = 'Veuillez entrer le stock du produit';
    } elseif ($item->stock < 1 || $item->stock > 10000) {
        $item->formErrors['stock'] = 'Veuillez entrer le stock réel';
    }

// vérification que tous les champs sont prêts à etre envoyés
    if (empty($item->formErrors)) {
// insertion des données du produit
        $success = $item->stockUpdate();
        if ($success) {
            $_SESSION['successMessage'] = 'le stock du produit a bien été mis à jour';
            header('location: adminItemList.php');
            exit();
        }
    }
}


/*******************************************************************************
*  Reception des messages de succès de création ou modification des produits
******************************************************************************/
if (isset($_SESSION['successMessage'])) {
  $message = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}
}
?>
