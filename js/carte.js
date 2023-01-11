const current = document.querySelector('.current')
const popup = document.querySelector('.popup')
const closePopup = document.querySelector('.close-popup')
current.addEventListener('click', function(){
  popup.classList.add('visible')
})
closePopup.addEventListener('click', function(){
  popup.classList.remove('visible')
})