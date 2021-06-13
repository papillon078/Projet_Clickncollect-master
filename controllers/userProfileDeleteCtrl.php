<?php
if (!isAdmin() && !isClient() && !isSeller()) {
  header('location: ../index.php');
  exit();
} else {
  if (isset($_GET['id']) && $_GET['id'] > 0) {
  // création d'une instance de classe User
    $user = new User();
  //renseignement de l'id de l'usager à effacer
    $user->id = htmlspecialchars($_GET['id']);
  // suppression de l'usager dans la BDD
    $success = $user->deleteUser();
  // création d'un message de confirmation, si la requête a bien réussie
  // suivie de la déconnexion du compte de l'usager
    if ($success) {
      $_SESSION['successMessage'] = 'Le profil a bien été supprimé';
      if ($_SESSION['user_role'] > 1982) {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_email']);
        header('location: ../index.php');
        exit();
      } else {
        header('location: adminUserList.php');
        exit();
      }
    }
  } else {
    header('location: ../index.php');
    exit();
  }
}
?>
