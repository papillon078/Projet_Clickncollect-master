<?php

class User extends Database {

  // attributs
  // (seront utilisés lorsque l'on récuperera des données à partir de formulaires)
  public $id;
  public $civility;
  public $lastname;
  public $firstname;
  public $birthDate;
  public $phoneNumber;
  public $email;
  public $password;
  public $adressNumber;
  public $appartmentNumber;
  public $adress;
  public $postalCode;
  public $city;
  public $registrationDate;
  public $loyaltyCard = 2;
  public $idRoles = 1984;
  public $clientNumber;
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
  * méthode permettant d'insérer un nouveau client dans la base de données
  * @return boolean
  * TRUE si succès FALSE si echec
  */
public function addUser() {

    //definition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
  $query = "INSERT INTO `ll7882_users` (`email`, `password`, `client_number`, `loyalty_card`, `id_ll7882_roles`)
  VALUES
  (:email, :password, :client_number, :loyalty_card, :id_ll7882_roles)";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  
  $result->bindValue(':email', $this->email, PDO::PARAM_STR);
  $result->bindValue(':password', $this->password, PDO::PARAM_STR);
  $result->bindValue(':client_number', $this->clientNumber, PDO::PARAM_STR);
  $result->bindValue(':loyalty_card', $this->loyaltyCard, PDO::PARAM_INT);
  $result->bindValue(':id_ll7882_roles', $this->idRoles, PDO::PARAM_INT);
    // execution de la requete (execute se fait tjs avec prepare)
  try {

      // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode addUser(ctrl)
    return $result->execute();
  }
    //bloc catch de renvoi des erreurs
  catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

 /**
  * méthode permettant de vérifier que le mail n'est pas déja utilisé par un autre membre
  * @return boolean
  */
 public function hasUniqueMail() {

    // définition de la requête sql
  $query = "SELECT `id`, `email` FROM `ll7882_users` WHERE `email` = :email";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':email', $this->email, PDO::PARAM_STR);
  try {
    $result->execute();
    $check = $result->fetch(PDO::FETCH_OBJ);
  } catch (Exception $e) {
    die('echec de la connexion :' . $e->getMessage());
  }
    // vérification que le mail existe déjà ET que l'ID ne correspond pas au membre que l'on est en train de modifier
  if (is_object($check) && $check->id != $this->id) {
    return FALSE;
  } else {
    return TRUE;
  }
}



/**
* méthode permettant de mettre à jour le profil d'un utilisateur qui vient de s'inscrire
* @return boolean
*/
    public function updateUser() {

        try {

     // définition de la requête sql
    $query = "  UPDATE  `ll7882_users`
                SET     `id_ll7882_civilities` = :civility,
                        `lastname` = :lastname,
                        `firstname` = :firstname,
                        `birth_date` = :birth_date, 
                        `phone_number` = :phone_number,
                        `adress_number` = :adress_number,
                        `adress` = :adress,
                        `appartment_number` = :appartment_number,
                        `postal_code` = :postal_code,
                        `city` = :city    
                WHERE  `email` = :email";

    // preparation de la requete au serveur de bdd
    $result = $this->db->prepare($query);

   // association des marqueurs nommées aux véritables informations
    $result->bindValue(':civility', $this->civility, PDO::PARAM_INT);
    $result->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
    $result->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
    $result->bindValue(':birth_date', $this->birthDate, PDO::PARAM_STR);
    $result->bindValue(':email', $this->email, PDO::PARAM_STR);
    $result->bindValue(':phone_number', $this->phoneNumber, PDO::PARAM_INT);
    $result->bindValue(':adress_number', $this->adressNumber, PDO::PARAM_INT);
    $result->bindValue(':adress', $this->adress, PDO::PARAM_STR);
    $result->bindValue(':appartment_number', $this->appartmentNumber, PDO::PARAM_INT);
    $result->bindValue(':postal_code', $this->postalCode, PDO::PARAM_INT);
    $result->bindValue(':city', $this->city, PDO::PARAM_STR);

  // execution de la requete
  // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode updateUser(ctrl)
    return $result->execute();
  }

  //bloc catch de renvoi des erreurs
  catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}



/**
  * méthode qui renvoie le mot de passe et l'id correspondant au mail renseigné
  * @return array
  */
public function getUserPassword() {

    // définition de la requête sql
  $query = "SELECT `id`, `id_ll7882_roles`, `password`, `email`, `lastname`, `firstname`
  FROM `ll7882_users`
  WHERE `email` = :email";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':email', $this->email, PDO::PARAM_STR);
  try {
    $result->execute();
    return $result->fetch(PDO::FETCH_OBJ);
  } catch (Exception $e) {
    die('echec de la connexion :' . $e->getMessage());
  }
}

/**
  * méthode permettant de récupérer le profil de l'utilisateur
  * @return array
  */
public function getUserProfile() {

    // définition de la requête sql
  $query = "SELECT `ll7882_users`.`id`, `ll7882_civilities`.`name` AS `civility`, `lastname`, `firstname`, `birth_date`, DATE_FORMAT(`birth_date`, '%e/%m/%Y') AS `birthDate`, `email`, `password`, `phone_number`, `adress_number`, `adress`, `appartment_number`, `postal_code`, `city`, `client_number`, `registration_date`, DATE_FORMAT(`registration_date`, '%e/%m/%Y') AS `dateFR`, `loyalty_card`
  FROM `ll7882_users`
  INNER JOIN `ll7882_civilities`
  ON `ll7882_civilities`.`id` = `ll7882_users`.`id_ll7882_civilities`
  WHERE `ll7882_users`.`id` = :id";
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
     * méthode permettant de mettre à jour le profil complet d'un utilisateur
     * @return boolean
     */
public function updateFullUser() {

  try {

    // définition de la requête sql
   $query = "  UPDATE  `ll7882_users`
   SET  `id_ll7882_civilities` = :civility, 
   `lastname` = :lastname,
   `birth_date` = :birth_date, 
   `firstname` = :firstname,
   `email` = :email,
   `phone_number` = :phone_number,
   `adress_number` = :adress_number,
   `adress` = :adress,
   `appartment_number` = :appartment_number,
   `postal_code` = :postal_code,
   `city` = :city,     
   `password` = :password
   WHERE   `id` = :id";

            // preparation de la requete au serveur de bdd
   $result = $this->db->prepare($query);

            // association des marqueurs nommées aux véritables informations
   $result->bindValue(':id', $this->id, PDO::PARAM_INT);
   $result->bindValue(':civility', $this->civility, PDO::PARAM_INT);
   $result->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
   $result->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
   $result->bindValue(':birth_date', $this->birthDate, PDO::PARAM_STR);
   $result->bindValue(':email', $this->email, PDO::PARAM_STR);
   $result->bindValue(':password', $this->password, PDO::PARAM_STR);
   $result->bindValue(':phone_number', $this->phoneNumber, PDO::PARAM_INT);
   $result->bindValue(':adress_number', $this->adressNumber, PDO::PARAM_INT);
   $result->bindValue(':adress', $this->adress, PDO::PARAM_STR);
   $result->bindValue(':appartment_number', $this->appartmentNumber, PDO::PARAM_INT);
   $result->bindValue(':postal_code', $this->postalCode, PDO::PARAM_INT);
   $result->bindValue(':city', $this->city, PDO::PARAM_STR);
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
     * méthode permettant de mettre à jour le profil d'un utilisateur
     * excepté le mot de passe
     * @return boolean
     */
public function updateShortUser() {

  try {

            // définition de la requête sql
    $query = "  UPDATE  `ll7882_users`
    SET     `id_ll7882_civilities` = :civility,
    `lastname` = :lastname,
    `birth_date` = :birth_date, 
    `firstname` = :firstname,
    `email` = :email,
    `phone_number` = :phone_number,
    `adress_number` = :adress_number,
    `adress` = :adress,
    `appartment_number` = :appartment_number,
    `postal_code` = :postal_code,
    `city` = :city    
    WHERE   `id` = :id";

            // preparation de la requete au serveur de bdd
    $result = $this->db->prepare($query);

            // association des marqueurs nommées aux véritables informations
    $result->bindValue(':id', $this->id, PDO::PARAM_INT);
    $result->bindValue(':civility', $this->civility, PDO::PARAM_INT);
    $result->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
    $result->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
    $result->bindValue(':birth_date', $this->birthDate, PDO::PARAM_STR);
    $result->bindValue(':email', $this->email, PDO::PARAM_STR);
    $result->bindValue(':phone_number', $this->phoneNumber, PDO::PARAM_INT);
    $result->bindValue(':adress_number', $this->adressNumber, PDO::PARAM_INT);
    $result->bindValue(':adress', $this->adress, PDO::PARAM_STR);
    $result->bindValue(':appartment_number', $this->appartmentNumber, PDO::PARAM_INT);
    $result->bindValue(':postal_code', $this->postalCode, PDO::PARAM_INT);
    $result->bindValue(':city', $this->city, PDO::PARAM_STR);

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
 * méthode permettant de suuprimer un usager dans la base de données
 * @return boolean
 * TRUE si succès FALSE si echec
 */
public function deleteUser() {

    //définition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
  $query = 'DELETE FROM `ll7882_users`
  WHERE `id` = :id';

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id', $this->id, PDO::PARAM_INT);

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

/*******************************************************************************
* FONCTIONS ADMINISTRATEUR
*******************************************************************************/

/**
 * méthode permettant de récupérer le nbre d'usagers au total
 * @return integer
 */
public function getUserNumber() {

    //definition de la requete SQL
  $query = "SELECT COUNT(*)
  FROM `ll7882_users`
  WHERE `id_ll7882_roles` = 1984 ";

    // soumission de la requete au serveur de bdd
  $result = $this->db->query($query);

    // recuperation de la liste des usagers sous forme d'un tableau d'objets
  return $result->fetchColumn();
}



/**
 * méthode permettant de récupérer la liste d'un nb des membres = $lenght (pagination)
 * @return array
 */
public function getUserShortList($lenght) {

//definition de la requete SQL
  $query = "SELECT  `id`,
  `lastname`,
  `firstname`, 
  DATE_FORMAT(`birth_date`, '%e/%m/%Y') AS `birth_date`, 
  `client_number`
  FROM `ll7882_users`
  WHERE `id_ll7882_roles` = 1984
  ORDER BY `id` DESC
  LIMIT 10 OFFSET :lenght";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommées aux véritables informations
  $result->bindValue(':lenght', $lenght, PDO::PARAM_INT);

    // execution de la requete
  $result->execute();

    // recuperation de la liste des membres sous forme d'un tableau d'objets
  return $result->fetchall(PDO::FETCH_OBJ);
}


/**
 * méthode permettant de récupérer la liste de membres correspondant à la recherche
 * @return array
 */
public function getSearchList($search, $lenght) {

    // définition de la requête sql
  $query = "SELECT `id`,
  `lastname`,
  `firstname`,
  DATE_FORMAT(`birth_date`, '%e/%m/%Y') AS `birth_date`, 
  `client_number`
  FROM `ll7882_users`
  WHERE `lastname` LIKE CONCAT('%', :search, '%') && `id_ll7882_roles` = 1984
  ORDER BY `id` DESC
  LIMIT 10 OFFSET :lenght";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':search', $search, PDO::PARAM_STR);
  $result->bindValue(':lenght', $lenght, PDO::PARAM_INT);

    // execution de la requete (execute se fait tjs avec prepare)
  try {

    $result->execute();
        // récupération du profil des membres sous forme d'un tableau d'objets
    return $result->fetchAll(PDO::FETCH_OBJ);
        //bloc catch de renvoi des erreurs
  } catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

/**
 * méthode permettant de récupérer le nbr de membres correspondant à la recherche
 * @return integer
 */
public function getSearchResultNumber($search) {

    // définition de la requête sql
  $query = "SELECT COUNT(*) AS `rowNumber`
  FROM `ll7882_users`
  WHERE `lastname` LIKE CONCAT('%', :search, '%')";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':search', $search, PDO::PARAM_STR);

    // execution de la requete (execute se fait tjs avec prepare)
  try {

    $result->execute();
        // récupération de la liste des usagers recherchés sous forme d'un tableau d'objets
    return $result->fetchColumn();
        //bloc catch de renvoi des erreurs
  } catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

















}