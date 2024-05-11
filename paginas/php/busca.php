<?php
require_once '../backend/classes/Selecao.php';
session_start();
session_destroy();

$busca = new Selecao();

$resultado = $busca->selecionarAnimes();

if ($resultado === false) {
  echo "Erro ao selecionar os animes.";
  exit;
}

foreach ($resultado as $listar) {
  $idAnime[] = $listar['idanime'];
  $nomeAnime[] = $listar['nomeanime'];
  $anoAnime[] = $listar['anoanime'];
  $sinopseAnime[] = $listar['sinopseanime'];
  $generoIdGenero[] = $listar['genero_idgenero'];
  $animeImgId[] = $listar['animeimgid'];
  $anime_IdAnime[] = $listar['anime_idanime'];
  $nome_arquivo[] = $listar['imganime'];
  $idGenero[] = $listar['idgenero'];
  $generoAnime[] = $listar['genero'];
  $dataHoraRegistroGenero[] = $listar['datahoraregistro'];
}


require_once './paginas/home.php';