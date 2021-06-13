<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../controllers/userCreateCtrl.php';
?> 
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <?php include "../header.html" ?>
  <title>Création de compte</title>
</head>
<body>
  <?php include "../navbar.php" ?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 mb-5">
        <form class="" action="#" method="POST">
          <h1 class="text-center m-4 pb-4">Inscription</h1>
          <fieldset class="my-4">
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
          <div class="col-12">
            <label class="labelForm" for="lastname">Nom :</label>
            <input type="text" name="lastname" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['lastname']) ? 'is-valid' : 'is-invalid') ?> " id="lastname" placeholder="Nom" value="<?= isset($user->lastname) ? $user->lastname : '' ?>" />
            <div class="<?= empty($user->formErrors['lastname']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['lastname']) ? $user->formErrors['lastname'] : 'Ce champ est correct' ?>
            </div>
          </div>
          <!-- CHAMP PRENOM -->
          <div class="col-12">
            <label class="labelForm" for="firstname">Prénom :</label>
            <input type="text" name="firstname" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['firstname']) ? 'is-valid' : 'is-invalid') ?> " id="firstname" placeholder="Prénom" value="<?= isset($user->firstname) ? $user->firstname : '' ?>" />
            <div class="<?= empty($user->formErrors['firstname']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['firstname']) ? $user->formErrors['firstname'] : 'Ce champ est correct' ?>
            </div>
          </div>
          <!-- CHAMP DATE DE NAISSANCE -->
          <div class="col-12">
            <label class="labelForm" for="birthDate">Date de naissance :</label>
            <input type="Date" name="birthDate" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['birthDate']) ? 'is-valid' : 'is-invalid') ?> " id="birthDate" placeholder="Date de naissance" value="<?= isset($user->birthDate) ? $user->birthDate : '' ?>" />
            <div class="<?= empty($user->formErrors['birthDate']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['birthDate']) ? $user->formErrors['birthDate'] : 'Ce champ est correct' ?>
            </div>
          </div>
          <!-- CHAMP TELEPHONE -->
          <div class="col-12">
            <label class="labelForm" for="phoneNumber">N° de téléphone:</label>
            <input type="tel" name="phoneNumber" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['phoneNumber']) ? 'is-valid' : 'is-invalid') ?> " id="phoneNumber" placeholder="n° de téléphone" value="<?= isset($user->phoneNumber) ? $user->phoneNumber : '' ?>" />
            <div class="<?= empty($user->formErrors['phoneNumber']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['phoneNumber']) ? $user->formErrors['phoneNumber'] : 'Ce champ est correct' ?>
            </div>
          </div>
          <!-- CHAMP MAIL -->
          <div class="col-12">
            <label class="labelForm" for="email">Adresse mail</label>

             
              <input type="mail" name="email"
              class="form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['email']) ? 'is-valid' : 'is-invalid') ?> "
              id="mail" placeholder="adresse@mail.com" value="<?= isset($user->email) ? $user->email : '' ?>" />
              <div class="<?= empty($user->formErrors['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($user->formErrors['email']) ? $user->formErrors['email'] : 'Ce champ est correct' ?>
              </div>
           
          </div>
          <!-- CHAMP MDP -->
          <div class="col-12">
            <label class="labelForm" for="password">Mot de passe :</label>
            <input type="password" name="password" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['password']) ? 'is-valid' : 'is-invalid') ?>" id="password" placeholder="Mot de passe" value="<?= isset($user->password) ? $user->password : '' ?>" />
            <div class="<?= empty($user->formErrors['password']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['password']) ? $user->formErrors['password'] : 'Ce champ est correct' ?>
            </div>
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
          <div class="col-12 ">
            <label class="labelForm" for="passwordConfirm">Confirmation du mot de passe :</label>
            <input type="password" name="passwordConfirm" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['passwordConfirm']) ? 'is-valid' : 'is-invalid') ?> " id="passwordConfirm" placeholder="Confirmation du mot de passe" value="<?= isset($user->password) ? $user->password : '' ?>" />
            <div class="<?= empty($user->formErrors['passwordConfirm']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['passwordConfirm']) ? $user->formErrors['passwordConfirm'] : 'Ce champ est correct' ?>
            </div>
          </div>
        </fieldset>
        <fieldset class="my-4">
          <legend class="userCreatLegend py-3 text-center">ADRESSE</legend>
          <!-- CHAMP numero -->
          <div class="col-12">
            <label class="labelForm" for="adressNumber">N° :</label>
            <input type="text" name="adressNumber" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['adressNumber']) ? 'is-valid' : 'is-invalid') ?> " id="adressNumber" placeholder="Ex : 24" value="<?= isset($user->adressNumber) ? $user->adressNumber : '' ?>" />
            <div class="<?= empty($user->formErrors['adressNumber']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['adressNumber']) ? $user->formErrors['adressNumber'] : 'Ce champ est correct' ?>
            </div>
          </div>
          <!-- CHAMP RUE -->
          <div class="col-12">
            <label class="labelForm" for="adress">Rue, voie : </label>
            <textarea name="adress" rows=5 class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['adress']) ? 'is-valid' : 'is-invalid') ?> " id="adress" placeholder="Ex : Rue de la République" value="<?= isset($user->adress) ? $user->adress : '' ?>" ></textarea>
            <div class="<?= empty($user->formErrors['adress']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['adress']) ? $user->formErrors['adress'] : 'Ce champ est correct' ?>
            </div>
          </div>
          <!-- CHAMP numero d'appartement -->
          <div class="col-12">
            <label class="labelForm" for="appartmentNumber">N° d'appartement:</label>
            <input type="text" name="appartmentNumber" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['appartmentNumber']) ? 'is-valid' : 'is-invalid') ?> " id="appartmentNumber" placeholder="Ex : 10" value="<?= isset($user->appartmentNumber) ? $user->appartmentNumber : '' ?>" />
            <div class="<?= empty($user->formErrors['appartmentNumber']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['appartmentNumber']) ? $user->formErrors['appartmentNumber'] : 'Ce champ est correct' ?>
            </div>
          </div>

          <!-- CHAMP POSTAL CODE -->
          <div class="col-12">
            <label class="labelForm" for="postalCode">Code postal :</label>
            <input type="text" pattern="[0-9]{5}" name="postalCode" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['postalCode']) ? 'is-valid' : 'is-invalid') ?> " id="postalCode" placeholder="Ex : 75000" value="<?= isset($user->postalCode) ? $user->postalCode : '' ?>" />
            <div class="<?= empty($user->formErrors['postalCode']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['postalCode']) ? $user->formErrors['postalCode'] : 'Ce champ est correct' ?>
            </div>
          </div>

          <!-- CHAMP CITY -->
          <div class="col-12">
            <label class="labelForm" for="city">Ville :</label>
            <input type="text" name="city" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['city']) ? 'is-valid' : 'is-invalid') ?> " id="city" placeholder="Ex : Paris" value="<?= isset($user->city) ? $user->city : '' ?>" />
            <div class="<?= empty($user->formErrors['city']) ? 'valid-feedback' : 'invalid-feedback' ?>">
              <?= isset($user->formErrors['city']) ? $user->formErrors['city'] : 'Ce champ est correct' ?>
            </div>
          </div>
        </fieldset>
        <button type="submit" class="userCreateBtn btn btn-lg btn-block mt-4 mb-4" name="submit" value="envoi">Valider</button>
      </form>
    </div>
  </div>
</div>
<?php include "../footer.html" ?>
<script src="../assets/js/mdpScript.js"></script>
</body>
</html>
