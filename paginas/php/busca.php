<?php

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
  $animeImgName[] = $listar['imganime'];
  $idGenero[] = $listar['idgenero'];
  $generoAnime[] = $listar['genero'];
  $dataHoraRegistroGenero[] = $listar['datahoraregistro'];
}
