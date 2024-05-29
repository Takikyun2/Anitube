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
// metodo para inserir o anime
  function inserirAnime( // como parametros ele pega as variaveis que vem do controller contendo os dados do formulario que vao ser inseridos
    $nomeAnime,
    $anoAnime,
    $sinopseAnime,
    $idGenero,
    $dataHoraRegistro,
    $animeImgName
  ) {
    try { // verifica de conectou com o banco de dados
      if (!$this->db) {
        throw new Exception("Falha na conexão com o banco de dados."); // se nao estiver conectado, ele pega o erro e exibe junto com uma mensagem
      }

      $this->db->beginTransaction(); // inicia a transação
      // intrucao sql para inserir no banco de dados,
      // no insert into em "animes" ele pega a tebela animes, entre parenteses ( seleciona as colunas da tabela que vao receber os dados ) 
      //a parte values sao os valores que vao ser inseridos, aqui esta em forma de apelido
      //o stmt tem bindparam que e uma forma mais segura de insercao no banco, os apelidos logo sao substituidos pelo valor da variavel
      $stmt = $this->db->prepare("INSERT INTO animes (nomeanime, anoanime, sinopseanime, genero_idgenero, datahoraregistro) VALUES (:nomeanime, :anoanime, :sinopseanime, :genero_idgenero, :datahoraregistro)");
      $stmt->bindParam(':nomeanime', $nomeAnime);
      $stmt->bindParam(':anoanime', $anoAnime);
      $stmt->bindParam(':sinopseanime', $sinopseAnime);
      $stmt->bindParam(':genero_idgenero', $idGenero);
      $stmt->bindParam(':datahoraregistro', $dataHoraRegistro);

      $stmt->execute(); // executa a instrucao

      $anime_id = $this->db->lastInsertId(); // pega o ultimo id inserido para poder inserir na tebela das imagens
      //o id do anime ta na imagem como chave estrageira para poder identificar o a imagem correta a ser atribuida ao anime

      $stmt = $this->db->prepare("INSERT INTO animeimg (imganime, anime_idanime ) VALUES (:imganime, :anime_idanime)");
      $stmt->bindParam(':imganime', $animeImgName);
      $stmt->bindParam(':anime_idanime', $anime_id);

      $stmt->execute(); // executa a instrucao

      $this->db->commit(); // confirma a transação

      return "Oke"; // se tudo der certo ele retorna o oke, caso contrario pega os erros
    } catch (PDOException $erro) {
      $this->db->rollback(); // se der erro ele desfaz a transação
      return "Erro" . $erro->getMessage(); // retorna o erro
    }
  }
}