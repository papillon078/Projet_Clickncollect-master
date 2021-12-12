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
  
/*******************************************************************************
*  Generation des boutons pour choisir son rendez-vous de retrait de commande
* GENERER LES DATES EN FORMAT DATETIME POUR INSERER DS LA BASE DE DONNEE
******************************************************************************/

$dateAng = date("Y-m-d");
$jour = date("l");
$joursFR = array("Dimanche", "Lundi", "Mardi", "Mercredi", "jeudi", "vendredi", "Samedi");
$moisFR = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "Décembre");

if ($jour=="Sunday"){
  $jour = date("Y-m-d", strtotime("$jour +1 day")); 
  $jourmeme = $joursFR[strftime('%w',strtotime($jour))]." ".strftime('%d',strtotime($jour))." ".$moisFR[strftime('%m',strtotime($jour))];
  $lendemain = $joursFR[strftime('%w',strtotime("$jour +1 day"))]." ".strftime('%d',strtotime("$jour +1 day"))." ".$moisFR[strftime('%m',strtotime("$jour +1 day"))];
  echo("dateBDD ".$jour."</br>"."date affichée ".$jourmeme);
}else{
  $jour = date("Y-m-d", strtotime($jour)); 
  $jourmeme = $joursFR[strftime('%w',strtotime($jour))]." ".strftime('%d',strtotime($jour))." ".$moisFR[strftime('%m',strtotime($jour))];

  if($jour=="Saturday"){
    $lendemain = $joursFR[strftime('%w',strtotime("$jour +2 day"))]." ".strftime('%d',strtotime("$jour +2 day"))." ".$moisFR[strftime('%m',strtotime("$jour +2 day"))];
  }else{
    $lendemain = $joursFR[strftime('%w',strtotime("$jour +1 day"))]." ".strftime('%d',strtotime("$jour +1 day"))." ".$moisFR[strftime('%m',strtotime("$jour +1 day"))];
  }

}

/*******************************************************************************
*  Mise a jour de la commande avec la date de retrait choisie
******************************************************************************/  
if (isset($_POST['submit'])) {
  debug($_SESSION['user_cart_id']);
  // création d'une instance de classe order
  $order = new Order();
  $order->$id_ll7882_users = $_SESSION['user_cart_id'];

  $order->$delivery_date = $_POST['dateChoice'];
  $success = $order->updateOrder();

  if (isset($success) && $success) {

    header('location: ../index.php');
    exit();
  }
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
