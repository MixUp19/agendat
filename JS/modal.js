
var modal = document.getElementById("myModal");
var modalName = document.getElementById("modalName");
var modalDescription = document.getElementById("modalDescription");
var modalResource = document.getElementById("modalResource"); 
var videos = modal.querySelectorAll('video');
var tipoDeContenido;
function openModal(name, description, link) {
    modalResource.setAttribute("src", link);
    modal.style.display = "block";
    modalName.textContent = name;
    modalDescription.textContent = description;
    videos.forEach(function(video) {
        video.play();
    });
}

// Función para cerrar la ventana modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    videos.forEach(function(video) {
        video.pause();
    });
}

// Cierra la ventana modal si el usuario hace clic fuera de ella
window.onclick = function (event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}





