<?php
if (!isAdmin() && !isSeller() && !isClient()) {
	header('location: ../index.php');
	exit();
} else {
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_role']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_lastname']);
		unset($_SESSION['user_firstname']);
		$_SESSION['successMessage'] = 'Vous vous êtes déconnecté(e) avec succès';
		header('Location: ../index.php');
		exit;
	}
}
?>
