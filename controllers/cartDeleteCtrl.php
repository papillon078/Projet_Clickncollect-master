<?php
if (!isAdmin() && !isSeller() && !isClient()) {
  header('location: ../index.php');
  exit();
} else {
  if ((isset($_GET['orderId']) && $_GET['orderId'] > 0) && (isset($_GET['itemId']) && $_GET['itemId'] > 0) ) {

  	/*<a href="cartDelete.php?orderId=<?= $_SESSION['user_cart_id'] ?>&itemId=<?= $item->itemId ?>">*/

  // création d'une instance de classe commandLine
   $commandLine = new CommandLine();
  //renseignement de l'id de la ligne de commande à effacer
    $commandLine->id_ll7882_orders = htmlspecialchars($_GET['orderId']);
    $commandLine->id_ll7882_items = htmlspecialchars($_GET['itemId']);
  // suppression du produit dans le panier
    $success = $commandLine->deleteCommandLine();
  // création d'un message de confirmation, si la requête a bien réussie
  // suivie de la déconnexion du compte de l'usager
    if ($success) {
      $_SESSION['successMessage'] = 'Le produit a bien été supprimé du panier';
      header('location: ../views/cart.php');
      exit();
    }
  } else {
    header('location: ../index.php');
    exit();
  }
}
?>
