<?php
if (!isAdmin()){
  header('location: ../index.php');
  exit();
} else {
// création d'une instance de classe user
  $user = new User();
//redirection vers la page 1 des usagers
  if (!isset($_GET['page']) || isset($_POST['fullList']) || !preg_match('/[0-9]+$/', $_GET['page'])) {
    $_SESSION['search'] = '';
    header('Location: ../views/adminUserList.php?page=1');
    exit();
  }
//recuperation et securisation du numero de la page en cours
  if (isset($_GET['page']) && $_GET['page']>0){
    $currentPageNumber = htmlspecialchars($_GET['page']);
  }
/*******************************************************************************
* affichage de la liste complète des usagers SI on ne fait pas de recherche
******************************************************************************/
if ((!isset($_POST['submit']) || empty($_POST['keywords']) || isset($_POST['fullList'])) && empty($_SESSION['search'])) {
  // récupération de la liste des usagers
  $lenght = ($_GET['page']-1)*10;
  // appel de la méthode qui va executer la requête
  $userList = $user->getUserShortList($lenght);
  $userNumber = $user->getUserNumber();
  $totalNumber = $userNumber/10+1;
  /*******************************************************************************
  *  si une recherche est lancée
  ******************************************************************************/
} elseif (isset($_POST['submit']) && !empty($_POST['keywords'])) {
  // écriture de la recherche dans un tableau de session
  // pour transmettre la recherche aux pages suivantes
  $_SESSION['search'] = htmlspecialchars($_POST['keywords']);
  // redirection vers la page1 de la recherche
  header('Location: ../views/adminUserList.php?page=1');
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
  // récupération de la liste des usagers
  $userList = $user->getSearchList($search, $lenght);
  $userNumber = $user->getSearchResultNumber($search);
  $totalNumber = $userNumber/10+1;
}
/*******************************************************************************
*  Reception des messages de succès de création ou modification de l'usager
******************************************************************************/
if (isset($_SESSION['successMessage'])) {
  $message = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}
}
?>
