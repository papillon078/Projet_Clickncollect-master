<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/item.php';
require_once '../models/order.php';
require_once '../models/commandLine.php';
require_once '../controllers/cartCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<?php include "../header.html" ?>
	<title>Panier</title>
</head>
<body>
	<!-- NAVBAR -->
	<?php include "../navbar.php" ?>
	<div class="container">
		<?php if (empty($commandLines)){ ?>
			<div class="col-12 my-5">
				<div class="row">
					<div class="col-12 my-4">
						<p class="emptyCart text-center">Votre panier est vide !</p>
					</div>

					<div class="col-md-6 offset-md-3 py-3 rounded-pill goShopping">
						<a class="aGoShopping" href="catalogue.php">
							<p class="text-center my-3">Je commence mes achats ici</p>
							<p class="text-center my-3">catalogue</p>
							
						</a>
					</div>

				</div>
			</div>
		<?php } else {?>
			<div class="col-12 my-5">
				<p class="bg-success text-white text-center"><?= isset($message) ? $message : '' ?></p>
			</div>
			<div class="row">
				<div class="carte col-12 mb-5">
					<div class="col-12 py-5">
						<div class="h1 text-center">Mon panier</div> 
					</div>


					<div class="table-responsive">
						<table class="table-striped text-center table col-12 mx-auto my-5">
							<thead class="itemProfileThead">
								<tr>
									<th scope="col">Aperçu</th>
									<th scope="col">Désignation</th>
									<th scope="col">Quantité</th>
									<th scope="col">Prix (TTC)</th>
									<th scope="col"></th>
								</tr>
							</thead>

							<tbody>

								<?php foreach ($commandLines as $item) { ?>
									<tr>
										<td class="align-middle text-center">
											<img class="itemListImage" src="<?= $item->picture_small ?>" alt="">
										</td>


										<td class="align-middle text-center designatItemName">
											<?= $item->itemName ?><br/>
											<small>
												<?= ($item->weight ? ($item->weight == 1 ? "le": $item->weight) : "").' '.$item->packagingName ?>
											</small>


										</td>
										<td class="align-middle text-center designatItemName">
											<?= $item->quantity ?>
										</td>
										<td class="align-middle text-center designatItemName">
											<?= number_format($item->total_TTC, $decimals = 2, "," , " " ) ?> €
										</td>
										<td class="align-middle text-center">
											<button type="submit" class="btn"><a href="cartDelete.php?orderId=<?= $_SESSION['user_cart_id'] ?>&itemId=<?= $item->itemId ?>"><img src="../assets/img/deleteCross.png" alt="icône"/></a></button>
										</td>
									</tr>
								<?php } ?>

							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td class="font-weight-bolder">Total: <?= number_format($total, $decimals = 2, "," , " " ) ?> €</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="my-3 mx-2">
						<div class="row">
							<button type="button" class="btn btnCart mx-3"><a href="catalogue.php" class="text-white">Continuer mes achats</a></button>


						</div>
					</div>
					<form action="#" method="POST">

						<div class="my-3">
							<p>Choisissez une date de retrait</p>
<!-- DANS LA PROPRIETE VALUE, INSERER LES DATES EN FORMAT DATETIME-->
							<input type="radio" name="dateChoice" id="jourCourant" class="btn btnCart text-white mx-3" value="<?= $jourmeme ?>" checked/>
							<label for="jourCourant"><?= $jourmeme ?></label>

							<input type="radio" name="dateChoice" id="jourSuivant" class="btn btnCart text-white mx-3" value="<?= $lendemain ?>" />
							<label for="jourSuivant"><?= $lendemain ?></label>

							 <button type="submit" class="btnCart btn btn-lg btn-block mt-4 mb-4 text-white" name="submit" value="envoi" >Valider mon panier</button>
							
						</div>
					</form>
				</div>
			</div>
		<?php } ?>
	</div>


	<!-- FOOTER -->
	<?php include '../footer.html'; ?>
</body>
</html>