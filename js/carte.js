const popup = document.querySelector('.popup')
if(!popup.classList.contains('visible')){
  const closePopup = document.querySelector('.close-popup')
  const current = document.querySelector('.current')
  current.addEventListener('click', function(){
    popup.classList.add('visible')
  })
  closePopup.addEventListener('click', function(){
    popup.classList.remove('visible')
  })
}else{
  const nextBtn = document.querySelector('.next-message')
  nextBtn.addEventListener('click', function(e){
    const currentP = document.querySelector('.current-p');
    const nextP = currentP.nextElementSibling
    if(nextP){
      e.preventDefault()
      const previousMask = document.querySelector('.mask')
      if(previousMask) previousMask.classList.remove('mask')
      currentP.classList.remove('current-p')
      nextP.classList.add('current-p')
      const mask = nextP.getAttribute('data-mask')
      if(mask){
        const maskTarget = document.querySelector(mask)
        maskTarget.classList.add('mask')
      }
    }
  })
}