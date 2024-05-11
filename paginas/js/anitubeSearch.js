const pesquisa = document.querySelector(".pesquisa")
const cancelBtn = document.querySelector(".cancelBtn")

// função para o botão de apagar o valor do input

function cancelBtnFunction() {

  if (pesquisa.value !== '') {
    cancelBtn.style.display = 'block'
  } else {
    cancelBtn.style.display = 'none'
  }

  cancelBtn.addEventListener('click', () => {
    pesquisa.value = '';
    pesquisa.blur();
    cancelBtn.style.display = 'none'
  })
}

pesquisa.addEventListener('input', cancelBtnFunction);

