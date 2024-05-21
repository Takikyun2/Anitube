<?php
require_once 'conexao.php';
class Delecao
{
  private $db;

  public function __construct()
  {
    try {
      // conexao com o banco de dados
      $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->exec("set names 'utf8'");
    } catch (PDOException $erro) {
      echo "Erro ao conectar com o banco de dados: " . $erro->getMessage();
    }
  }


  function deletaAnime($idAnime)
  {

    try {
      if (!$this->db) {
        throw new Exception("Erro ao conectar com o banco de dados");
      }

      $this->db->beginTransaction();

      $stmt = $this->db->prepare("DELETE FROM animeimg WHERE anime_idanime = $idAnime");

      $stmt->execute();

      $stmt = $this->db->prepare("DELETE FROM anime WHERE idanime = $idAnime");

      $stmt->execute();

      $this->db->commit();

      return "Oke";

    } catch (PDOException $erro) {
      echo "Erro ao conectar com o banco de dados: " . $erro->getMessage();
      $this->db->rollBack();
      return "Erro" . $erro->getMessage();
    }
  }
}
