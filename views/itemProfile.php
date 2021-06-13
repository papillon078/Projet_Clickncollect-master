<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/item.php';
require_once '../models/commandLine.php';
require_once '../controllers/itemProfileCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<?php include "../header.html" ?>
	<title>Fiche produit</title>
</head>
<body>
	<?php include "../navbar.php" ?>


	<div class="container"><!--DIV CONTAINER-->
		<div class="mt-4">
			<?= isset($message) ? '<span class="successMes rounded-pill p-2">'.$message.'</span>' : '' ?>
		</div>
		<div class="row"><!--DIV ROW-->
			<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1983) { }?>
			<div class="col-6"><!--DIV DE GAUCHE-->
				<div class="row"><!--DIV ROW DE GAUCHE-->
					<div class="rounded-lg col-12 text-center"><!--DIV IMAGE-->
						<!-- image zoomable -->
						<img class="rounded-lg" id="zoom_mw" src="<?= $itemProfile->picture_small ?>" data-zoom-image="<?= $itemProfile->picture_large ?>" />
						<small>Passez la souris sur l'image pour zoomer</small> 
					</div><!--FIN DIV IMAGE-->
					<div class="col-12 mt-3 mb-5"><!--DIV PACKAGING-->
						<p><span class="itemProfWeightPack px-3 py-1">
							<?php if (isset($itemProfile->weight) && $itemProfile->weight > 0) { 
								if ($itemProfile->weight == 1) {
									echo 'Le '.$itemProfile->packagingName;
								} else {
									echo $itemProfile->weight.''.$itemProfile->packagingName; 
								}} else { 
									echo $itemProfile->packagingName;
								} ?>
							</span>
						</p>
					</div><!--FIN DIV PACKAGING-->
					<div class="col-12"><!--DIV DESCRIPTION-->
						<p class="descriptPackag"><?= $itemProfile->description ?></p>
					</div><!--FIN DIV DESCRIPTION-->
				</div><!--FIN DIV ROW DE GAUCHE-->
			</div><!--FIN DIV DE GAUCHE-->


			<div class="card col-4 offset-md-6 divDeDroite"><!--DIV DE DROITE-->
				<div class="row"><!--DIV ROW DE DROITE-->
					<div class="col-12 p-3"><!--DIV NOM DU PRODUIT-->
						<p class="h3"><?= $itemProfile->itemName ?></p>
					</div><!--FIN DIV NOM DU PRODUIT-->
					<div class="col-12"><!--DIV PACKAGING-->
						<p>
							<?php if (isset($itemProfile->weight) && $itemProfile->weight > 0) { 
								if ($itemProfile->weight == 1) {
									echo 'Le '.$itemProfile->packagingName;
								} else {
									echo $itemProfile->weight.''.$itemProfile->packagingName; 
								}} else { 
									echo $itemProfile->packagingName;
								} ?>

							</p>
						</div><!--FIN DIV PACKAGING-->
						<div class="col-12"><!--DIV PRIX + AJOUT PANIER-->
							<p>Prix : <?= round($itemProfile->taxe_free_price*$itemProfile->taxeRate, 2 ) ?> €</p>

							<form method="POST" action="#" class="form-inline">
								<div class="col-12 mb-4"><!-- DIV AJOUT PANIER-->
									<div class="row">
										<div class="col-6 form-inline px-0">
											<label for="itemNumber">Quantité</label>
											<input type="number" class="my-0 inputForm form-control <?= !isset($_POST['submit']) ? '' : (empty($item->formErrors['stock']) ? 'is-valid' : 'is-invalid')?>" name="itemNumber" id="itemNumber"
											min="1" 
											max="10" aria-label="itemNumber" aria-describedby="button-addon2" value="1">
										</div>
										<div class="col-6 form-inline">
											<button class="form-control text-white " name="addCart" type="submit" id="buy">
												Ajouter au Panier
											</button>
										</div>
									</div>

								</div><!--FIN DIV AJOUT PANIER-->
							</form>
							
						</div><!--FIN DIV PRIX + AJOUT PANIER-->
					</div><!--FIN DIV ROW DE DROITE-->
				</div><!--FIN DIV DE DROITE-->
				<div class="col-12 section"><!-- DIV SUGGESTIONS-->
					<div class="titleSection rounded-pill">
						<div class="py-3 my-3"><span class="h4 ideaMenuTitle col-4">Idée de menu sympa : </span><span class="ideaMenuName col-6 ml-2"><?= $itemProfile->menuName ?></span></div>
					</div>
					<div class="col-6" id="suggestList"><!-- DIV MULTI-CARTES-->

						<!-- FOREACH-->
						<?php
						foreach ($menuItems as $item) {
							if ($itemProfile->id == $item->id){
							}else{
								?>
								<div class="card cardThumb mx-1"><!--DIV MULTI-CARTES-->
									<h6 class="card-title"><?= $item->itemName ?></h6>
									<p class="card-text">
										<?php if (isset($item->weight) && $item->weight > 0) { 
											if ($item->weight == 1) {
												echo 'Le '.$item->packagingName;
											} else {
												echo $item->weight.''.$item->packagingName; 
											}} else { 
												echo $item->packagingName;
											} ?>

										</p>

										<div class="card-body"><!--DIV MULTI-CARTES BODY-->
											<img src="<?= $item->picture_small ?>" class="card-img-top pb-4" alt="...">

											<div class="row"><!--DIV MULTI-CARTES ROW-->
												<div>	<!--DIV MULTI-CARTES PRIX-->
													<p class="card-text pt-3"><?= round($item->taxe_free_price*$item->taxeRate, 2) ?> €</p>
												</div><!--FIN DIV MULTI-CARTES PRIX-->
												<div class="col-md-4 offset-md-4"><!--DIV MULTI-CARTES AJOUT PANIER-->


													<!--BOUTON METTRE DANS LE PANIER ?????? -->

													<img class="rounded" src="../assets/img/panier.png" alt="">
												</div><!--FIN DIV MULTI-CARTES AJOUT PANIER-->

											</div><!--FIN DIV MULTI-CARTES ROW-->
										</div><!--FIN DIV MULTI-CARTES BODY-->
									</div><!--FIN DIV MULTI-CARTES-->
								<?php }} ?>

							</div><!--FIN DIV MULTI-CARTES-->

						</div><!--FIN DIV SUGGESTIONS-->



					</div><!--FIN DIV ROW-->
				</div><!--FIN DIV CONTAINER-->

				<?php include "../footer.html" ?>
				<script src="../assets/js/cartScript.js"></script>
				<script src="../assets/js/zoomScript.js"></script>
			</body>
			</html>