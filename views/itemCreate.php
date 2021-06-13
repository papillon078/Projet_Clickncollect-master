<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/item.php';
require_once '../controllers/itemCreateCtrl.php';
?> 
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <?php include "../header.html" ?>
  <title>Création d'un produit'</title>
</head>
<body class="itemCreateBody">
  <?php include "../navbar.php" ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 my-5 itemCreateDiv">
        <form class="" action="#" method="POST" enctype="multipart/form-data">
          <h1 class="text-center py-5">Ajouter un produit au catalogue</h1>
          <fieldset>
            <legend class="itemCreatLegend text-center">DÉNOMINATION DU PRODUIT</legend>
            <!-- CHAMP CATEGORIE -->
            <div class="col-12">
              <label class="labelForm" for="categorie">Catégories :</label>
              <select class="custom-select <?= !isset($_POST['submit']) ? '' : (empty($item->formErrors['categoryName']) ? 'is-valid' : 'is-invalid') ?>" name="categoryName" id="categoryName" required>
                <option selected disabled value="">Choisissez une catégorie</option>
                <option value="2">Fruits et légumes</option>
                <option value="3">Viandes et poissons</option>
                <option value="4">Frais</option>
                <option value="6">Épicerie sucrée</option>
                <option value="7">Épicerie salée</option>
                <option value="5">Surgelés</option>
                <option value="8">Boisson</option>
                <option value="9">Hygiène et beauté</option>
                <option value="10">Bio</option>
                <option value="11">Entretien</option>
                <option value="12">Animaux</option>
                <option value="13">Maison et décoration</option>
                <option value="14">Bricolage</option>
                <option value="1">Menu</option>
              </select>
              <div class="<?= empty($item->formErrors['categoryName']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['categoryName']) ? $item->formErrors['categoryName'] : 'champ correct' ?>
              </div>
            </div>



            <!-- CHAMP NOM -->
            <div class="col-12">
              <label class="labelForm" for="itemName">Nom :</label>
              <input type="text" name="itemName" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['itemName']) ? 'is-valid' : 'is-invalid') ?> " id="itemName" placeholder="Nom du produit" value="<?= isset($item->itemName) ? $item->itemName : '' ?>" />
              <div class="<?= empty($item->formErrors['itemName']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['itemName']) ? $item->formErrors['itemName'] : 'Ce champ est correct' ?>
              </div>
            </div>

            <!-- CHAMP IMAGE PETITE-->
            <div class="col-6">
              <label class="labelForm" for="smallPicture"><strong>Petite Image</strong></label>
              <input type="file" name="smallPicture" accept="image/png, image/jpeg, image/jpg" class="inputForm  form-control-file <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['smallPicture']) ? 'is-valid' : 'is-invalid') ?> " id="smallPicture" size="30" />
              <div class="<?= empty($item->formErrors['smallPicture']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['smallPicture']) ? $item->formErrors['smallPicture'] : 'Ce champ est correct' ?>
              </div>
            </div>

            <!-- CHAMP IMAGE GRANDE ZOOM-->
            <div class="col-6">
              <label class="labelForm" for="largePicture"><strong>Grande Image</strong></label>
              <input type="file" name="largePicture" accept="image/png, image/jpeg, image/jpg" class="inputForm  form-control-file <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['largePicture']) ? 'is-valid' : 'is-invalid') ?> " id="largePicture" size="30" />
              <div class="<?= empty($item->formErrors['largePicture']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['largePicture']) ? $item->formErrors['largePicture'] : 'Ce champ est correct' ?>
              </div>
            </div>

            <!-- CHAMP DESCRIPTION -->
            <div class="col-12">
              <label class="labelForm" for="description">Description du produit :</label>
              <textarea name="description" rows=5 class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['description']) ? 'is-valid' : 'is-invalid') ?> " id="description" value="<?= isset($item->description) ? $item->description : '' ?>" ></textarea>
              <div class="<?= empty($item->formErrors['description']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['description']) ? $item->formErrors['description'] : 'Ce champ est correct' ?>
              </div>
            </div>

            <!-- CHAMP MENU -->
            <div class="col-12 pb-4">
              <label class="labelForm" for="menu">Menu :</label>
              <select class="custom-select <?= !isset($_POST['submit']) ? '' : (empty($item->formErrors['menu']) ? 'is-valid' : 'is-invalid') ?>" name="menu" id="menu" required>
                <option selected disabled value="">Choisissez un menu</option>
                <?php
                 // foreach dans un tableau d'objets permet de choisir les menus un par un ds la BDD
                foreach ($menuList as $item) {
                  ?>

                  <option value="<?= $item->id ?>"><?= $item->name ?></option>

                <?php } ?>

              </select>
              <div class="<?= empty($item->formErrors['menu']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['menu']) ? $item->formErrors['menu'] : 'champ correct' ?>
              </div>
            </div>

          </fieldset>
          <fieldset>
            <legend class="itemCreatLegend text-center">CARACTÉRISTIQUES DU PRODUIT</legend>
            <!-- CHAMP TAILLE -->
            <div class="col-12">
              <label class="labelForm" for="size">Taille :</label>
              <input type="text" name="size" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['size']) ? 'is-valid' : 'is-invalid') ?> " id="size" placeholder="Ex : 24 cm" value="<?= isset($item->size) ? $item->size : '' ?>" />
              <div class="<?= empty($item->formErrors['size']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['size']) ? $item->formErrors['size'] : 'Ce champ est correct' ?>
              </div>
            </div>
            <!-- CHAMP POIDS -->
            <div class="col-12">
              <label class="labelForm" for="weight">Quantité : </label>
              <input type="number" step="0.01" min="0" name="weight" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['weight']) ? 'is-valid' : 'is-invalid') ?> " id="weight" placeholder="Ex : 1.5" value="<?= isset($item->weight) ? $item->weight : '' ?>" />
              <div class="<?= empty($item->formErrors['weight']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['weight']) ? $item->formErrors['weight'] : 'Ce champ est correct' ?>
              </div>
            </div>
            <!-- CHAMP PACKAGING -->
            <div class="col-12">
              <label class="labelForm" for="packagingName">Conditionnement : </label>
              <select class="custom-select <?= !isset($_POST['submit']) ? '' : (empty($item->formErrors['packagingName']) ? 'is-valid' : 'is-invalid') ?>" name="packagingName" id="packagingName" required>
                <option selected disabled value="">Choisissez un conditionnement</option>
                <option value="1">le lot</option>
                <option value="2">grammes</option>
                <option value="3">/Kg</option>
                <option value="4">cl</option>
                <option value="5">/L</option>
                <option value="6">la pièce</option>
              </select>
              <div class="<?= empty($item->formErrors['packagingName']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['packagingName']) ? $item->formErrors['packagingName'] : 'champ correct' ?>
              </div>
            </div>

            <!-- CHAMP PRIX -->
            <div class="col-12">
              <label class="labelForm" for="taxeFreePrice">Prix (HT en €) :</label>
              <input type="number" step="0.01" min="0" name="taxeFreePrice" class="inputForm form-control <?= !isset($_POST['submit'])? '' : (empty($item->formErrors['taxeFreePrice']) ? 'is-valid' : 'is-invalid') ?> " id="taxeFreePrice" placeholder="Ex : 24.75" value="<?= isset($item->taxeFreePrice) ? $item->taxeFreePrice : '' ?>" />
              <div class="<?= empty($item->formErrors['taxeFreePrice']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                <?= isset($item->formErrors['taxeFreePrice']) ? $item->formErrors['taxeFreePrice'] : 'Ce champ est correct' ?>
              </div>
            </div>

            <!-- CHAMP TAXE-->
            <div class="col-12">
              <label class="labelForm" for="rate">Taux de TVA : </label><a class="infobulle">
                <img src="../assets/img/help35px.png" class="mx-2 pb-2" alt="point d'interrogation">
                <span><strong> TVA fixée à 20 % : </strong>pour la majorité des ventes de biens et des prestations de services. Il s'applique à tous les produits ou services pour lesquels aucun autre taux n'est expressément prévu.</br>

                  <strong>TVA fixée à 10 % : </strong>notamment applicable aux produits agricoles non transformés, au bois de chauffage, aux travaux d'amélioration du logement qui ne bénéficient pas du taux de 5,5%, à certaines prestations de logement et de camping, aux foires et salons, jeux et manèges forains, aux droits d'entrée des musées, zoo, monuments, aux transports de voyageurs, au traitement des déchets, à la restauration.</br>

                  <strong>TVA fixée à 5,5 % : </strong>concerne l'essentiel des produits alimentaires, les produits de protection hygiénique féminine, équipements et services pour handicapés, livres sur tout support, abonnements gaz et électricité, fourniture de chaleur issue d’énergies renouvelables, fourniture de repas dans les cantines scolaires, billeterie de spectacle vivant et de cinéma, certaines importations et livraisons d'œuvres d'art, travaux d’amélioration de la qualité énergétique des logements, logements sociaux ou d'urgence, accession à la propriété.</br>

                  <strong>TVA fixée à 2,1 % : </strong>réservé aux médicaments remboursables par la sécurité sociale, aux ventes d’animaux vivants de boucherie et de charcuterie à des non assujettis, à la redevance télévision, à certains spectacles et aux publications de presse inscrites à la Commission paritaire des publications et agences de presse.</span>
                </a> 
                <select class="custom-select <?= !isset($_POST['submit']) ? '' : (empty($item->formErrors['rate']) ? 'is-valid' : 'is-invalid') ?>" name="rate" id="rate" required>
                  <option selected disabled value="">Choisissez un taux de TVA</option>
                  <option value="1">2,1%</option>
                  <option value="2">5,5%</option>
                  <option value="3">10%</option>
                  <option value="4">20%</option>
                </select>
                <div class="<?= empty($item->formErrors['rate']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                  <?= isset($item->formErrors['rate']) ? $item->formErrors['rate'] : 'champ correct' ?>
                </div>
              </div>
            </fieldset>
            <button type="submit" class="btn btn-lg btn-block mt-4 mb-4 itemCreatLegend text-center" name="submit" value="envoi">Validé</button>
          </form>
        </div>
      </div>
    </div>
    <?php include "../footer.html" ?>
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>
  </html>
