<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../controllers/adminUserListCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<?php include "../header.html" ?>
	<title>Partie Admin liste des membres</title>
</head>
<body>
	<?php include "../navbar.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="adminUserListH2">Liste des usagers</h2>
			</div>
			<div class="col-12">
				<p><?= isset($message) ? $message : '' ?></p>
			</div>

			<!-- barre de recherche -->
			<form method="POST" class="form-inline">
				<input class="form-control mr-sm-2" type="search" name="keywords" placeholder="Rechercher" aria-label="Search">
				<button class="boutt sm-2" name="submit" type="submit" value="submit"></button>
				<button class="form-control ml-2 my-2 my-sm-0" name="fullList" type="submit" value="reset">Retour à la liste</button>
			</form>
			<div class="table-responsive">
				<table class="table-striped adminUserListTable text-center table col-12 mx-auto my-5">
					<thead class="adminUserListThead">
						<tr class="adminUserListTr">
							<th scope="col">N° Client</th>
							<th scope="col">Nom</th>
							<th scope="col">Prénom</th>
							<th scope="col">Date de naissance</th>
							<th scope="col">Commandes</th>
						</tr>
					</thead>
					<?php
          // foreach dans un tableau de tableau permet de choisir la colonne de la table de la BDD
					foreach ($userList as $item) {
						?>
						<tr class="adminUserListTr">
							<td class="text-center"><a href="userProfile.php?id=<?= $item->id ?>">
								<?= $item->client_number ?></a></td>
							<td class="text-center"><?= $item->lastname ?></td>
							<td class="text-center"><?= $item->firstname ?></td>
							<td class="text-center"><?= $item->birth_date ?></td>
							<td class="text-center">
								<img src="../assets/img/commande.png" alt="icône" data-toggle="modal" data-target="#readOrder<?= $item->id ?>" />
							</td>
						</tr>
						<!-- modale d'affichage de la liste des commandes de l'utilisateur -->
						<div class="modal" id="readOrder<?= $item->id ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h2 class="modal-title"><?= $item->firstname ?></h2>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body bg-secondary text-white">

									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>
										<a href="userProfileDelete.php?id=<?= $item->id ?>" class="bg-success text-white p-2 rounded">Confirmer</a>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</table>
			</div>
			<div class="btn-danger">
				
			</div>
			<!-- pagination en bas du tableau -->
			<div class="col-12">
				<nav aria-label="Page navigation">
					<ul class="pagination justify-content-center">
						<?php if ($currentPageNumber !=1){ ?>
							<li class="page-item">
								<a class="page-link" href="adminUserList.php?page=<?= $currentPageNumber -1 ?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
						<?php }
						for($i=1; $i < $totalNumber; $i++){?>
							<li class="page-item"><a class="page-link" href="adminUserList.php?page=<?= $i ?>"><?= $i ?></a></li>
						<?php } ?>
						<?php if ($currentPageNumber < $totalNumber-1){ ?>
							<li class="page-item">
								<a class="page-link" href="adminUserList.php?page=<?= $currentPageNumber +1 ?>" aria-label="Next">
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
