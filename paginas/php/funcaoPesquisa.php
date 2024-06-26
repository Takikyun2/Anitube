<?php

require_once '../../backend/classes/Selecao.php';

$busca = new Selecao();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['search'])) {
  $search_term = $_POST['search'];

  $resultado = $busca->selecionarAnimeUnico($search_term); // chama a funcao selecionar animes unicos, e pega o termo da pesquisa, ai ele vai buscar no banco de dados de acordo com o termo da pesquisa


  if (!empty($resultado)) {

    $output = '';

    foreach ($resultado as $listar) {
      $output .= '<div class="animeBox">
                    <div class="anime">
                      <img src="../arquivos/banners' . $listar['imganime'] . '" alt="" id="imgAnime">
                      <h1 class="nomeAnime fontePrincipal">
                        ' . $listar['nomeanime'] . '
                      </h1>
                      <h3 class="fonteSecundaria">
                      ' . $listar['genero'] . '
                      </h3>
                    </div>
  
                    <div class="animeInfo">
                      <h1 class="nomeAnime fontePrincipal">
                        ' . $listar['nomeanime'] . '
                      </h1>
                      <h3 class="categoriaAnime fonteSecundaria"><i class="fa-solid fa-list"></i>
                        ' . $listar['genero'] . '
                      </h3>
                      <h3 class="anoAnime fonteSecundaria"><i class="fa-solid fa-calendar"></i>
                        ' . $listar['anoanime'] . '
                      </h3>
                      <div class="sinopseBox">
                        <h3 class="sinopseAnime fonteSecundaria">
                        ' . $listar['sinopseanime'] . '
                        </h3>
                      </div>
                      <div class="icons">
                        <a href="../cadastros/editaCadastroAnime.php?id=' . $listar['idanime'] . '" class="editBtn"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="../backend/controller/deletaAnime.php" method="POST" id="deleteForm' . $listar['idanime'] . '">
                          <input type="hidden" id="idAnimeDelete" name="idAnimeDelete" value="' . $listar['idanime'] . '">
                          <button type="submit" class="deleteBtn"><i class="fa-solid fa-trash"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>';
    }
    echo $output;
  } else {
    echo "<div class='semResultados' style='top: 36%; left: 50%; transform: translateX(-50%); position: absolute; display: flex; align-items: center; justify-content: center;'> 
    <h1 class='fontePrincipal' style='text-shadow: 2px 3px 2px #f47521;'>Sem Resultados!</h1> 
    <img src='https://static.vecteezy.com/system/resources/previews/033/494/350/original/cute-chibi-girl-wearing-a-fox-hoodie-ai-generative-png.png' alt='' style='width: 200px; height: auto;'>
    </div>";
  }
}
