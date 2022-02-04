<?php
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../models/order.php';
require_once '../controllers/userProfileCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<?php include "../header.html" ?>
	<title>Espace personnalisé</title>
</head>
<body>
	<?php include "../navbar.php" ?>
	<div class="container">
		<div class="mt-4">
			<?= isset($message) ? '<span class="successMes rounded-pill p-2">'.$message.'</span>' : '' ?>
		</div>
		<div class="row">
			<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1984) { }?>
			
			<p class="col-12 userProfileP my-3 py-4"> Bonjour <strong><?= $userProfile->firstname ?></strong>, vous êtes parmis nous depuis le <?= $userProfile->dateFR ?>.</p>
			<div class="col-4"><!-- DIV COL GAUCHE -->

				<div class="text-center">
					<p class="rounded-pill stik py-3"><strong>Mes informations</strong></p>
				</div>
				<div class="bgUserProfile text-center pb-4 pt-4 mt-4 rounded">
					<p class="col-12 userProfilePInfo"><?= $userProfile->civility.' '.$userProfile->lastname.' '.$userProfile->firstname ?></p>
					<p class="col-12 userProfilePInfo"><?= $userProfile->birthDate ?></p>
					<div class="text-left">
						<p class="col-12 userProfilePInfo">Mail : <?= $userProfile->email ?></p> 
						<p class="col-12 userProfilePInfo">Téléphone : <?= $userProfile->phone_number ?></p>
						<p class="col-12 userProfilePInfo">
							Adresse : <?= $userProfile->adress_number.' '.$userProfile->adress ?> <?php if (!empty($userProfile->appartment_number)){ ?> Appartement <?= $userProfile->appartment_number ?> <?php } ?> <?= $userProfile->postal_code.' '.$userProfile->city ?>
						</p>
						<p class="col-12 userProfilePInfo">Réduction fidélité : <?= $userProfile->loyalty_card ?> €</p>
					</div>
					<div class="col-12 py-3">
						<div class="row">
							<div class="col-6"><button type="submit" name="submit" value="Envoi" class="rounded-pill stickButt p-2"><a href="userProfileUpdate.php">Modifier</a></button></div>
							<div class="col-6"><button type="submit" name="submit" value="Envoi" class="rounded-pill stickButt p-2"><a href="userProfileDelete.php?id=<?= $_SESSION['user_id'] ?>">Supprimer</a></button></div>
						</div>
					</div>
				</div>
			</div><!-- FIN DIV COL GAUCHE-->
			<div class="col-6"><!-- DIV MILIEU -->
				<div class="text-center">
					<p class="rounded-pill stik py-3"><strong>Mes commandes</strong></p>
				</div>
				<table class="table-striped text-center table col-12 mx-auto mt-4">
					<thead>
						<tr class="userProfileTr">
							<th scope="col">N° Commande</th>
							<th scope="col">Date</th>
							<th scope="col">Statut</th>
							<th scope="col">Montant</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="col"><?= $userOrder->orderId ?></th>
							<th scope="col"><?= $userOrder->orderDate ?></th>
							<th scope="col"><?= $userOrder->orderStatus ?></th>
							<th scope="col"><?= number_format($userOrder->orderTotalPrice, $decimals = 2, "," , " " ) ?> €</th>
						</tr>
					</tbody>
				</table>
			</div><!--FIN DIV MILIEU -->
			<div class="col-2"><!--DIV DROITE PUB -->
				<img class="w-100 rounded stik" src="../assets/img/promoVertical.jpg" alt="Publicité">
			</div><!--FIN DIV DROITE PUB -->
		</div><!-- FIN DIV ROW -->
		<div class="fantom"></div>
	</div><!-- FIN DIV CONTAINER -->

<?php include "../footer.html" ?>
</body>
</html>