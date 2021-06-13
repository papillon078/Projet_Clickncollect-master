<?php
class Item extends Database {
  // attributs
  // (seront utilisés lorsque l'on récupèrera des données à partir de formulaires)
  // les attributs suivants correspondent aux colonnes de la table item
  public $id;
  public $reference;
  public $name;
  public $smallPicture;
  public $largePicture;
  public $description;
  public $taxeFreePrice;
  public $stock = 0;
  public $weight;
  public $size;
  public $categories;
  public $packagings;
  public $taxes;
  public $menus;
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
* méthode permettant de récupérer le nombre de produits correspondants au ryon recherché 
* @return integer
*/
public function getLastId() {

  try {

    //definition de la requete SQL 
    $query = "SELECT MAX(id) AS `lastId`
    FROM `ll7882_items`";


            // soumission de la requête au serveur de la base de données
    $result = $this->db->prepare($query);

            // execution de la requete
    $result->execute();

            // recuperation du nombre de produits sous forme d'un nombre entier
    return $result->fetchColumn();
  } catch (PDOException $e) {
    die('erreur : ' . $e->getMessage());
  }
}






  /**
  * méthode permettant d'insérer un nouvel article dans la base de données
  * @return boolean
  * TRUE si succès FALSE si echec
  */
  public function addItem() {
    //definition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
    $query = 'INSERT INTO `ll7882_items` (
    `reference`,
    `name`, 
    `picture_small`, 
    `picture_large`, 
    `description`,
    `taxe_free_price`,
    `size`, 
    `weight`,
    `stock`,  
    `id_ll7882_packagings`, 
    `id_ll7882_categories`, 
    `id_ll7882_taxes`,
    `id_ll7882_menus`)
    VALUES
    (:reference, :name, :picture_small, :picture_large, :description, :taxe_free_price, :size, :weight, :stock, :id_ll7882_packagings, :id_ll7882_categories, :id_ll7882_taxes, :id_ll7882_menus)';
    // preparation de la requete au serveur de bdd
    $result = $this->db->prepare($query);
    // association des marqueurs nommés aux véritables informations
    $result->bindValue(':reference', $this->reference, PDO::PARAM_STR);
    $result->bindValue(':name', $this->name, PDO::PARAM_STR);
    $result->bindValue(':picture_small', $this->smallPicture, PDO::PARAM_STR);
    $result->bindValue(':picture_large', $this->largePicture, PDO::PARAM_STR);
    $result->bindValue(':description', $this->description, PDO::PARAM_STR);
    $result->bindValue(':taxe_free_price', $this->taxeFreePrice, PDO::PARAM_STR);
    $result->bindValue(':size', $this->size, PDO::PARAM_STR);
    $result->bindValue(':weight', $this->weight, PDO::PARAM_INT);
    $result->bindValue(':stock', $this->stock, PDO::PARAM_INT);
    $result->bindValue(':id_ll7882_categories', $this->categories, PDO::PARAM_INT);
    $result->bindValue(':id_ll7882_packagings', $this->packagings, PDO::PARAM_INT);
    $result->bindValue(':id_ll7882_taxes', $this->taxes, PDO::PARAM_INT);
    $result->bindValue(':id_ll7882_menus', $this->menus, PDO::PARAM_INT);
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
  * méthode permettant de récupérer un produit du catalogue
  * @return array
  */
  public function getItemProfile() {
    // définition de la requête sql
    $query = "SELECT `ll7882_items`.`id`, 
    `ll7882_items`.`reference`,
    `ll7882_items`.`name` AS `itemName`, 
    `ll7882_items`.`picture_small`, 
    `ll7882_items`.`picture_large`, 
    `ll7882_items`.`description`, 
    `ll7882_items`.`taxe_free_price`, 
    `ll7882_items`.`stock`, 
    `ll7882_items`.`weight`, 
    `ll7882_items`.`size`, 
    DATE_FORMAT(`ll7882_items`.`release_date`, '%e/%m/%Y') AS `dateFr`, 
    `ll7882_categories`.`id` AS `categoryId`,
    `ll7882_categories`.`name` AS `categoryName`, 
    `ll7882_taxes`.`rate` AS `taxeRate`, 
    `ll7882_menus`.`id` AS `menuId`,
    `ll7882_menus`.`name` AS `menuName`, 
    `ll7882_packagings`.`name` AS `packagingName`
    FROM `ll7882_items`
    INNER JOIN `ll7882_categories`
    ON `ll7882_categories`.`id` = `ll7882_items`.`id_ll7882_categories`
    INNER JOIN `ll7882_taxes`
    ON `ll7882_taxes`.`id` = `ll7882_items`.`id_ll7882_taxes`
    INNER JOIN `ll7882_menus`
    ON `ll7882_menus`.`id` = `ll7882_items`.`id_ll7882_menus`
    INNER JOIN `ll7882_packagings`
    ON `ll7882_packagings`.`id` = `ll7882_items`.`id_ll7882_packagings`
    WHERE `ll7882_items`.`id` = :id";
    // soumission de la requête au serveur de la base de données
    $result = $this->db->prepare($query);
    // association des marqueurs nommés aux véritables informations
    $result->bindValue(':id', $this->id, PDO::PARAM_INT);
    // execution de la requete (execute se fait tjs avec prepare)
    try {
      // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode ItemProfile(ctrl)
      $result->execute();
    }
    //bloc catch de renvoi des erreurs
    catch (PDOException $e) {
      die('echec de la connexion : ' . $e->getMessage());
    }
    // récupération d'un produit sous forme d'un tableau d'objets
    return $result->fetch(PDO::FETCH_OBJ);
  }



/**
     * Méthode renvoyant la catégorie du produit 
     * @return object
     */
    public function getItemCategory() {
        try {
            // définition de la requête sql
            $query = "SELECT    `name` 
                      FROM      `ll7882_categories`
                      WHERE     `id` = :id";

            // soumission de la requête au serveur de la base de données
            $result = $this->db->prepare($query);

            // association des marqueurs nommés aux véritables informations
            $result->bindValue(':id', $this->categories, PDO::PARAM_INT);

            $result->execute();

            // récupération du nom de la catégorie
            return $result->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die('erreur : ' . $e->getMessage());
        }
    }








/**
 * méthode permettant de récupérer la liste des menus
 * @return array
 */
public function getMenuList() {

//definition de la requete SQL
  $query = "SELECT  `ll7882_menus`.`id`,
  `ll7882_menus`.`name` 
  FROM `ll7882_menus`
  ";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // execution de la requete
  $result->execute();

    // récupération de la liste des menus sous forme d'un tableau d'objets
  return $result->fetchall(PDO::FETCH_OBJ);
}


/**
 * méthode permettant de récupérer la liste des catégories
 * @return array
 */
public function getCategoriesList() {

//definition de la requete SQL
  $query = "SELECT  `ll7882_categories`.`id`,
  `ll7882_categories`.`name` 
  FROM `ll7882_categories`
  ";

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // execution de la requete
  $result->execute();

    // récupération de la liste des catégories sous forme d'un tableau d'objets
  return $result->fetchall(PDO::FETCH_OBJ);
}


/**
* méthode permettant de récupérer les produits en fonction du menu
  * @return array
  */
public function getItemListByMenu() {
    // définition de la requête sql
  $query = "SELECT  `ll7882_items`.`id`,
                    `ll7882_items`.`name` AS `itemName`,
                    `ll7882_items`.`picture_small`,
                    `ll7882_items`.`weight`,
                    `ll7882_items`.`taxe_free_price`,
                    `ll7882_taxes`.`rate` AS `taxeRate`, 
                    `ll7882_packagings`.`name` AS `packagingName`
  FROM `ll7882_items`
  INNER JOIN `ll7882_taxes`
  ON `ll7882_taxes`.`id` = `ll7882_items`.`id_ll7882_taxes`
  INNER JOIN `ll7882_packagings`
  ON `ll7882_packagings`.`id` = `ll7882_items`.`id_ll7882_packagings`
  WHERE `id_ll7882_menus` = :id
  ORDER BY `id` DESC";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);
    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id', $this->menus, PDO::PARAM_INT);
    // execution de la requete (execute se fait tjs avec prepare)
  try {
      // renvoi TRUE en cas de succès sinon FALSE
    $result->execute();
  }
    //bloc catch de renvoi des erreurs
  catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
    // récupération de la liste des articles sous forme d'un tableau d'objets
  return $result->fetchAll(PDO::FETCH_OBJ);
}



/**
     * méthode permettant de mettre à jour le stock produit
     * excepté le mot de passe
     * @return boolean
     */
public function stockUpdate() {

  try {

// définition de la requête sql
    $query = "  UPDATE  `ll7882_items`
    SET     `stock` = :stock
    WHERE   `id` = :id";

// preparation de la requete au serveur de bdd
    $result = $this->db->prepare($query);

            // association des marqueurs nommées aux véritables informations
    $result->bindValue(':id', $this->id, PDO::PARAM_INT);
    $result->bindValue(':stock', $this->stock, PDO::PARAM_INT);
  

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
 * méthode permettant de supprimer un produit dans la base de données
 * @return boolean
 * TRUE si succès FALSE si echec
 */
public function deleteItem() {

    //définition de la requete SQL avec des marqueurs nommés pour éviter l'injection de code SQL
  $query = 'DELETE FROM `ll7882_items`
  WHERE `id` = :id';

    // preparation de la requete au serveur de bdd
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':id', $this->id, PDO::PARAM_INT);

    // execution de la requete (execute se fait tjs avec prepare)
  try {
        // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode deleteItem(ctrl)
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
 * méthode permettant de récupérer le nbre de produits au total
 * @return integer
 */
public function getItemNumber() {

    //definition de la requete SQL
  $query = "SELECT COUNT(*)
  FROM `ll7882_items`";
    // soumission de la requete au serveur de bdd
  $result = $this->db->query($query);
    // recuperation de la liste des produits sous forme d'un tableau d'objets
  return $result->fetchColumn();
}



/**
 * méthode permettant de récupérer la liste d'un nb des produits = $lenght (pagination)
 * @return array
 */
public function getItemShortList($lenght) {

//definition de la requete SQL
  $query = "SELECT  `ll7882_items`.`id`,
  `ll7882_items`.`reference`,
  `ll7882_items`.`picture_small`,
  `ll7882_items`.`name` AS `itemName`,
  `ll7882_items`.`taxe_free_price`,
  `ll7882_items`.`weight`,
  `ll7882_taxes`.`rate` AS `taxeRate`,
  `ll7882_items`.`stock`, 
  `ll7882_categories`.`name` AS `categoryName`,
  `ll7882_packagings`.`name` AS `packagingName`
  FROM `ll7882_items`
  INNER JOIN `ll7882_packagings`
  ON `ll7882_packagings`.`id` = `ll7882_items`.`id_ll7882_packagings` 
  INNER JOIN `ll7882_taxes`
  ON `ll7882_taxes`.`id` = `ll7882_items`.`id_ll7882_taxes`
  INNER JOIN `ll7882_categories`
  ON `ll7882_categories`.`id` = `ll7882_items`.`id_ll7882_categories`
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
 * méthode permettant de récupérer la liste des produits correspondant à la recherche
 * @return array
 */
public function getSearchList($search, $lenght) {

    // définition de la requête sql
  $query = "SELECT  `ll7882_items`.`id`,
  `ll7882_items`.`reference`,
  `ll7882_items`.`picture_small`,
  `ll7882_items`.`name` AS `itemName`,
  `ll7882_items`.`weight`,
  `ll7882_items`.`taxe_free_price`,
  `ll7882_taxes`.`rate` AS `taxeRate`,
  `ll7882_items`.`stock`, 
  `ll7882_categories`.`name` AS `categoryName`,
  `ll7882_packagings`.`name` AS `packagingName`
  FROM `ll7882_items`
  INNER JOIN `ll7882_packagings`
  ON `ll7882_packagings`.`id` = `ll7882_items`.`id_ll7882_packagings` 
  INNER JOIN `ll7882_taxes`
  ON `ll7882_taxes`.`id` = `ll7882_items`.`id_ll7882_taxes`
  INNER JOIN `ll7882_categories`
  ON `ll7882_categories`.`id` = `ll7882_items`.`id_ll7882_categories`
  WHERE `ll7882_items`.`name` LIKE CONCAT('%', :search, '%') 
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
        // récupération du profil des produits sous forme d'un tableau d'objets
    return $result->fetchAll(PDO::FETCH_OBJ);
        //bloc catch de renvoi des erreurs
  } catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

/**
 * méthode permettant de récupérer le nbr de produits correspondant à la recherche
 * @return integer
 */
public function getSearchResultNumber($search) {

    // définition de la requête sql
  $query = "SELECT COUNT(*) AS `rowNumber`
  FROM `ll7882_items`
  WHERE `ll7882_items`.`name` LIKE CONCAT('%', :search, '%')";

    // soumission de la requête au serveur de la base de données
  $result = $this->db->prepare($query);

    // association des marqueurs nommés aux véritables informations
  $result->bindValue(':search', $search, PDO::PARAM_STR);

    // execution de la requete (execute se fait tjs avec prepare)
  try {

    $result->execute();
        // récupération de la liste des produits recherchés sous forme d'un tableau d'objets
    return $result->fetchColumn();
        //bloc catch de renvoi des erreurs
  } catch (PDOException $e) {
    die('echec de la connexion : ' . $e->getMessage());
  }
}

/**
  * méthode permettant de récupérer les produits en fonction de la catégorie
  * @return array
  */
public function getItemListByCategories($lenght) {
    // définition de la requête sql
 $query = "SELECT  `ll7882_items`.`id`,
 `ll7882_items`.`reference`,
 `ll7882_items`.`picture_small`,
 `ll7882_items`.`name` AS `itemName`,
 `ll7882_items`.`stock`, 
 `ll7882_items`.`weight`,
 `ll7882_items`.`taxe_free_price`,
 `ll7882_taxes`.`rate` AS `taxeRate`,
 `ll7882_categories`.`name` AS `categoryName`,
 `ll7882_packagings`.`name` AS `packagingName`
 FROM `ll7882_items`
 INNER JOIN `ll7882_packagings`
 ON `ll7882_packagings`.`id` = `ll7882_items`.`id_ll7882_packagings` 
 INNER JOIN `ll7882_taxes`
 ON `ll7882_taxes`.`id` = `ll7882_items`.`id_ll7882_taxes`
 INNER JOIN `ll7882_categories`
 ON `ll7882_categories`.`id` = `ll7882_items`.`id_ll7882_categories`
 WHERE `id_ll7882_categories` = :id
 ORDER BY `id` DESC
 LIMIT 10 OFFSET :lenght";
    // soumission de la requête au serveur de la base de données
 $result = $this->db->prepare($query);
    // association des marqueurs nommés aux véritables informations
 $result->bindValue(':id', $this->categories, PDO::PARAM_INT);
 $result->bindValue(':lenght', $lenght, PDO::PARAM_INT);
    // execution de la requete (execute se fait tjs avec prepare)
 try {
      // renvoi TRUE en cas de succès sinon FALSE
  $result->execute();
}
    //bloc catch de renvoi des erreurs
catch (PDOException $e) {
  die('echec de la connexion : ' . $e->getMessage());
}
    // récupération de la liste des articles sous forme d'un tableau d'objets
return $result->fetchAll(PDO::FETCH_OBJ);
}

/**
* méthode permettant de récupérer le nombre de produits correspondants au ryon recherché 
* @return integer
*/
public function getCategoryResultNumber($cat) {

  try {

    //definition de la requete SQL 
    $query = "SELECT COUNT(*) AS `rowNumber`
    FROM `ll7882_items`
    WHERE `id_ll7882_categories` = :cat";


            // soumission de la requête au serveur de la base de données
    $result = $this->db->prepare($query);

            // association des marqueurs nommés aux véritables informations
    $result->bindValue(':cat', $cat, PDO::PARAM_INT);

            // execution de la requete
    $result->execute();

            // recuperation du nombre de produits sous forme d'un nombre entier
    return $result->fetchColumn();
  } catch (PDOException $e) {
    die('erreur : ' . $e->getMessage());
  }
}

























}
?>
