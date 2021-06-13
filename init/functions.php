<?php
function debug($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	die;
}
/**
 * méthode certifiant que l'utilisateur courant est un administrateur
 * @return boolean
 */
function isAdmin() {
	if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1982) {
		$role = true;
	} else {
		$role = false;
	}
	return $role;
}

/**
 * méthode certifiant que l'utilisateur courant est un vendeur enregistré
 * @return boolean
 */
function isSeller() {
	if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1983) {
		$role = true;
	} else {
		$role = false;
	}
	return $role;
}

/**
 * méthode certifiant que l'utilisateur courant est un utilisateur enregistré
 * @return boolean
 */
function isClient() {
	if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1984) {
		$role = true;
	} else {
		$role = false;
	}
	return $role;
}

?>