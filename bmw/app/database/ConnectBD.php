<?php

$ERROR_CONNECT = "Ошибка подключения к базе данных";

class ConnectBD {

  private $driver = "mysql";
  private $host = "localhost";
  private $db_name = "bmv_dealership";
  private $db_user = "root";
  private $db_pass = "";
  private $charset = "utf8";
  private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

  public function connectDB(): object {
    try {
      return new PDO(
        "$this->driver:host=$this->host; dbname=$this->db_name; charset=$this->charset",
        $this->db_user, $this->db_pass, $this->options
      );
    } catch(PDOException $i) {
      die($ERROR_CONNECT);
    } 
  }
}

$connect = new ConnectBD();
$pdo = $connect->connectDB();

?>