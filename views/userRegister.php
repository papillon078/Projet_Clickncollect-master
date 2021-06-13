<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../controllers/userRegisterCtrl.php';
?> 
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <?php include "../header.html" ?>
  <title>Modification du profil</title>
</head>
<body>
  <?php include "../navbar.php"?>
  <div>
    <!-- LECTURE DES NOTIFICATIONS  -->
    <?= isset($successMessage) ? '<div class="successMes rounded-pill p-2">'.$successMessage.'</div>' : '' ?>
    <?= isset($errorMessage) ? '<div class="errorMes rounded-pill p-2">'.$errorMessage.'</div>' : '' ?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 mb-5">
        <form class="" action="#" method="POST">
          <h1 class="text-center m-4 pb-4">Finalisation d'inscription</h1>
          <fieldset>
            <legend class="userCreatLegend py-3 text-center">IDENTITÉ</legend>
            <!-- CHAMP CIVILITE -->
            <div class="col-12">
             <label class="labelForm" for="civility">Civilité :</label>
             <select class="custom-select <?= !isset($_POST['submit']) ? '' : (empty($item->formErrors['civility']) ? 'is-valid' : 'is-invalid') ?>" name="civility" id="civility" required>
               <option selected disabled value="">Choisissez une civilité</option>
               <option value="1">Monsieur</option>
               <option value="2">Madame</option>
             </select>
             <div class="<?= empty($item->formErrors['civility']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($item->formErrors['civility']) ? $item->formErrors['civility'] : 'champ correct' ?>
            </div>
          </div>
          <!-- CHAMP NOM -->
          <p class="col-12">
            <label class="labelForm" for="lastname">Nom :</label>
            <input type="text" name="lastname" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['lastname']) ? 'is-valid' : 'is-invalid') ?> " id="lastname" value="<?= isset($userProfile->lastname) ? $userProfile->lastname : '' ?>" />
            <div class="<?= empty($user->formErrors['lastname']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['lastname']) ? $user->formErrors['lastname'] : 'Ce champ est correct' ?>
            </div>
          </p>
          <!-- CHAMP PRENOM -->
          <p class="col-12">
            <label class="labelForm" for="firstname">Prénom :</label>
            <input type="text" name="firstname" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['firstname']) ? 'is-valid' : 'is-invalid') ?> " id="firstname" value="<?= isset($userProfile->firstname) ? $userProfile->firstname : '' ?>" />
            <div class="<?= empty($user->formErrors['firstname']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['firstname']) ? $user->formErrors['firstname'] : 'Ce champ est correct' ?>
            </div>
          </p>
          <!-- CHAMP DATE DE NAISSANCE -->
          <p class="col-12">
            <label class="labelForm" for="birthDate">Date de naissance :</label>
            <input type="Date" name="birthDate" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['birthDate']) ? 'is-valid' : 'is-invalid') ?> " id="birthDate" value="<?= isset($userProfile->birth_date) ? $userProfile->birth_date : '' ?>" />
            <div class="<?= empty($user->formErrors['birthDate']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['birthDate']) ? $user->formErrors['birthDate'] : 'Ce champ est correct' ?>
            </div>
          </p>
          <!-- CHAMP TELEPHONE -->
          <p class="col-12">
            <label class="labelForm" for="phoneNumber">N° de téléphone:</label>
            <input type="tel" name="phoneNumber" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['phoneNumber']) ? 'is-valid' : 'is-invalid') ?> " id="phoneNumber" value="<?= isset($userProfile->phone_number) ? $userProfile->phone_number : '' ?>" />
            <div class="<?= empty($user->formErrors['phoneNumber']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['phoneNumber']) ? $user->formErrors['phoneNumber'] : 'Ce champ est correct' ?>
            </div>
          </p>
        </fieldset>
        <fieldset>
          <legend class="userCreatLegend py-3 text-center">ADRESSE</legend>
          <!-- CHAMP numero -->
          <p class="col-12">
            <label class="labelForm" for="adressNumber">N° :</label>
            <input type="text" name="adressNumber" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['adressNumber']) ? 'is-valid' : 'is-invalid') ?> " id="adressNumber" value="<?= isset($userProfile->adress_number) ? $userProfile->adress_number : '' ?>" />
            <div class="<?= empty($user->formErrors['adressNumber']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['adressNumber']) ? $user->formErrors['adressNumber'] : 'Ce champ est correct' ?>
            </div>
          </p>
          <!-- CHAMP RUE -->
          <p class="col-12">
            <label class="labelForm" for="adress">Rue, voie : </label>
            <textarea name="adress" rows=5 class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['adress']) ? 'is-valid' : 'is-invalid') ?> " id="adress" ><?= isset($userProfile->adress) ? $userProfile->adress : '' ?></textarea>
            <div class="<?= empty($user->formErrors['adress']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['adress']) ? $user->formErrors['adress'] : 'Ce champ est correct' ?>
            </div>
          </p>
          <!-- CHAMP numero d'appartement -->
          <p class="col-12">
            <label class="labelForm" for="appartmentNumber">N° d'appartement:</label>
            <input type="text" name="appartmentNumber" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['appartmentNumber']) ? 'is-valid' : 'is-invalid') ?> " id="appartmentNumber" value="<?= (!empty($userProfile->appartment_number) && isset($userProfile->appartment_number)) ? $userProfile->appartment_number : '' ?>" />
            <div class="<?= empty($user->formErrors['appartmentNumber']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['appartmentNumber']) ? $user->formErrors['appartmentNumber'] : 'Ce champ est correct' ?>
            </div>
          </p>

          <!-- CHAMP POSTAL CODE -->
          <p class="col-12">
            <label class="labelForm" for="postalCode">Code postal :</label>
            <input type="text" pattern="[0-9]{5}" name="postalCode" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['postalCode']) ? 'is-valid' : 'is-invalid') ?> " id="postalCode" value="<?= isset($userProfile->postal_code) ? $userProfile->postal_code : '' ?>" />
            <div class="<?= empty($user->formErrors['postalCode']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['postalCode']) ? $user->formErrors['postalCode'] : 'Ce champ est correct' ?>
            </div>
          </p>

          <!-- CHAMP CITY -->
          <p class="col-12">
            <label class="labelForm" for="city">Ville :</label>
            <input type="text" name="city" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['city']) ? 'is-valid' : 'is-invalid') ?> " id="city" value="<?= isset($userProfile->city) ? $userProfile->city : '' ?>" />
            <div class="<?= empty($user->formErrors['city']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['city']) ? $user->formErrors['city'] : 'Ce champ est correct' ?>
            </div>
          </p>
        </fieldset>
        <button type="submit" class="btn btn-lg btn-block mt-4 mb-4 btnRegister text-white" name="submit" value="envoi">Validé</button>
      </form>
    </div>
  </div>
</div>
<?php include "../footer.html" ?>
</body>
</html>







