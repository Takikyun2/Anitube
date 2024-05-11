<?php
require_once 'conexao.php';

class Selecao
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

  function selecionarAnimes()
  {
    try {
      if (!$this->db) {
        throw new Exception("Falha na conexão com o banco de dados.");
      }

      $stmt = $this->db->prepare(
        "SELECT
        a.idanime,
        a.nomeanime,
        a.anoanime,
        a.sinopseanime,
        a.genero_idgenero,
        a.datahoraregistro,
        i.animeimgid,
        i.anime_idanime,
        i.imganime,
        g.idgenero,
        g.genero,
        g.datahoraregistro
        FROM animes a
        LEFT JOIN animeimg i ON a.idanime = i.anime_idanime
        LEFT JOIN genero g ON g.idgenero = a.genero_idgenero
        ORDER BY a.datahoraregistro desc"
      );

      if ($stmt->execute()) {
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql da função selecionarAnimes");
      }
    } catch (PDOException $erro) {
      echo "Erro" . $erro->getMessage();
    }
  }

  function selecionarAnimeUnico($search_term)
  {
    try {
      if (!$this->db) {
        throw new Exception("Falha na conexão com o banco de dados.");
      }

      $stmt = $this->db->prepare(
        "SELECT
        a.idanime,
        a.nomeanime,
        a.anoanime,
        a.sinopseanime,
        a.genero_idgenero,
        a.datahoraregistro,
        i.animeimgid,
        i.anime_idanime,
        i.imganime,
        g.idgenero,
        g.genero,
        g.datahoraregistro
        FROM animes a
        LEFT JOIN animeimg i ON a.idanime = i.anime_idanime
        LEFT JOIN genero g ON g.idgenero = a.genero_idgenero
        WHERE a.nomeanime LIKE :nomeanime"
      );

      $search_param = "%" . $search_term . "%";
      $stmt->bindParam(':nomeanime', $search_param);


      if ($stmt->execute()) {
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql da função selecionarAnimes");
      }
    } catch (PDOException $erro) {
      echo "Erro" . $erro->getMessage();
    }
  }

  function selecionarGeneros()
  {
    try {
      if (!$this->db) {
        throw new Exception("Falha na conexão com o banco de dados.");
      }

      $stmt = $this->db->prepare(
        "SELECT
        g.idgenero,
        g.genero,
        g.datahoraregistro
        FROM genero g 
        ORDER BY g.idgenero desc"
      );

      if ($stmt->execute()) {
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql da função selecionarAnimes");
      }
    } catch (PDOException $erro) {
      echo "Erro" . $erro->getMessage();
    }
  }
}
