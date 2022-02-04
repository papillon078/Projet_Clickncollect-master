<?php
class Order extends Database {

	public $id;
	public $order_date;
	public $delivery_date;
	public $total_price;
	public $id_ll7882_users;
  public $id_ll7882_status;
  public $id_ll7882_timeslot_allocations;

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
  * méthode permettant de créer un panier vide au login du client dans la base de données
  * @return boolean
  * TRUE si succès FALSE si echec
  */
public function cartCreate(){
    //definition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
  $query = 'INSERT INTO `ll7882_orders` (
  `id_ll7882_users`)
  VALUES
  (:id_ll7882_users)';
    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);
    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id_ll7882_users', $this->id_ll7882_users, PDO::PARAM_INT);

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
  * méthode permettant de récupérer l'ID du panier du client 
  * @return boolean
  */
 public function getId() {

    // définition de la requête sql
  $query = "SELECT `id` FROM `ll7882_orders` WHERE `id_ll7882_users` = :id_ll7882_users";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id_ll7882_users', $this->id_ll7882_users, PDO::PARAM_INT);
  try {
    $result->execute();
    return  $result->fetch(PDO::FETCH_OBJ);
  } catch (Exception $e) {
    die('echec de la connexion :' . $e->getMessage());
  }
}

/**
  * méthode permettant de vérifier que le client n'a pas déja un panier de créé 
  * @return boolean
  */
 public function hasUniqueCart() {

    // définition de la requête sql
  $query = "SELECT `id` FROM `ll7882_orders` WHERE `id_ll7882_users` = :id_ll7882_users";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id_ll7882_users', $this->id_ll7882_users, PDO::PARAM_STR);
  try {
    $result->execute();
    $check = $result->fetch(PDO::FETCH_OBJ);
  } catch (Exception $e) {
    die('echec de la connexion :' . $e->getMessage());
  }
    // vérification que le panier existe déjà 
  if (is_object($check)) {
    return FALSE;
  } else {
    return TRUE;
  }

}

/**
  * méthode permettant de récupérer le profil de l'utilisateur
  * @return array
  */
public function getOrder() {

    // définition de la requête sql
  $query = "SELECT  `ll7882_orders`.`id` AS `orderId`, 
                    DATE_FORMAT(`order_date`, '%e/%m/%Y') AS `orderDate`, 
                    `ll7882_status`.`name` AS `orderStatus`, 
                    `ll7882_orders`.`total_price` AS `orderTotalPrice`
                    
  FROM `ll7882_orders`
  INNER JOIN `ll7882_status`
  ON `ll7882_status`.`id` = `ll7882_orders`.`id_ll7882_status`
  WHERE `ll7882_orders`.`id_ll7882_users` = :id";
  
    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id', $this->id, PDO::PARAM_INT);

    // execution de la requete (execute se fait tjs avec prepare)
  try {

    $result->execute();
      // récupération du profil usager sous forme d'un tableau d'objets
    return $result->fetch(PDO::FETCH_OBJ);
      //bloc catch de renvoi des erreurs
  } catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

/**
* méthode permettant de mettre à jour le profil d'un utilisateur qui vient de s'inscrire
* @return boolean
*/
    public function updateOrder() {

        try {

     // définition de la requête sql
    $query = "  UPDATE  `ll7882_orders`
                SET     `order_date` = :order_date,
                        `delivery_date` = :delivery_date,
                        `total_price` = :total_price,
                        `id_ll7882_status` = :id_ll7882_status,
                        `id_ll7882_timeslot_allocations` = :id_ll7882_timeslot_allocations
                WHERE  `id_ll7882_users` = :user";

    // preparation de la requete au serveur de bdd
    $result = $this->db->prepare($query);

   // association des marqueurs nommées aux véritables informations
    $result->bindValue(':order_date', $this->order_date, PDO::PARAM_STR);
    $result->bindValue(':delivery_date', $this->delivery_date, PDO::PARAM_STR);
    $result->bindValue(':total_price', $this->total_price, PDO::PARAM_STR);
    $result->bindValue(':user', $this->id_ll7882_users, PDO::PARAM_INT);
    $result->bindValue(':id_ll7882_status', $this->id_ll7882_status, PDO::PARAM_INT);
    $result->bindValue(':id_ll7882_timeslot_allocations', $this->id_ll7882_timeslot_allocations, PDO::PARAM_INT);
    
  // execution de la requete
  // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode updateUser(ctrl)
    return $result->execute();
  }

  //bloc catch de renvoi des erreurs
  catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}






}
?>