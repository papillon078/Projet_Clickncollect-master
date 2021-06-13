<?php

// création d'une instance de classe item
$item = new Item();

// récupération de la liste des catégories à jour
$categoriesList = $item->getCategoriesList();

//redirection vers la page 1 des articles
if (!isset($_GET['page']) || isset($_POST['fullList']) || !preg_match('/[0-9]+$/', $_GET['page'])) {
  $_SESSION['search'] = '';
  header('Location: ../views/catalogue.php?page=1');
  exit();
}

//recuperation et securisation du numero de la page en cours
if (isset($_GET['page']) && $_GET['page']>0){
  $currentPageNumber = htmlspecialchars($_GET['page']);
}

/*******************************************************************************
* affichage de la liste complète des produits SI on ne fait pas de recherche
******************************************************************************/

if ((!isset($_POST['submit']) || empty($_POST['keywords']) || isset($_POST['fullList'])) && (empty($_SESSION['search']) && !isset($_GET['category']))){
  // récupération de la liste des articles
  $lenght = ($_GET['page']-1)*10;
  // appel de la méthode qui va executer la requête
  $itemList = $item->getItemShortList($lenght);
  $itemNumber = $item->getItemNumber();
  $totalNumber = $itemNumber/10+1;
}

  /*******************************************************************************
  *  si une recherche est lancée
  ******************************************************************************/

  elseif (isset($_POST['submit']) && !empty($_POST['keywords'])) {
  // écriture de la recherche dans un tableau de session
  // pour transmettre la recherche aux pages suivantes
    $_SESSION['search'] = htmlspecialchars($_POST['keywords']);
  // redirection vers la page1 de la recherche
    header('Location: ../views/catalogue.php?page=1');
    exit();
  }

  /*******************************************************************************
  *  pour parcourir les pages d'une recherche mise en mémoire
  ******************************************************************************/


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

elseif (isset($_GET['category'])) {
  $lenght = ($_GET['page']-1)*10;
  $cat = $_GET['category'];
  $item->categories =htmlspecialchars($_GET['category']);
  $itemList = $item->getItemListByCategories($lenght);
  $itemNumber = $item->getCategoryResultNumber($cat);
  $totalNumber = $itemNumber / 10 + 1;
}


/*******************************************************************************
*  Reception des messages de succès de création ou modification des produits
******************************************************************************/
if (isset($_SESSION['successMessage'])) {
  $message = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}

?>
