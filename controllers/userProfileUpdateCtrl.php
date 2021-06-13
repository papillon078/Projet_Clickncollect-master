<?php

if (!isAdmin() && !isClient() && !isSeller()) {
    header('location: ../index.php');
    exit();
} else {
// création d'une instance de classe User
    $user = new User();

//renseignement de l'attribut id du profil recherché
    $user->id = $_SESSION['user_id'];

// récupération du profil du patient recherché pour pré-affichage des champs
    $userProfile = $user->getUserProfile();

//definition des regex pour la validation du formulaire
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
// detection de l'envoi du formulaire mis à jour
    if (isset($_POST['submit'])) {

        // récupération des données du formulaire
     $user->civility = isset($_POST['civility']) ? htmlspecialchars(trim($_POST['civility'])) : '';
     $user->email = isset($_POST['email']) ? strtolower(htmlspecialchars(trim($_POST['email']))) : '';
     $user->lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
     $user->firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
     $user->birthDate = isset($_POST['birthDate']) ? htmlspecialchars($_POST['birthDate']) : '';
     $user->phoneNumber = isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : '';
     $user->adressNumber = isset($_POST['adressNumber']) ? htmlspecialchars($_POST['adressNumber']) : '';
     $user->appartmentNumber = isset($_POST['appartmentNumber']) ? htmlspecialchars($_POST['appartmentNumber']) : '';
     $user->adress = isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : '';
     $user->postalCode = isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode']) : '';
     $user->city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
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



        // detection de changement du mot de passe en option    
  if (!empty($_POST['currentPassword'])) {
            // récupération des données du formulaire
    $currentPassword = isset($_POST['currentPassword']) ? $_POST['currentPassword'] : '';
    $user->password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordConfirm = isset($_POST['passwordConfirm']) ? $_POST['passwordConfirm'] : '';

            // validation du nouveau mot de passe
    if (empty($user->password)) {
        $user->formErrors['password'] = 'veuillez remplir ce champ';
    } elseif (!preg_match(REGEX_PASSWORD, $user->password)) {
        $user->formErrors['password'] = 'Ce champ n\'est pas valide';
    } elseif ($user->password != $passwordConfirm) {
        $user->formErrors['password'] = 'Le mot de passe ne correspond pas';
    }


            // vérification que tous les champs sont prêts à etre envoyés 
            // et que le mot de passe actuel est le bon
    if (empty($user->formErrors) && password_verify($currentPassword, $userProfile->password)) {

                // hashage du mot de passe
        $user->password = password_hash($user->password, PASSWORD_DEFAULT);

                // insertion des données des patients
        $success = $user->updateFullUser();
    }
}

        // Si on ne desire pas changer le mot de passe et que tous les champs sont validés
elseif (empty($user->formErrors)) {

            // insertion des données de l'utilisateur
    $success = $user->updateShortUser();
}

        // envoi de la notification de succes d'ecriture de la base de données
if (isset($success) && $success) {
    $_SESSION['user_email'] = $userProfile->email;
    $_SESSION['user_lastname'] = $userProfile->lastname;
    $_SESSION['user_firstname'] = $userProfile->firstname;
    $_SESSION['successMessage'] = 'Votre profil a bien été mis à jour';
    header('location: userProfile.php');
    exit();
}
}
}


