<?php
if (isAdmin() || isSeller() || isClient()) {
  header('location: ../index.php');
  exit();
} else {
// -----------------------------------------------------------------------------
//                              INITIALISATION
// -----------------------------------------------------------------------------
//Création de la regex pour le MAIL
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
//------------------------------------------------------------------------------
//            RÉCUPÉRATIONS ET VALIDATIONS DES DONNÉES DU FORMULAIRE
//------------------------------------------------------------------------------
  if (isset($_POST['submit'])) {
  // création d'une instance de classe usager
    $user = new User();
    // création du n° de client
    $formu = time();
    $code = str_split($formu,3);
    $clientCode = $code[2]*82; 
  // récupération des données du formulaire
  // Affectation de chaque champ du formulaire à l'ATTRIBUT auquel il est associé
    $user->email = isset($_POST['email']) ? strtolower(htmlspecialchars(trim($_POST['email']))) : '';
    $user->civility = isset($_POST['civility']) ? htmlspecialchars(trim($_POST['civility'])) : '';
    $user->lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
    $user->firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
    $user->birthDate = isset($_POST['birthDate']) ? htmlspecialchars($_POST['birthDate']) : '';
    $user->phoneNumber = isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : '';
    $user->password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    $passwordConfirm = isset($_POST['passwordConfirm']) ? strip_tags(trim($_POST['passwordConfirm'])) : '';
    $user->adressNumber = isset($_POST['adressNumber']) ? htmlspecialchars($_POST['adressNumber']) : '';
    $user->appartmentNumber = isset($_POST['appartmentNumber']) ? htmlspecialchars($_POST['appartmentNumber']) : '';
    $user->adress = isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : '';
    $user->postalCode = isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode']) : '';
    $user->city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $user->clientNumber = $clientCode;

  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP CIVILITE
  //----------------------------------------------------------------------
    
    if (!isset($user->civility) && empty($user->civility)) {
      $user->formErrors['civility'] = 'Ce champs est vide';
    } elseif ($user->civility < 1 || $user->civility > 2) {
      $user->formErrors['civility'] = 'Veuillez choisir une civilité';
    }
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP NOM
  //----------------------------------------------------------------------
    if (empty($user->lastname)) {
      $user->formErrors['lastname'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_LASTNAME, $user->lastname)) {
      $user->formErrors['lastname'] = 'Ce champ n\'est pas valide';
    } elseif (strlen($user->lastname) < 2 || strlen($user->lastname) > 50) {
      $user->formErrors['lastname'] = 'Le nom doit comporter entre 2 et 50 caractères';
    }
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP PRENOM
  //----------------------------------------------------------------------
    if (empty($user->firstname)) {
      $user->formErrors['firstname'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_FIRSTNAME, $user->firstname)) {
      $user->formErrors['firstname'] = 'Ce champ n\'est pas valide';
    } elseif (strlen($user->firstname) < 2 || strlen($user->firstname) > 50) {
      $user->formErrors['firstname'] = 'Le nom doit comporter entre 2 et 50 caractères';
    }
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP DATE DE NAISSANCE
  //----------------------------------------------------------------------
    if (empty($user->birthDate)) {
      $user->formErrors['birthDate'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_BIRTHDATE, $user->birthDate)) {
      $user->formErrors['birthDate'] = 'Ce champ n\'est pas valide';
    } 
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP NUMERO DE TELEPHONE
  //----------------------------------------------------------------------
    if (empty($user->phoneNumber)) {
      $user->formErrors['phoneNumber'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_PHONE, $user->phoneNumber)) {
      $user->formErrors['phoneNumber'] = 'Ce champ n\'est pas valide';
    } 
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
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP NUMERO DE DOMICILE
  //----------------------------------------------------------------------
   if (empty($user->adressNumber)) {
    $user->formErrors['adressNumber'] = 'Ce champ est vide';
  } elseif (!preg_match(REGEX_NUMBER, $user->adressNumber)) {
    $user->formErrors['adressNumber'] = 'Ce champ n\'est pas valide';
  } 
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP NUMERO D'APPARTEMENT
  //----------------------------------------------------------------------
  if (!empty($user->appartmentNumber) && !preg_match(REGEX_NUMBER, $user->appartmentNumber)) {
    $user->formErrors['appartmentNumber'] = 'veuillez entrer un numéro valide';
  }

  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP ADDRESSE
  //----------------------------------------------------------------------
  if (empty($user->adress)) {
    $user->formErrors['adress'] = 'Ce champ est vide';
  } elseif (!preg_match(REGEX_ADRESS, $user->adress)) {
    $user->formErrors['adress'] = 'Ce champ n\'est pas valide';
  } elseif (strlen($user->adress) < 5 || strlen($user->adress) > 150) {
    $user->formErrors['adress'] = 'Le nom doit comporter entre 5 et 150 caractères';
  }
  //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP CODE POSTAL
  //----------------------------------------------------------------------
  if (empty($user->postalCode)) {
    $user->formErrors['postalCode'] = 'Ce champ est vide';
  } elseif (!preg_match(REGEX_POSTALCODE, $user->postalCode)) {
    $user->formErrors['postalCode'] = 'Ce champ n\'est pas valide';
  } 
 //----------------------------------------------------------------------
  //                  CONDITIONS POUR LE CHAMP VILLE
  //----------------------------------------------------------------------
  if (empty($user->city)) {
    $user->formErrors['city'] = 'Ce champ est vide';
  } elseif (!preg_match(REGEX_CITY, $user->city)) {
    $user->formErrors['city'] = 'Ce champ n\'est pas valide';
  } elseif (strlen($user->city) < 2 || strlen($user->city) > 60) {
    $user->formErrors['city'] = 'Le nom doit comporter entre 2 et 60 caractères';
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
      $_SESSION['successMessage'] = 'Votre profil a été créé avec succès';
      header('Location: ../index.php');
      exit();
    }
  }
}
}
?>
