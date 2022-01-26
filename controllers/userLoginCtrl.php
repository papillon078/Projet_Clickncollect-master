<?php
if (isAdmin() || isSeller() || isClient()) {
  header('location: ../index.php');
  exit();
} else {
  //Création de la regex pour le MAIL
  define('REGEX_EMAIL', '/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]{2,}\.[a-z]{2,4}$/');
  define('REGEX_MAIL', '/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]{2,}\.[a-z]{2,4}$/');
 //Création de la regex pour le NOM
  define('REGEX_LASTNAME', '/^[a-zA-ZÀ-ÿ\' -]+$/'); 
  //Création de la regex pour le PRENOM
  define('REGEX_FIRSTNAME', '/^[a-zA-ZÀ-ÿ -]+$/');
//Création de la regex pour le NUMERO
  define('REGEX_NUMBER', '/^\d+/');
//Création de la regex pour la DATE DE NAISSANCE
  define('REGEX_BIRTHDATE', '/^(19|20)[0-9]{2}-[0-9]{2}-[0-9]{2}$/');
//Création de la regex pour le NUMERO DE TELEPHONE
  define('REGEX_PHONE', '/^(0|\+33)[1-9]([-\. ]?[0-9]{2}){4}$/');
//Création de la regex pour l ADRESSE
  define('REGEX_ADRESS', '/^[0-9a-zA-ZÀ-ÿ\' -]+$/');
//Création de la regex pour le CODE POSTAL
  define('REGEX_POSTALCODE', '/^[0-9]{5}$/');
//Création de la regex pour la VILLE
  define('REGEX_CITY', '/^[a-zA-ZÀ-ÿ\' -]+$/');
// Création de la regex pour le mot de passe
  define('REGEX_PASSWORD', '/^.[\S]{7,}$/' );


  if (isset($_POST['loginSubmit'])) {
  // création d'une instance de classe usager
    $user = new User();
  // récupération des données du formulaire
  // Affectation de chaque champ du formulaire à l'ATTRIBUT auquel il est associé
    $user->email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
  //------------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP EMAIL
  //------------------------------------------------------------------------
    if (empty($user->email)) {
      $user->formErrors['email'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_EMAIL, $user->email)) {
      $user->formErrors['email'] = 'Ce champ n\'est pas valide';
    }
  //--------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP MOT DE PASSE
  //--------------------------------------------------------------------
    if (empty($password)) {
      $user->formErrors['password'] = 'Ce champ est vide';
    }
  // vérification que tous les champs sont prêts à être envoyés
    if (empty($user->formErrors)) {
      $userProfile = $user->getUserPassword();
      if (isset($userProfile->password) && password_verify($password, $userProfile->password) && $userProfile) {
        $cart = new Order();
        $cart->id_ll7882_users = $userProfile->id;
        if ($cart->hasUniqueCart()) {
        $cart->cartCreate();
        }
        $_SESSION['user_role'] = $userProfile->id_ll7882_roles;
        $_SESSION['user_id'] = $userProfile->id;
        $_SESSION['user_email'] = $userProfile->email;
        $_SESSION['user_lastname'] = $userProfile->lastname;
        $_SESSION['user_firstname'] = $userProfile->firstname;
        $_SESSION['user_cart_id'] = $cart->getId()->id;
        $_SESSION['successMessage'] = 'Vous vous êtes connecté(e) avec succès';

        header('Location: ../index.php');
        exit();
      } else {
        $user->formErrors['password'] = 'Les identifiants sont érronés';
        $user->formErrors['email'] = 'Les identifiants sont érronés';
      }
    }
  }
//------------------------------------------------------------------------------
//     RÉCUPÉRATIONS ET VALIDATIONS DES DONNÉES DU FORMULAIRE D'INSCRIPTION
//------------------------------------------------------------------------------
  if (isset($_POST['registerSubmit'])) {
  // création d'une instance de classe usager
    $user = new User();
    // création du n° de client
    $formu = time();
    $code = str_split($formu,3);
    $clientCode = $code[2]*82; 
  // récupération des données du formulaire
  // Affectation de chaque champ du formulaire à l'ATTRIBUT auquel il est associé
    $user->email = isset($_POST['email']) ? strtolower(htmlspecialchars(trim($_POST['email']))) : '';
    $user->password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    $passwordConfirm = isset($_POST['passwordConfirm']) ? strip_tags(trim($_POST['passwordConfirm'])) : '';
    $user->clientNumber = $clientCode;


  //------------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP EMAIL
  //------------------------------------------------------------------------
    if (empty($user->email)) {
      $user->formErrors['email'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_MAIL, $user->email)) {
      $user->formErrors['email'] = 'Ce champ n\'est pas valide';
    } elseif (strlen($user->email) < 5 || strlen($user->email) > 100) {
      $user->formErrors['email'] = 'L\'adresse mail  doit comporter entre 5 et 100 caractères';
    } elseif (!$user->hasUniqueMail()) {
      $user->formErrors['email'] = 'Cette adresse mail existe déjà, verifiez l\'adresse mail';
    }
  //--------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP MOT DE PASSE
  //--------------------------------------------------------------------
    if (empty($user->password)) {
      $user->formErrors['password'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_PASSWORD, $user->password)) {
      $user->formErrors['password'] = 'Ce mot de passe n\'est pas valide';
    } elseif (strlen($user->password) < 8 || strlen($user->password) > 40) {
      $user->formErrors['password'] = 'Le mot de passe doit comporter entre 8 et 40 caractères';
    } elseif ($user->password != $passwordConfirm){
     $user->formErrors['passwordConfirm'] = 'La confirmation ne correspond pas au mot de passe';
   }


  // vérification que tous les champs sont prêts à être envoyés
   if (empty($user->formErrors)) {
    // hashage du mot de passe
    $user->password = password_hash($user->password, PASSWORD_DEFAULT);
    // insertion des données des usagers
    $success = $user->addUser();
    // édition du message de notification
    // $success == TRUE en cas de succès sinon FALSE
    if ($success) {
      $_SESSION['email'] = strtolower(htmlspecialchars(trim($_POST['email'])));
      $_SESSION['successMessage'] = 'Votre commande a bien été validée, vous pouvez la consulter ci-dessous';
      header('Location: userRegister.php');
      exit();

    }
  }
}
// lecture des notifications
if (isset($_SESSION['successMessage'])) {
  $successMessage = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}

}
?>
