const anime = document.querySelectorAll(".anime");
const animeInfo = document.querySelectorAll(".animeInfo");


// função que permite que seja aplicado a todos os elementos
// função para animação e troca nos cards de anime 

function animarElemento(animes, animeInfos) {
  animes.addEventListener('mouseover', () => {
    animeInfos.style.display = "flex";
    animes.style.display = "none";

  })

  animeInfos.addEventListener('mouseout', () => {
    animeInfos.style.display = "none";
    animes.style.display = "flex";
    animes.style.animation = "opacidade .25s"

  })
}

if (anime.length > 0 && animeInfo.length > 0) {
  anime.forEach((animes, index) => {
    animarElemento(animes, animeInfo[index]);
  });
}
