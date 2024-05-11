<?php

require_once 'conexao.php';

class Insercao
{
  private $db;

  public function __construct()
  {

    try {
      // hora de conectar com o banco
      $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->exec("set names 'utf8'");
    } catch (PDOException $e) {
      //tratando o erro
      echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
    }
  }

  function inserirAnime(
    $nomeAnime,
    $anoAnime,
    $sinopseAnime,
    $idGenero,
    $dataHoraRegistro,
    $nome_arquivo
  ) {
    try {
      if (!$this->db) {
        throw new Exception("Falha na conexão com o banco de dados.");
      }

      $this->db->beginTransaction();

      $stmt = $this->db->prepare("INSERT INTO animes (nomeanime, anoanime, sinopseanime, genero_idgenero, datahoraregistro) VALUES (:nomeanime, :anoanime, :sinopseanime, :genero_idgenero, :datahoraregistro)");
      $stmt->bindParam(':nomeanime', $nomeAnime);
      $stmt->bindParam(':anoanime', $anoAnime);
      $stmt->bindParam(':sinopseanime', $sinopseAnime);
      $stmt->bindParam(':genero_idgenero', $idGenero);
      $stmt->bindParam(':datahoraregistro', $dataHoraRegistro);

      $stmt->execute();

      $anime_id = $this->db->lastInsertId();

      $stmt = $this->db->prepare("INSERT INTO animeimg (imganime, anime_idanime ) VALUES (:imganime, :anime_idanime)");
      $stmt->bindParam(':imganime', $nome_arquivo);
      $stmt->bindParam(':anime_idanime', $anime_id);

      $stmt->execute();

      $this->db->commit();

      return "Oke";
    } catch (PDOException $erro) {
      $this->db->rollback();
      return "Erro" . $erro->getMessage();
    }
  }
}