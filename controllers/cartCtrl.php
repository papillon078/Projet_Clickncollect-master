<?php
if (!isAdmin() && !isSeller()){
  header('location: ../index.php');
  exit();
} else {
// création d'une instance de classe item
  $commandLine = new CommandLine();
  $commandLine->id_ll7882_orders = $_SESSION['user_cart_id'];

  // appel de la méthode qui va executer la requête
  $commandLines = $commandLine->getCommandLinesByOrderId();

  // calcul du total du panier
  $total = 0;
  for($i=0; $i<count($commandLines); $i++){
    $total += $commandLines[$i]->total_TTC;
  }
  
$dateAng = date("Y-m-d");
$jour = date("l");
$joursFR = array("Dimanche", "Lundi", "Mardi", "Mercredi", "jeudi", "vendredi", "Samedi");
$moisFR = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "Décembre");

if ($jour=="Sunday"){
  $jour = date("Y-m-d", strtotime("$jour +1 day")); 
  $jourmeme = $joursFR[strftime('%w',strtotime($jour))]." ".strftime('%d',strtotime($jour))." ".$moisFR[strftime('%m',strtotime($jour))];
  echo("dateBDD ".$jour."</br>"."date affichée ".$jourmeme);
}

  

/*******************************************************************************
*  Reception des messages de succès de création ou modification des produits
******************************************************************************/
if (isset($_SESSION['successMessage'])) {
  $message = $_SESSION['successMessage'];
  unset($_SESSION['successMessage']);
}
}
?>
