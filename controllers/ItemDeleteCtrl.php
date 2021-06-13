<?php
if (!isAdmin() && !isSeller()) {
  header('location: ../index.php');
  exit();
} else {
  if (isset($_GET['id']) && $_GET['id'] > 0) {
  // création d'une instance de classe Item
    $item = new Item();
  //renseignement de l'id de l'usager à effacer
    $item->id = htmlspecialchars($_GET['id']);
  // suppression de l'usager dans la BDD
    $success = $item->deleteItem();
  // création d'un message de confirmation, si la requête a bien réussie
  // suivie de la déconnexion du compte de l'usager
    if ($success) {
      $_SESSION['successMessage'] = 'Le produit a bien été supprimé du catalogue';
      header('location: adminItemList.php?page=1');
      exit();
    }
  } else {
    header('location: ../index.php');
    exit();
  }
}
?>
