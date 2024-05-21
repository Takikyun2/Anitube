<?php
require_once '../classes/Insercao.php';

$nomeAnime = $_POST['tituloAnime'];
$anoAnime = $_POST['anoAnime'];
$sinopseAnime = $_POST['sinopseAnime'];
$idGenero = $_POST['generoAnime'];

$animeImg = $_FILES['imgAnime'];

$dataHoraRegistro = date("Y-m-d H:i:s");

$error = array();

if (!empty($animeImg["name"])) {

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

$insere = new Insercao();

$resultado = $insere->inserirAnime(
  $nomeAnime,
  $anoAnime,
  $sinopseAnime,
  $idGenero,
  $dataHoraRegistro,
  $animeImgName
);

header("Location: http://localhost/Anitube/paginas/home.php");
exit;
