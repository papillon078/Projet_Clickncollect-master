<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/item.php';
require_once '../controllers/adminItemListCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<?php include "../header.html" ?>
	<title>Partie Admin liste des produits</title>
</head>
<body>
	<?php include "../navbar.php" ?>
	<div class="container pt-3">
		<div class="row">
			<div class="col-12">
				<h2 class="ItemTitlePage">Liste des produits du catalogue</h2>
			</div>
			<div class="col-12">
				<p class="bg-success text-white text-center"><?= isset($message) ? $message : '' ?></p>
			</div>

			<!-- barre de rayon -->
			<form method="POST" class="form-inline col-6">
				<select class="form-control" name="categoryName" id="categoryName">
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
				<button class="form-control" name="categorySubmit" type="submit" value="submit">-></button>
			</form>
			<!-- barre de recherche -->
			<form method="POST" class="form-inline col-6">
				<input class="form-control sm-2" type="search" name="keywords" placeholder="Rechercher un produit" aria-label="Search">

				<button class="boutt sm-2" name="submit" type="submit" value="submit"></button>

				<button class="form-control sm-2" name="fullList" type="submit" value="reset">Retour à la liste</button>
			</form>
			<!--Fin barre de recherche -->

			<!--Tabeau des produits -->
			<div class="table-responsive">
				<table class="table-striped adminItemListTable text-center table col-12 mx-auto my-5">
					<thead class="adminItemListThead">
						<tr class="adminItemListTr">
							<th scope="col">Référence</th>
							<th scope="col">Image</th>
							<th scope="col">Désignation</th>
							<th scope="col">Catégorie</th>
							<th scope="col">Prix HT</th>
							<th scope="col">Prix TTC</th>
							<th scope="col">Stock actuel</th>
							<th scope="col">Ajuster le stock</th>
							<th scope="col">Suppression</th>
						</tr>
					</thead>
					<?php
          // foreach dans un tableau de tableau permet de choisir la colonne de la table de la BDD
					foreach ($itemList as $item) {
						?>
						<tr class="adminItemListTr">
							<td class="align-middle text-center"><a href="itemProfile.php?id=<?= $item->id ?>">
								<?= $item->reference ?>
							</a></td>
							<td class="align-middle text-center designatItemName">
								<img class="itemListImage" src="<?= $item->picture_small ?>" alt=""></td>
								<td class="align-middle text-center designatItemName"><?= $item->itemName ?></td>
								<td class="align-middle text-center designatItemName"><?= $item->categoryName ?></td>
								<td class="align-middle text-center designatItemName"><?= $item->taxe_free_price ?></td>
								<td class="align-middle text-center designatItemName"><?= round($item->taxe_free_price*$item->taxeRate, 2 )  ?></td>
								<td class="align-middle text-center designatItemName"><?= $item->stock ?></td>
								<td class="align-middle text-center">
									<form action="#" method="POST">
										
										<div class="input-group mb-3">
											<input type="number" class="inputForm form-control <?= !isset($_POST['submit']) ? '' : (	empty($item->formErrors['stock']) ? 'is-valid' : 'is-invalid'	)?>" name="stock" 
											min="-10000" 
											max="10000" aria-label="Recipient's username" aria-describedby="button-addon2">
											<div class="input-group-append">
												<button class="btn rounded adminItemListButtonAjust btn-outline-dark" type="submit" name="stockSubmit"value="envoi">Ajuster</button>
											</div>
											<div class="<?= empty($item->formErrors['stock']) ? 'valid-feedback' : 'invalid-feedback' ?>">
												<?= isset($item->formErrors['stock']) ? $item->formErrors['stock'] : 'Ce champ est correct' ?>
											</div>
										</div>



										<input type="hidden" id="itemId" name="itemId" value="<?= $item->id ?>" />
										<input type="hidden" id="itemStock" name="itemStock" value="<?= $item->stock ?>" />
										
									</form>	
								</td>
								<td class="align-middle text-center">
									<img src="../assets/img/deleteCross.png" alt="icône" data-toggle="modal" data-target="#deleteItem<?= $item->id ?>" />
								</td>
							</tr>
							<!-- modale d'affichage de la liste des commandes de l'utilisateur -->
							<div class="modal" id="deleteItem<?= $item->id ?>">
								<div class="modal-dialog">
									<div class="modal-content">

										<!-- Modal Header -->
										<div class="modal-header">
											<h2 class="modal-title"><?= $item->itemName ?></h2>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<!-- Modal body -->
										<div class="modal-body bg-secondary text-white">
											<p>Voulez-vous vraiment supprimer ce produit du catalogue ?</p>
										</div>

										<!-- Modal footer -->
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>
											<a href="itemDelete.php?id=<?= $item->id ?>" class="bg-success text-white p-2 rounded">Confirmer</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</table>
				</div>
				<div class="btn-secondary p-1 form-control col-2 text-center">
					<a href="itemCreate.php">Ajouter un produit</a>
				</div>
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
			</div>
		</div>
		<?php include '../footer.html'; ?>
	</body>
	</html>
