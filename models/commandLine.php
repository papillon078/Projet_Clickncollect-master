<?php
class CommandLine extends Database {

	public $id_ll7882_orders;
	public $id_ll7882_items;
	public $quantity;
	public $total_HT;
	public $total_TTC;

   // initialisation du tableau d'erreurs
	public $formErrors = array();
  /**
  * connexion à la base de données
  * le constructeur hérite du construct de la classe parente
  */
  public function __construct() {
  	parent::__construct();
  }
  /**
  * fermeture automatique de la connexion à la destruction de l'instance de classe
  */
  public function __destruct() {
  	parent::__destruct();
  }


/**
  * méthode permettant d'insérer une nouvelle ligne de panier dans la base de données
  * @return boolean
  * TRUE si succès FALSE si echec
  */
public function addCommandLine() {
    //definition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
	$query = 'INSERT INTO `command_line` (
	`id_ll7882_orders`,
	`id_ll7882_items`, 
	`quantity`,
	`total_HT`, 
	`total_TTC`)
	VALUES
	(:id_ll7882_orders, :id_ll7882_items, :quantity, :total_HT, :total_TTC)';
    // preparation de la requete au serveur de bdd
	$result = $this->db->prepare($query);
    // association des marqueurs nommés aux véritables informations
	$result->bindValue(':id_ll7882_orders', $this->id_ll7882_orders, PDO::PARAM_INT);
	$result->bindValue(':id_ll7882_items', $this->id_ll7882_items, PDO::PARAM_INT);
	$result->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
	$result->bindValue(':total_HT', $this->total_HT, PDO::PARAM_STR);
	$result->bindValue(':total_TTC', $this->total_TTC, PDO::PARAM_STR);

    // execution de la requete (execute se fait tjs avec prepare)
	try {
      // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode addItem(ctrl)
		return $result->execute();
	}
    //bloc catch de renvoi des erreurs
	catch (PDOException $e) {
		die('echec de la connexion : ' . $e->getMessage());
	}
}

/**
 * méthode permettant de récupérer la liste de tous les achats d'un panier client = $lenght (pagination)  
 * @return array
 */
public function getCommandLinesByOrderId() {
//definition de la requete SQL 
  $query = "SELECT  `ll7882_items`.`id` AS `itemId`,
  `ll7882_items`.`name` AS `itemName`,
  `ll7882_items`.`weight`, 
  `ll7882_items`.`picture_small`,
  `command_line`.`quantity`,
  `command_line`.`total_TTC`,
  `ll7882_packagings`.`name` AS `packagingName`
  FROM `command_line` 
  INNER JOIN `ll7882_items`
  ON `ll7882_items`.`id` = `command_line`.`id_ll7882_items`
  INNER JOIN `ll7882_packagings`
  ON `ll7882_packagings`.`id` = `ll7882_items`.`id_ll7882_packagings`
  WHERE `command_line`.`id_ll7882_orders` = :orderId";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommées aux véritables informations
  $result->bindValue(':orderId', $this->id_ll7882_orders, PDO::PARAM_INT);

    // execution de la requete
  $result->execute();

    // recuperation de la liste des membres sous forme d'un tableau d'objets
  return $result->fetchall(PDO::FETCH_OBJ);
}

/**
 * méthode permettant de verifier si un article est deja dans un panier  
 * @return boolean
 */
public function FindByOrderAndItem($orderId, $itemId) {

//definition de la requete SQL 
  $query = "SELECT  `command_line`.`quantity`
  FROM `command_line`
  WHERE `command_line`.`id_ll7882_orders` = :orderId AND `command_line`.`id_ll7882_items` = :itemId";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommées aux véritables informations
  $result->bindValue(':orderId', $orderId, PDO::PARAM_INT);
  $result->bindValue(':itemId', $itemId, PDO::PARAM_INT);

  try {
    $result->execute();
    $check = $result->fetch(PDO::FETCH_OBJ);
  } catch (Exception $e) {
    die('echec de la connexion :' . $e->getMessage());
  }
    // vérification que le mail existe déjà ET que l'ID ne correspond pas au membre que l'on est en train de modifier
  if (is_object($check)) {
    return TRUE;
  } else {
    return FALSE;
  }
}


/**
 * méthode permettant de recupérer une ligne du panier  
 * @return boolean
 */
public function getCommandLine($orderId, $itemId) {
//definition de la requete SQL 
  $query = "SELECT  `command_line`.`quantity`
  FROM `command_line`
  WHERE `command_line`.`id_ll7882_orders` = :orderId AND `command_line`.`id_ll7882_items` = :itemId";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommées aux véritables informations
  $result->bindValue(':orderId', $orderId, PDO::PARAM_INT);
  $result->bindValue(':itemId', $itemId, PDO::PARAM_INT);

  try {
    $result->execute();
    return $result->fetch(PDO::FETCH_OBJ);
  } catch (Exception $e) {
    die('echec de la connexion :' . $e->getMessage());
  }
    
}

/**
     * méthode permettant de mettre à jour la quntité d'un article au panier
     * @return boolean
     */
public function updateQuantity() {

  try {

            // définition de la requête sql
    $query = "  UPDATE  `command_line` 
                SET     `quantity` = :quantity, 
                        `total_HT` = :total_HT,
                        `total_TTC` = :total_TTC
                WHERE   `command_line`.`id_ll7882_orders` = :orderId AND `command_line`.`id_ll7882_items` = :itemId";

            // preparation de la requete au serveur de bdd
    $result = $this->db->prepare($query);

            // association des marqueurs nommées aux véritables informations
    $result->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
    $result->bindValue(':total_HT', $this->total_HT, PDO::PARAM_STR);
    $result->bindValue(':total_TTC', $this->total_TTC, PDO::PARAM_STR);
    $result->bindValue(':orderId', $this->id_ll7882_orders, PDO::PARAM_INT);
    $result->bindValue(':itemId', $this->id_ll7882_items, PDO::PARAM_INT);


            // execution de la requete
            // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode addUsers(ctrl)
    return $result->execute();
  }

        //bloc catch de renvoi des erreurs
  catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

/**
 * méthode permettant de suprimer un usager dans la base de données
 * @return boolean
 * TRUE si succès FALSE si echec
 */
public function deleteCommandLine() {

    //définition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
  $query = 'DELETE FROM `command_line`
  WHERE `command_line`.`id_ll7882_orders` = :orderId AND `command_line`.`id_ll7882_items` = :itemId';

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':orderId', $this->id_ll7882_orders, PDO::PARAM_INT);
  $result->bindValue(':itemId', $this->id_ll7882_items, PDO::PARAM_INT);

    // execution de la requete (execute se fait tjs avec prepare)
  try {
        // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode deleteUser(ctrl)
    return $result->execute();
  }
    //bloc catch de renvoi des erreurs
  catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}










}