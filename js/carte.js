const current = document.querySelector('.current')
const popup = document.querySelector('.popup')
current.addEventListener('click', function(){
  popup.classList.add('visible')
})