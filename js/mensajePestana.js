let tituloP = document.title

window.addEventListener('blur', () => {
    tituloP = document.title
    document.title = '¡No te vayas! ¡Vuelve! 😱' 
})

window.addEventListener('focus', () => {
    document.title = tituloP
})