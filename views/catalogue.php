<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/item.php';
require_once '../controllers/catalogueCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<?php include "../header.html" ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Catalogue</title>
</head>
<body>
	<?php include "../navbar.php" ?>
	<div class="container-fluid"><!--DIV CONTAINER-->
		<div class="mt-5">
			<div class="row"><!--DIV ROW-->



				<div class="col-2 ml-5"><!--DIV DE GAUCHE-->
					<div class="card categoryCard">
						<div class="card-header text-white">Catégories</div>
						<ul class="list-group list-group-flush">
							<!-- FOREACH-->
							<?php
							foreach ($categoriesList as $item) {
								if (isset($_GET['category']) && $_GET['category'] == $item->id){
								}else{
									?>
									<li class="list-group-item">
										<a href="catalogue.php?page=1&category=<?= $item->id ?>">
											<?= $item->name ?>
										</a>
									</li>

								<?php }} ?>

							</ul>

						</div>
					</div><!--FIN DIV DE GAUCHE-->
					<div class="col-9"><!-- FIN DIV CATALOGUE-->
						<div class="row"><!--DIV ROW-->
							<div class="col-12 titleBar">
								<div class="divcategoryTitle row">
									<div class="col-6"><!--DIV RAYON-->
										<h1 class="text-center"><?= (isset($_GET['category']) && isset($itemList[0]))?  $itemList[0]->categoryName : 'Tous les produits'; ?></h1>

									</div><!--FIN DIV RAYON-->

									<div class="col-6"><!-- DIV SEARCH TRI-->

										<!-- barre de recherche -->
										<form method="POST" class="form-inline">
											<input class="form-control sm-2" type="search" name="keywords" placeholder="Rechercher un produit" aria-label="Search">

											<button class="boutt sm-2" name="submit" type="submit" value="submit"></button>

											<button class="form-control sm-2" name="fullList" type="submit" value="reset">Retour à la liste</button>
										</form>
										<!--Fin barre de recherche -->

									</div><!--FIN DIV SEARCH TRI-->	
								</div>
							</div>
							<div class="col-12 pt-3"><!-- DIV MULTI-CARTES-->
								<div class="row"><!-- DIV ROW MULTI-CARTES-->

									<!-- FOREACH-->
									<?php
									foreach ($itemList as $item) {
										?>
										<div class="col-3 py-2">
											<div class="card cardThumbCatalogue p-2"><!--DIV MULTI-CARTES-->
												<div class="topCart"><!--DIV HAUT DE CARTE-->
													<a href="itemProfile.php?id=<?= $item->id ?>">
														<h6 class="card-title"><?= $item->itemName ?></h6>
													</a>
													<p class="card-text pb-4">
														<?php if (isset($item->weight) && $item->weight > 0) { 
															if ($item->weight == 1) {
																echo 'Le '.$item->packagingName;
															} else {
																echo $item->weight.''.$item->packagingName; 
															}} else { 
																echo $item->packagingName;
															} ?>

														</p>
													</div><!--FIN DIV HAUT DE CARTE-->
													<div class="card-body"><!--DIV MULTI-CARTES BODY-->
														<a href="itemProfile.php?id=<?= $item->id ?>">
															<img src="<?= $item->picture_small ?>" class="card-img-top pb-4" alt="...">
														</a>

														<div class="row textO pt-2"><!--DIV MULTI-CARTES ROW-->
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
											</div>
										<?php } ?>
										<!-- pagination en bas du tableau -->
										<div class="col-12">
											<nav aria-label="Page navigation">
												<ul class="pagination justify-content-center">
													<?php if ($currentPageNumber !=1){ ?>
														<li class="page-item">
															<a class="page-link" href="adminItemList.php?page=<?= $currentPageNumber -1 ?>" aria-label="Previous">
																<span aria-hidden="true">&laquo;</span>
															</a>
														</li>
													<?php }
													for($i=1; $i < $totalNumber; $i++){?>
														<li class="page-item"><a class="page-link" href="adminItemList.php?page=<?= $i ?>"><?= $i ?></a></li>
													<?php } ?>
													<?php if ($currentPageNumber < $totalNumber-1){ ?>
														<li class="page-item">
															<a class="page-link" href="adminItemList.php?page=<?= $currentPageNumber +1 ?>" aria-label="Next">
																<span aria-hidden="true">&raquo;</span>
															</a>
														</li>
													<?php } ?>
												</ul>
											</nav>
										</div>

									</div><!--FIN DIV ROW MULTI-CARTES-->
								</div><!--FIN DIV MULTI-CARTES-->

							</div><!-- FIN DIV ROW-->
						</div><!-- FIN DIV CATALOGUE-->


					</div><!--FIN DIV ROW-->
				</div>
			</div><!--FIN DIV CONTAINER-->
			<?php include '../footer.html'; ?>
		</body>
		</html>