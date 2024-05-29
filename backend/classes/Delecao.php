<?php // abrindo a tag php
require_once 'conexao.php'; // incluindo o arquivo de conexao com o banco de dados
class Delecao // criando a classe Delecao
{
  private $db; // definindo a variável db para o banco de dados e deixando ela privada

  public function __construct() // função construct da classe
  {
    try { // tenta conectar com o banco de dados
      // conexao com o banco de dados
      $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->exec("set names 'utf8'");
    } catch (PDOException $erro) { // se nao conseguir conectar, ele pega o erro e exibe junto com uma mensagem 
      echo "Erro ao conectar com o banco de dados: " . $erro->getMessage();
    }
  }


  function deletaAnime($idAnime) // metodo para deletar os animes
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
      // Prepara e executa a query para deletar as imagens do anime - obs\ a imagem tem que ser deletada primeiro pq ela tem o id do anime como chave estrangeira
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
