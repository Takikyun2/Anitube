<?php
require_once '../backend/classes/Selecao.php';
session_start();
session_destroy();

$busca = new Selecao();

$resultado = $busca->selecionarGeneros();
foreach ($resultado as $listar) {
  $idGenero[] = $listar['idgenero'];
  $generoAnime[] = $listar['genero'];
  $dataHoraRegistroGenero[] = $listar['datahoraregistro'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/anitubeCad.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Cadastro</title>
</head>

<body>
  <main class="container displayFlex">
    <div class="wrapper displayFlex">
      <form class="form" method="post" action="../backend/controller/insereAnime.php" enctype="multipart/form-data">
        <input type="text" id="tituloAnime" name="tituloAnime" placeholder="Titulo">
        <select id="generoAnime" name="generoAnime">
          <option selected>Selecione o gênero</option>
          <?php for ($i = 0; $i < count($idGenero); $i++) { ?>
            <option value="<?= $idGenero[$i]; ?>">
              <?= $generoAnime [$i]; ?>
            </option>
          <?php } ?>
        </select>
        <input type="text" id="sinopseAnime" name="sinopseAnime" placeholder="Sinopse">
        <input type="text" id="anoAnime" name="anoAnime" placeholder="Ano">
        <input type="file" id="imgAnime" name="imgAnime">
        <div class="submitWrapper displayFlex"><input type="submit" id="submitBtn"><i
            class="fa-solid fa-arrow-up-from-bracket submit"></i></div>
      </form>
    </div>
  </main>
</body>

</html>