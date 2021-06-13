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
  <?php include "../header.html"; ?>
  <title>S'identifier</title>
</head>
<body>
  <div id="bloc-principal">
    <!-- NAVBAR -->
    <?php include "../navbar.php" ?>

    <!-- LECTURE DES NOTIFICATIONS  -->
    <?= isset($successMessage) ? '<div class="successMes rounded-pill p-2">'.$successMessage.'</div>' : '' ?>
    <?= isset($errorMessage) ? '<div class="errorMes rounded-pill p-2">'.$errorMessage.'</div>' : '' ?>



    <!-- image transition login -->
    <div class="container"> <!-- DIV CONTAINER-->
      <div class="row parent my-5"><!-- DIV ROW-->
        <div class="col-6 child1"><!-- DIV CHILD1-->
          <div class="row"><!--DIV ROW-->
            <!-- FORMULAIRE D'INSCRIPTION -->
            <form class="subscribeForm col-8 mx-auto" action="" method="POST">
              <h2 class="text-center">Inscription</h2>

              <!-- CHAMP MAIL -->
              <div>
                <label class="labelForm" for="email">Adresse mail</label>

                <input type="mail" name="email"
                class="form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['email']) ? 'is-valid' : 'is-invalid') ?> "
                id="mail" placeholder="adresse@mail.com" value="<?= isset($user->email) ? $user->email : '' ?>" />
                <div class="<?= empty($user->formErrors['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                  <?= isset($user->formErrors['email']) ? $user->formErrors['email'] : 'Ce champ est correct' ?>
                </div>

              </div>

              <!-- CHAMP MDP -->
              <div>
                <label class="labelForm" for="password">Mot de passe :</label>
                <input type="password" name="password" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['password']) ? 'is-valid' : 'is-invalid') ?>" id="password" placeholder="mot de passe" value="<?= isset($user->password) ? $user->password : '' ?>" />
                <div class="<?= empty($user->formErrors['password']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                  <?= isset($user->formErrors['password']) ? $user->formErrors['password'] : 'Ce champ est correct' ?>
                </div>
              </div>
              <div>
                <div class="progress my-3">
                  <div class="progress-bar progress-bar-animated" id="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                  </div>
                </div>
              </div>
              <!-- CHAMP VERIFICATION MDP -->
              <div>
                <label class="labelForm" for="passwordConfirm">Confirmation du mot de passe :</label>
                <input type="password" name="passwordConfirm" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($user->formErrors['passwordConfirm']) ? 'is-valid' : 'is-invalid') ?> " id="passwordConfirm" placeholder="confirmation du mot de passe" value="<?= isset($user->password) ? $user->password : '' ?>" />
                <div class="<?= empty($user->formErrors['passwordConfirm']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                  <?= isset($user->formErrors['passwordConfirm']) ? $user->formErrors['passwordConfirm'] : 'Ce champ est correct' ?>
                </div>
              </div>

              <div>

                <button type="submit" class="userCreateBtn btn btn-lg btn-block mt-4 mb-4" name="registerSubmit" value="envoi">Valider</button>


              </div>
            </form>
          </div><!--FIN DIV ROW-->
        </div><!--FIN DIV CHILD1-->

        <div class="col-6 child3"><!-- DIV CHILD3-->
          <div class="row"><!--DIV ROW-->


            <!-- FORMULAIRE DE CONNEXION -->
            <form class="subscribeForm col-8 mx-auto" action="" method="POST">
              <h2 class="text-center">Connexion</h2>
              <!-- Champ email-->
              <label class="font-weight-bold" for="email">Adresse mail</label>
              <input type="email" name="email" class="<?= !isset($_POST['submit']) ? '' : (empty($user->formErrors['email']) ? 'is-valid' : 'is-invalid') ?> form-control "
              id="email" placeholder="adresse@mail.com" value="<?= isset($user->email) ? $user->email : '' ?>" />
              <div class="<?= empty($user->formErrors['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($user->formErrors['email']) ? $user->formErrors['email'] : 'champ correct' ?>
              </div>

              <!-- Champ mot de passe-->
              <label class="font-weight-bold" for="password">Mot de passe</label>
              <input type="password" name="password" class="<?= !isset($_POST['submit']) ? '' : (empty($user->formErrors['password']) ? 'is-valid' : 'is-invalid') ?> form-control "
              id="password" placeholder="mot de passe"/>
              <div class="<?= empty($user->formErrors['password']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($user->formErrors['password']) ? $user->formErrors['password'] : '' ?>
              </div>
              <!--MOT DE PASSE OUBLIÉ-->
              <div class="cessionManagment mb-3 row">
                <a class="form-item font-weight-bold col-12" href="#">Mot de passe oublié ?</a>
              </div>
              <input type="submit" id="submit" name="loginSubmit" class="userCreateBtn btn btn-lg btn-block mt-4 mb-4" value="Connexion" />
            </form>
          </div><!--FIN DIV ROW-->
        </div><!--FIN DIV CHILD3-->
        <div class="cacheColor"><!-- DIV CACHECOLOR-->
          <canvas id="canvasConnexion" width="570" height="400" style="background-color: #14213D"></canvas>
          <span class="loginPart border border-white rounded-pill text-white p-3">S'inscrire</span>
          <span class="registerPart border border-white rounded-pill text-white p-3">S'identifier</span>
        </div><!--FIN DIV CACHECOLOR-->
      </div><!--FIN DIV ROW-->
    </div><!--FIN DIV CONTAINER-->
  </div><!--FIN DIV bloc-principal-->
  <!-- FOOTER -->
  <?php include "../footer.html" ?>
  <script src="../assets/js/connexionScript.js"></script>
  <script src="../assets/js/mdpScript.js"></script>
</body>
</html>




