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

    // tenta conectar com o banco de dados
    try {
      // se nao conectar ele exibe uma mensagem de erro
      if (!$this->db) {
        throw new Exception("Erro ao conectar com o banco de dados");
      }

      // inicia a transação com o banco de dados
      $this->db->beginTransaction();

      // aqui faz a query para deletar o anime e as imagens
      // Prepara e executa a query para deletar as imagens do anime
      $stmt = $this->db->prepare("DELETE FROM animeimg WHERE anime_idanime = :idAnime");
      $stmt->bindParam(':idAnime', $idAnime, PDO::PARAM_INT);
      $stmt->execute();

      // Prepara e executa a query para deletar o anime
      $stmt = $this->db->prepare("DELETE FROM animes WHERE idanime = :idAnime");
      $stmt->bindParam(':idAnime', $idAnime, PDO::PARAM_INT);
      $stmt->execute();

      // Confirma a transação
      $this->db->commit();

      return "Oke";
    } catch (PDOException $erro) {
      // Reverte a transação em caso de erro
      $this->db->rollBack();
      return "Erro ao deletar o anime: " . $erro->getMessage();
    } catch (Exception $e) {
      // Reverte a transação e trata outros tipos de exceções
      $this->db->rollBack();
      echo "Erro: " . $e->getMessage();
      return "Erro: " . $e->getMessage();
    }
  }
}
