<?php
require_once 'conexao.php';

class Atualizacao
{
  private $db;

  public function __construct()
  {
    // conexão com o banco de dados
    try {
      $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->exec("set names 'utf8'");
    } catch (PDOException $e) {
      echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
  }

  function atualizarAnime(
    $nomeAnime,
    $anoAnime,
    $sinopseAnime,
    $idGenero,
    $dataHoraRegistro,
    $animeImgName,
    $idAnime
  ) {
    try {
      // Inicia uma transação
      if (!$this->db) {
        throw new Exception('Falha ao conectar ao banco de dados');
      }

      // Inicia uma transação
      $this->db->beginTransaction();

      // Prepara a instrução SQL para atualizar o registro do anime
      $stmt = $this->db->prepare("UPDATE animes SET
      nomeanime = :nomeanime,
      anoanime = :anoanime,
      sinopseanime = :sinopseanime,
      genero_idgenero = :idgenero,
      datahoraregistro = :datahoraregistro,
      animeimgname = :animeimgname
      WHERE idanime = :idanime");

      // Vincula os parâmetros da instrução SQL
      $stmt->bindParam(':nomeanime', $nomeAnime);
      $stmt->bindParam(':anoanime', $anoAnime);
      $stmt->bindParam(':sinopseanime', $sinopseAnime);
      $stmt->bindParam(':idgenero', $idGenero);
      $stmt->bindParam(':datahoraregistro', $dataHoraRegistro);
      $stmt->bindParam(':animeimgname', $animeImgName);
      $stmt->bindParam(':idanime', $idAnime);

      // Executa a instrução SQL
      $stmt->execute();

      // Prepara a instrução SQL para atualizar a imagem do anime
      $stmt = $this->db->prepare("UPDATE animeimg SET
      animeimg = :animeimg
      WHERE anime_idanime = :anime_idanime");

      // Vincula os parâmetros da instrução SQL
      $stmt->bindParam(':animeimg', $animeImgName);
      $stmt->bindParam(':anime_idanime', $idAnime);

      // Execute a instrução SQL
      $stmt->execute();

      // Confirma a transação
      $this->db->commit();

      return "Ok";
    } catch (PDOException $erro) {

      // Reverte a transação em caso de erro
      $this->db->rollBack();
      return "Erro: " . $erro->getMessage();
    }
  }
}
