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


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/anitube.css">
  <title>Anitube</title>
</head>

<body>
  <!-- header and navbar -->

  <header class="headerContainer displayFlex">
    <nav class="navBar wrapper displayFlex">
      <div class="search">
        <div class="searchBox">
          <input class="pesquisa" list="datalistOptions" type="search" name="search" id="termoBusca" placeholder="Buscar...">
          <i class="fa-solid fa-xmark cancelBtn"></i>
        </div>
      </div>
    </nav>
  </header>

  <!-- main content -->

  <!-- script search area -->

  <script src="./js/anitubeSearch.js"></script>

  <!-- script search area -->

  <main class="animesContainer displayFlex">
    <a href="../cadastros/cadastroAnime.php"><i class="fa-solid fa-square-plus newAnime"></i></a>
    <?php if (empty($idAnime)) { ?>
      <div class="semResultados" style="margin-top: 200px; display: flex; align-items: center; justify-content: center;">
        <h1 class="fontePrincipal" style="text-shadow: 2px 3px 2px #f47521;">Sem Resultados!</h1>
        <img src="https://static.vecteezy.com/system/resources/previews/033/494/350/original/cute-chibi-girl-wearing-a-fox-hoodie-ai-generative-png.png" alt="" style="width: 200px; height: auto;">
      </div>
    <?php exit;
    } ?>
    <div class="content wrapper" id="resultadoPesquisa"></div>
    <div class="content wrapper" id="todosOsResultados">

      <!-- card do anime -->
      <?php for ($i = 0; $i < count($idAnime); $i++) { ?>
        <div class="animeBox">
          <div class="anime">
            <img src="../arquivos/banners<?= $nome_arquivo[$i]; ?>" alt="" id="imgAnime">
            <h1 class="nomeAnime fontePrincipal">
              <?= $nomeAnime[$i]; ?>
            </h1>
            <h3 class="fonteSecundaria">
              <?= $generoAnime[$i]; ?>
            </h3>
          </div>

          <div class="animeInfo">
            <h1 class="nomeAnime fontePrincipal">
              <?= $nomeAnime[$i]; ?>
            </h1>
            <h3 class="categoriaAnime fonteSecundaria"><i class="fa-solid fa-list"></i>
              <?= $generoAnime[$i]; ?>
            </h3>
            <h3 class="anoAnime fonteSecundaria"><i class="fa-solid fa-calendar"></i>
              <?= $anoAnime[$i]; ?>
            </h3>
            <div class="sinopseBox">
              <h3 class="sinopseAnime fonteSecundaria">
                <?= $sinopseAnime[$i]; ?>
              </h3>
            </div>
            <div class="icons">
              <a href="../cadastros/editaCadastroAnime.php?id=<?= $idAnime[$i]; ?>" class="editBtn"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="" class="deleteBtn"><i class="fa-solid fa-trash"></i></a>
            </div>
          </div>
        </div>
      <?php }
      ?>
    </div>
  </main>

  <!-- script area -->

  <script src="./js/anitube.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


  <script>
    $('#resultadoPesquisa').hide();
    // Função para aplicar o efeito de hover nos elementos anime
    function aplicarHover() {
      const animes = document.querySelectorAll(".anime");
      const animeInfos = document.querySelectorAll(".animeInfo");

      // Função para animação e troca nos cards de anime
      function animarElemento(anime, animeInfo) {
        anime.addEventListener('mouseover', () => {
          animeInfo.style.display = "flex";
          anime.style.display = "none";
        });

        animeInfo.addEventListener('mouseout', () => {
          animeInfo.style.display = "none";
          anime.style.display = "flex";
          anime.style.animation = "opacidade .25s";
        });
      }

      // Aplica o efeito de hover a cada par de elementos anime e animeInfo
      for (let i = 0; i < animes.length; i++) {
        animarElemento(animes[i], animeInfos[i]);
      }
    }

    // Chama a função para aplicar o efeito de hover inicialmente
    aplicarHover();

    $(document).ready(function() {
      $('#termoBusca').on('input', function() {
        var termo = $(this).val();
        console.log(termo);

        if (termo.trim() === '') {
          $('#todosOsResultados').show();
          $('#resultadoPesquisa').hide();
        } else {
          $.ajax({
            type: 'POST',
            url: './php/funcaoPesquisa.php',
            data: {
              search: termo
            },
            success: function(response) {
              $('#todosOsResultados').hide();
              $('#resultadoPesquisa').show();
              $('#resultadoPesquisa').html(response);
              // Aplica novamente o efeito de hover aos novos elementos
              aplicarHover();
            }
          })
        }
      });

      $('.cancelBtn').on('click', function() {
        // Limpe o campo de busca
        $('#termoBusca').val('');
        $('#todosOsResultados').show();
        $('#resultadoPesquisa').hide();
      });
    });
  </script>


</body>

</html>