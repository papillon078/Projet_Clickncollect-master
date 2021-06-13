<?php

class Database {

  private $serverName = SERVERNAME;
  private $bddname = BDDNAME;
  private $userName = USERNAME;
  private $password = PASSWORD;
  protected $db;

  public function __construct() {
    try {
      // On crée l'objet Connexion dans la classe PDO et la méthode __Construct établie la connexion
      $this->db = new PDO('mysql:host=' . SERVERNAME . ';dbname=' . BDDNAME . ';charset=utf8', USERNAME, PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return 'connexion ok';
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
    }
  }
  public function __destruct() {
    $this->db = null;
  }
}
?>
