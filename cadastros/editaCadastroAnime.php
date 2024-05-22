<?php
require_once '../backend/classes/Selecao.php';
session_start();
session_destroy();

// Verifique se o ID do anime foi fornecido na URL
if (isset($_GET['id'])) {
  $anime_id = $_GET['id'];

  $busca = new Selecao();

  // Recuperar os dados do anime com base no ID
  $resultado = $busca->selecionarAnimePorID($anime_id);
  $resultadoGeneros = $busca->selecionarGeneros();

  if ($resultado === false) {
    echo "Erro ao selecionar o anime.";
    exit;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/anitubeCad.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Cadastro</title>
</head>

<body>


  <main class="container displayFlex" id="editaAnimes<?= $resultado['idanime']; ?>">
    <div class="wrapper displayFlex">
      <form class="form" method="post" action="../backend/controller/atualizaAnime.php" enctype="multipart/form-data">
        <input type="text" id="tituloAnimeEdit" name="tituloAnimeEdit" value="<?= $resultado['nomeanime']; ?>" placeholder="Titulo">
        <select id="generoAnimeEdit" name="generoAnimeEdit">
          <option selected>Selecione o gênero</option>
          <?php foreach ($resultadoGeneros as $genero) { ?>
            <option value="<?= $genero['idgenero']; ?>" <?= $resultado['genero_idgenero'] == $genero['idgenero'] ? 'selected' : ''; ?>>
              <?= $genero['genero']; ?>
            </option>
          <?php } ?>
        </select>
        <input type="text" id="sinopseAnimeEdit" name="sinopseAnimeEdit" value="<?= $resultado['sinopseanime']; ?>" placeholder="Sinopse">
        <input type="text" id="anoAnimeEdit" name="anoAnimeEdit" value="<?= $resultado['anoanime']; ?>" placeholder="Ano">
        <input type="file" id="imgAnimeEdit" name="imgAnimeEdit">
        <input type="hidden" id="idAnimeEdit" name="idAnimeEdit" value="<?= $resultado['idanime']; ?>">
        <input type="hidden" id="imgAnimeNameEdit" name="imgAnimeNameEdit" value="<?= $resultado['imganime']; ?>">
        <div class="submitWrapper displayFlex"><input type="submit" id="submitBtn"><i class="fa-solid fa-arrow-up-from-bracket submit"></i></div>
      </form>
    </div>
  </main>
</body>

</html>