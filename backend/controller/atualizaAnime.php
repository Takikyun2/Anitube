<?php
require_once '../classes/Atualizacao.php';

// controller recebe os dados do form e trata eles previamente

$nomeAnime = $_POST['tituloAnimeEdit'];
$anoAnime = $_POST['anoAnimeEdit'];
$sinopseAnime = $_POST['sinopseAnimeEdit'];
$idGenero = $_POST['generoAnimeEdit'];
$idAnime = $_POST['idAnimeEdit'];

$animeImg = $_FILES['imgAnimeEdit'];


$dataHoraRegistro = date("Y-m-d H:i:s");

$error = array();

if ($animeImg && !empty($animeImg["name"])) {

  $tamanho = 25000000;

  if ($animeImg["size"] > $tamanho) {
    array_push($error, "O arquivo deve ter no máximo " . $tamanho . " bytes");
  }

  if (count($error) == 0) {

    preg_match("/\.(png|jpeg|jpg|jpe){1}$/i", $animeImg["name"], $ext);

    if ($ext[1] == "png" || $ext[1] == "jpeg" || $ext[1] == "jpg" || $ext[1] == "jpe") {

      $animeImgName = md5(uniqid(time())) . "." . $ext[1];

      $caminho_arquivo = "../../arquivos/banners" . $animeImgName;

      move_uploaded_file($animeImg["tmp_name"], $caminho_arquivo);
    } else {
      echo "O arquivo precisa estar no formato '.png', '.jpg', '.jpe', ou '.jpeg' e ter no maximo 20Mb.";
      exit;
    }
  }
}

$atualiza = new Atualizacao();

$resultado = $atualiza->atualizarAnime(
  $nomeAnime,
  $anoAnime,
  $sinopseAnime,
  $idGenero,
  $dataHoraRegistro,
  $animeImgName, // Se não houver nova imagem, passa uma string vazia
  $idAnime
);

header("Location: http://localhost/Anitube/paginas/home.php");
exit;
