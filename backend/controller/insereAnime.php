<?php
require_once '../classes/Insercao.php';
// o controller recebe os dados do form e trata eles previamente
// essas sao as variaveis definidas
$nomeAnime = $_POST['tituloAnime'];
$anoAnime = $_POST['anoAnime'];
$sinopseAnime = $_POST['sinopseAnime'];
$idGenero = $_POST['generoAnime'];

$animeImg = $_FILES['imgAnime'];

$dataHoraRegistro = date("Y-m-d H:i:s");

$error = array(); // array para armazenar os erros, lembrar de nao deixar o array vazio

if (!empty($animeImg["name"])) { // funcao que trata o arquivo de imagem

  $tamanho = 25000000;

  if ($animeImg["size"] > $tamanho) {
    array_push($error, "O arquivo deve ter no máximo " . $tamanho . " bytes"); // verifica o tamanho do arquivo
  }

  if (count($error) == 0) { // verifica se o array de erros esta vazio

    preg_match("/\.(png|jpeg|jpg|jpe){1}$/i", $animeImg["name"], $ext); // verifica a extensão

    if ($ext[1] == "png" || $ext[1] == "jpeg" || $ext[1] == "jpg" || $ext[1] == "jpe") { // verifica o formato

      $animeImgName = md5(uniqid(time())) . "." . $ext[1]; // gera um nome unico para o arquivo

      $caminho_arquivo = "../../arquivos/banners" . $animeImgName; // caminho para o arquivo

      move_uploaded_file($animeImg["tmp_name"], $caminho_arquivo); // move o arquivo para o caminho especificado
    } else {
      echo "O arquivo precisa estar no formato '.png', '.jpg', '.jpe', ou '.jpeg' e ter no maximo 20Mb."; // se o formato for invalido ele exibe esta mensagem
      exit;
    }
  }
}

$insere = new Insercao(); // instancia a classe

$resultado = $insere->inserirAnime( // chama a funcao de insercao e manda como parametro os dados
  $nomeAnime,
  $anoAnime,
  $sinopseAnime,
  $idGenero,
  $dataHoraRegistro,
  $animeImgName
);

header("Location: http://localhost/Anitube/paginas/home.php"); // redireciona para a pagina inicial
exit;
