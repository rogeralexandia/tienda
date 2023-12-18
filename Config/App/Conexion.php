<?php
class Conexion{
  private $conect;
  public function __construct()
  {
      $dsn = "pgsql:host=".HOST.";dbname=".DB;
      $options = array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
      );
      try {
          $this->conect = new PDO($dsn, USER, PASS, $options);
      } catch (PDOException $e) {
          echo "Error en la conexion".$e->getMessage();
      }
  }
  public function conect()
  {
      return $this->conect;
  }
}
?>
