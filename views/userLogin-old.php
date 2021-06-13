<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../models/order.php';
require_once '../controllers/userLoginCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <?php include "../header.html" ?>
  <title>Identification</title>
</head>
<body>
  <?php include "../navbar.php" ?>
  <div class="container mb-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form class="formulCo" action="#" method="POST">
          <h1 class="text-center m-4 pb-4">Connexion</h1>

          <!-- CHAMP MAIL -->
          <div class="row">
            <div class="col-12 mb-3">
              <label class="labelForm" for="email">Adresse mail</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="validationTooltipPrepend">@</span>
                </div>
                <input type="text" name="email" class="form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['email']) ? 'is-valid' : 'is-invalid') ?> "
                id="mail" placeholder="adresse@mail.com" aria-describedby="inputGroupPrepend3" value="<?= isset($user->email) ? $user->email : '' ?>" />
                <div class="<?= empty($user->formErrors['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                  <?= isset($user->formErrors['email']) ? $user->formErrors['email'] : 'Ce champ est correct' ?>
                </div>
              </div>
            </div>
          </div>
          <!-- CHAMP MDP -->

          <label class="labelForm" for="password">Mot de passe :</label>
          <input type="password" name="password" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['password']) ? 'is-valid' : 'is-invalid') ?>"
          id="password" placeholder="Mot de passe" value="<?= isset($user->password) ? $user->password : '' ?>" />
          <div class="<?= empty($user->formErrors['password']) ? 'valid-feedback' : 'invalid-feedback' ?>">
            <?= isset($user->formErrors['password']) ? $user->formErrors['password'] : 'Ce champ est correct' ?>
          </div>

          <input type="submit" name="submit" class="btn btn-lg btn-block mt-4 mb-4" value="Connexion" />
        </form>
        <a class="item mr-2" href="../forgottenPassword.php">Mot de passe oublié ?</a>
        <a class="item" href="userCreate.php">Pas encore inscrit ? c'est par ici !</a>
      </div>
    </div>
  </div>

  <?php include "../footer.html" ?>
</body>
</html>
