<?php
/*****************************************************************
*						CREATION DU PANIER VIDE
******************************************************************/

function cartCreate(){

	if (!isset($_SESSION['cart'])) {

		$_SESSION['cart'] = array();
		$_SESSION['cart']['itemName'] = array();
		$_SESSION['cart']['itemQuantity'] = array();
		$_SESSION['cart']['itemTFPrice'] = array();
		$_SESSION['cart']['itemTotalPrice'] = array();
		$_SESSION['cart']['lock'] = array();
		$_SESSION['cart']['taxe'] = array();
	}

	return true;

}

/*****************************************************************
*				AJOUT D'UN ARTICLE AU PANIER
******************************************************************/
function addItemToCart($itemName, $itemQuantity, $itemTFPrice){

	if (cartCreate() && !isLocked()){

		$itemPosition = array_search($itemName, $_SESSION['cart']['itemName']);

		if ($itemPosition !== false){
			
			$_SESSION['cart']['itemQuantity'][$itemPosition] += $itemQuantity;

		}else{

			array_push($_SESSION['cart']['itemName'], $itemName);
			array_push($_SESSION['cart']['itemQuantity'], $itemQuantity);
			array_push($_SESSION['cart']['itemTFPrice'], $itemTFPrice);
		}

	}else{

		$_SESSION['errorMessage'] = 'Une erreur s\'est produite, veuillez réessayer';
		header('Location: ../index.php');
		exit();

	}

}

/*****************************************************************
*				MODIFICATION DE LA QUANTITE D'ARTICLES
******************************************************************/

function itemQuantityUpdate($itemName, $itemQuantity, $itemTFPrice){

	if (cartCreate() && !isLocked()) {

		if ($itemQuantity > 0){

			$itemPosition = array_search($itemName, $_SESSION['cart']['itemName']);

			if (itemPosition !== false) {
				
				$_SESSION['cart']['itemQuantity'][$itemPosition] += $itemQuantity;
				header('Location: ../views/cart.php');
				exit();
			}else{

				$_SESSION['errorMessage'] = 'Ce produit n\'est plus dans le panier';
				header('Location: ../views/cart.php');
				exit();

			}

		}else{


			itemDeleteFromCart($itemName);

		}


	}else{

		$_SESSION['errorMessage'] = 'Une erreur s\'est produite, veuillez réessayer';
		header('Location: ../views/cart.php');
		exit();

	}

}

/*****************************************************************
*				SUPPRESSION DE L'ARTICLE DANS LE PANIER
******************************************************************/

function itemDeleteFromCart($itemName){

	if (cartCreate() && !isLocked()){
		
		$itemPosition = array_search($itemName, $_SESSION['cart']['itemName']);

		if (itemPosition !== false) {

			unset($_SESSION['cart']['itemName'][$itemPosition]);
			unset($_SESSION['cart']['itemQuantity'][$itemPosition]);
			unset($_SESSION['cart']['itemTFPrice'][$itemPosition]);
		}

	}else{

		$_SESSION['errorMessage'] = 'Une erreur s\'est produite, veuillez réessayer';
		header('Location: ../views/cart.php');
		exit();
	}
}

/*****************************************************************
*				COMPTAGE DES ARTICLES
******************************************************************/

function itemCount(){

	if (isset($_SESSION['cart'])){

		return count($_SESSION['cart']['itemName']);

	}else{

		return 0;
	}

}

/*****************************************************************
*				VERIFICATION VERROUILLAGE PANIER
******************************************************************/

function isLocked(){

	if (isset($_SESSION['cart'])){

		$lock = false;

	}else{

		$lock = true;
	}

	return $lock;

}

/*****************************************************************
*				SUPPRESSION DU PANIER
******************************************************************/
function cartDelete(){

	if (isset($_SESSION['cart'])) {
		
		unset($_SESSION['cart']);
	}
}

/*****************************************************************
*          CALCUL SOMME PAR LIGNE
******************************************************************/
function lineTotalPrice($itemName, $itemQuantity, $itemTFPrice, $taxe){

	if(cartCreate() && !isLocked()){

		if ($itemQuantity > 0){

			$itemPosition = array_search($itemName, $_SESSION['cart']['itemName']);

			if($itemPosition !== false){

				$_SESSION['cart']['itemTotalPrice'][$itemPosition] = $itemQuantity*$itemTFPrice*$taxe;

			}else{

				$_SESSION['errorMessage'] = 'Ce produit n\'est plus dans votre panier';
				header('location: ../views/cart.php');
				exit();
			}

		}else{

			itemDeleteFromCart($itemName);
		}

	}else{

		$_SESSION['errorMessage'] = 'Une erreur s\'est produite, veuillez réessayer';
		header('location: ../index.php');
		exit();
	}
}

/*****************************************************************
*          CALCUL SOMME TOTALE PANIER
******************************************************************/
function cartTotalPrice(){

	$total = 0;

	for ($i=0; $i < itemcount() ; $i++) { 

		$total += $_SESSION['cart']['itemTotalPrice'][i];
	}
	return $total;
}











