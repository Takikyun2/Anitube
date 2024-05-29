<?php
require_once '../classes/Delecao.php';

// Valida e pega os dados input
if (isset($_POST['idAnimeDelete']) && is_numeric($_POST['idAnimeDelete'])) {
  $idAnime = intval($_POST['idAnimeDelete']);

  // Instancia a classe Delecao
  $deleta = new Delecao();

  // Chama o método deletaAnime que leva como parâmetro o id do anime
  $resultado = $deleta->deletaAnime($idAnime);

  // Verifica o resultado da deleção
  if ($resultado === "Oke") {
    // Redireciona para a página inicial se a deleção for bem-sucedida
    header("Location: http://localhost/Anitube/paginas/home.php");
    exit;
  } else {
    // Exibe a mensagem de erro se a deleção falhar
    echo "<script>alert('Erro: $resultado'); window.location.href = 'http://localhost/Anitube/paginas/home.php';</script>";
    exit;
  }
} else {
  echo "<script>alert('ID inválido'); window.location.href = 'http://localhost/Anitube/paginas/home.php';</script>";
  exit;
}
