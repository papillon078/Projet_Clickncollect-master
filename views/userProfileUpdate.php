<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../controllers/userProfileUpdateCtrl.php';
?> 
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <?php include "../header.html" ?>
  <title>Modification du profil</title>
</head>
<body>
  <?php include "../navbar.php"?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 mb-5">
        <form class="" action="#" method="POST">
          <h1 class="text-center m-4 pb-4">Modification</h1>
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
            <!-- CHAMP MAIL -->
            <p class="col-12">
              <label class="labelForm" for="email">Adresse mail</label>
              <div class="input-group px-3">
                
                  <input type="mail" name="email"
                  class="form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['email']) ? 'is-valid' : 'is-invalid') ?> "
                  id="mail" value="<?= isset($userProfile->email) ? $userProfile->email : '' ?>" />
                  <div class="<?= empty($user->formErrors['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                    <?= isset($user->formErrors['email']) ? $user->formErrors['email'] : 'Ce champ est correct' ?>
                  </div>
              
              </div>
            </p>
            <!-- CHAMP MDP -->
            <!-- Option de changement de mot de passe -->
            <p class="passwordChange my-2 text-primary"> cliquez ici si vous souhaitez changer votre mot de passe</p>
            <!-- bloc de changement de mot de passe -->
            <div class="passwordPanel">
              <!-- Champ mot de passe actuel-->
              <label class="font-weight-bold" for="currentPassword">Veuillez saisir votre mot de passe actuel</label>
              <input type="password" name="currentPassword" value="" class="<?= !isset($_POST['submit']) ? '' : (empty($user->formErrors['currentPassword']) ? 'is-valid' : 'is-invalid') ?> form-control "
              id="currentPassword" />
              <div class="<?= empty($user->formErrors['currentPassword']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($user->formErrors['currentPassword']) ? $user->formErrors['currentPassword'] : '' ?>
              </div>
              <!-- Champ nouveau mot de passe-->
              <label class="font-weight-bold" for="Password">Veuillez saisir votre nouveau mot de passe</label>
              <input type="password" name="password" class="<?= !isset($_POST['submit']) ? '' : (empty($user->formErrors['password']) ? 'is-valid' : 'is-invalid') ?> form-control "
              id="password" />
              <div class="<?= empty($user->formErrors['password']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($user->formErrors['password']) ? $user->formErrors['password'] : '' ?>
              </div>
              <div class="row justify-content-center my-2">
                <div class="col-10">
                  <div class="row">
                    <div class="col rectangle mx-1" id="bar1"></div>
                    <div class="col rectangle mx-1" id="bar2"></div>
                    <div class="col rectangle mx-1" id="bar3"></div>
                    <div class="col rectangle mx-1" id="bar4"></div>
                    <div class="col rectangle mx-1" id="bar5"></div>
                    <div class="col rectangle mx-1" id="bar6"></div>
                    <div class="col rectangle mx-1" id="bar7"></div>
                    <div class="col rectangle mx-1" id="bar8"></div>
                    <div class="col rectangle mx-1" id="bar9"></div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <small class="ml-5" id="try"></small>
              </div>
              <!-- CHAMP VERIFICATION MDP -->
              <!-- Champ confirmation du nouveau mot de passe-->
              <label class="font-weight-bold" for="passwordConfirm">confirmez votre nouveau mot de passe</label>
              <input type="password" name="passwordConfirm" class="<?= !isset($_POST['submit']) ? '' : (empty($user->formErrors['passwordConfirm']) ? 'is-valid' : 'is-invalid') ?> form-control "
              id="passwordConfirm" />
              <div class="<?= empty($user->formErrors['passwordConfirm']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($user->formErrors['passwordConfirm']) ? $user->formErrors['passwordConfirm'] : '' ?>
              </div>
              <span class="passwordNotChange my-2 text-primary">Cacher</span>
            </div>
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
          <button type="submit" class="btn btn-lg btn-block mt-4 mb-4 btnRegister text-white" name="submit" value="envoi">Valider</button>
        </form>
      </div>
    </div>
  </div>
  <?php include "../footer.html" ?>
  <!-- gestion de l'accessibilité du panneau de changement de mot de passe en cas d'erreur -->
  <?php if (isset($user->formErrors['password'])) { ?>
    <script>
      $(function () {
        $('.passwordPanel').show(1500);
      });
    </script>
  <?php } else { ?>
    <script>
      $(function () {
        $('.passwordPanel').hide();
      });
    </script>
  <?php } ?>
</body>
</html>







