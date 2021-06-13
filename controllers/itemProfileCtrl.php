<?php
// condition pour s'assurer qu'on a un id de produit et qu'il est positif 
if (isset($_GET['id']) && $_GET['id'] > 0) {
  // création d'une instance de classe item
  $item= new Item();
  // dédinition de l'id de l'item à rechercher
  $item->id = htmlspecialchars(intval($_GET['id']));
  // récupération de l'item
  $itemProfile = $item->getItemProfile();

  $item->menus = $itemProfile->menuId;
  $menuItems = $item->getItemListByMenu();

} else {
  $_SESSION['successMessage'] = 'Cet article est introuvable, veuillez réessayer';
  header('location: ../index.php');
  exit();
}

//vérification que les requêtes se sont bien passées
if (!is_object($itemProfile)) {
  $_SESSION['successMessage'] = 'Une erreur est survenue, veuillez réessayer';
  header('Location: ../index.php');
  exit();
}

//envoi a la session du panier
if (isset($_POST['addCart'])){
  $commandLine = new CommandLine();
  $commandLineExists = $commandLine->FindByOrderAndItem($_SESSION['user_cart_id'], $item->id);
  $commandLine->id_ll7882_orders = $_SESSION['user_cart_id'];
  $commandLine->id_ll7882_items = $item->id;

  if($commandLineExists){
    $oldCommandLine = new CommandLine();
    $oldCommandLine->getCommandLine($_SESSION['user_cart_id'], $item->id);
    $commandLine->quantity = $oldCommandLine->quantity + $_POST['itemNumber'];
    $commandLine->total_HT = $commandLine->quantity * $itemProfile->taxe_free_price;
    $commandLine->total_TTC = $commandLine->total_HT * $itemProfile->taxeRate;
    $commandLine->updateQuantity();
  }else{
    $commandLine->quantity = $_POST['itemNumber'];
    $commandLine->total_HT = $commandLine->quantity * $itemProfile->taxe_free_price;
    $commandLine->total_TTC = $commandLine->total_HT * $itemProfile->taxeRate;
    $commandLine->addCommandline();
  }

  $_SESSION['successMessage'] = 'Votre article a été ajouté au panier';
  header('Location: itemProfile.php?id='.$item->id.'.php');
  exit();
  
}

if (isset($_SESSION['successMessage'])) {
  $message = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}
?>


