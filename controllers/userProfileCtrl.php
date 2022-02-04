<?php
if (!isAdmin() && !isClient()) {
  header('location: ../index.php');
  exit();
} else {
  if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
  /// création d'une instance de classe user et d'une classe article
    $user = new User();
    //verification si c'est le membre ou l'admin qui se connecte au compte
    if ($_SESSION['user_role'] == 1984) {

  // dédinition de l'id de l'usager à rechercher
      $user->id = htmlspecialchars(intval($_SESSION['user_id']));
    } elseif ($_SESSION['user_role'] == 1982 && isset($_GET['id']) && $_GET['id'] > 0) {
        // dédinition de l'id de l'usager à rechercher
      $user->id = htmlspecialchars(intval($_GET['id']));

    } elseif ($_SESSION['user_role'] == 1982) {
        // dédinition de l'id de l'usager à rechercher
      $user->id = htmlspecialchars(intval($_SESSION['user_id']));
    }
  // récupération du profil usager et de sa commande
    $userProfile = $user->getUserProfile();
    $order = new Order();
    $order->id = $_SESSION['user_id'];
    $userOrder = $order->getOrder();
    if(!is_object($userProfile)){
      header('Location: userProfileUpdate.php');
      exit();
    }
  } else {
    header('Location: ../index.php');
    exit();
  }
// lecture des notifications
  if (isset($_SESSION['successMessage'])) {
    $message = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
  }
}
?>
