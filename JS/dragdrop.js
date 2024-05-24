
function mostrarModal(titulo, mensaje,error) {
    var modal = document.getElementById("respuesta-modal");
    var modalTitle = document.getElementById("modal-title");
    var modalMessage = document.getElementById("modal-message");
    var modalback = document.getElementById("back-button");
    var closemodal = document.getElementById("close-modal");

    modalTitle.innerText = titulo;
    modalMessage.innerText = mensaje;
    modal.style.display = "flex";
    if(error === 1){
        closemodal.style.display = "none";
        modalback.style.display = "flex";
    }else{
        closemodal.style.display = "flex";
        modalback.style.display = "none";
    }
}

function cerrarModal() {
    var modal = document.getElementById("respuesta-modal");
    modal.style.display = "none";
}

document.getElementsByClassName("close")[0].onclick = function() {
    cerrarModal();
}

window.onclick = function(event) {
    var modal = document.getElementById("respuesta-modal");
    if (event.target == modal) {
        cerrarModal();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const draggableList = document.getElementById('draggable-list');
    const droppableList = document.getElementById('droppable-list');


    draggableList.addEventListener('dragstart', function (event) {
        const data = JSON.stringify({texto:event.target.innerText, id: event.target.getAttribute('data-id')});
        event.dataTransfer.setData('text/plain', data);
    });

    droppableList.addEventListener('dragover', function (event) {
        event.preventDefault();
    });

    droppableList.addEventListener('dragover', function (event) {
        event.preventDefault();
    });

    droppableList.addEventListener('drop', function (event) {
        event.preventDefault();
        const data = JSON.parse(event.dataTransfer.getData('text/plain'));
        const id = event.dataTransfer.getData('text/plain');
        if(data ==="")
            return;
        const listItem = createListItem(data.texto);
        listItem.classList.add('item'); 
        listItem.setAttribute('data-id', data.id);
        droppableList.appendChild(listItem);
    });

    function createListItem(text) {
        const listItem = document.createElement('li');
        listItem.textContent = text;
        listItem.draggable = true;

        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = '&#10006;'; // Unicode del icono de basura
        deleteButton.className = 'delete-button';

        deleteButton.addEventListener('click', function () {
            listItem.remove();
        });

        listItem.appendChild(deleteButton);
        return listItem;
    }

    // Permitimos que los elementos se puedan arrastrar y reordenar
    let draggedItem = null;

    droppableList.addEventListener('dragstart', function (event) {
        draggedItem = event.target;
    });

    droppableList.addEventListener('dragover', function (event) {
        event.preventDefault();
    });

    droppableList.addEventListener('drop', function (event) {
        event.preventDefault();
        if (draggedItem !== null) {
            const dropPosition = Array.from(droppableList.children).indexOf(event.target);
            if (dropPosition !== -1) {
                droppableList.insertBefore(draggedItem, droppableList.children[dropPosition]);
            } else {
                droppableList.appendChild(draggedItem);
            }
            draggedItem = null;
        }
    });
});

function enviarLista() {
    const tituloEntrenamiento = document.getElementById('titulo-entrenamiento').value.trim();
  
    if (tituloEntrenamiento === "") {
        mostrarModal("Error", "introduzca un titulo para su entrenamiento.", 2);
      return; 
    }
    
    var elementosLista = document.getElementById("droppable-list").getElementsByTagName("li");
    var listaElementos = [];
    console.log(elementosLista.length)
    if (elementosLista.length<=0) {
        mostrarModal("Error", "introduzca ejercicios para su entrenamiento.", 2);
        return; 
      }
  
    for (var i = 0; i < elementosLista.length; i++) {
      var idElemento = elementosLista[i].getAttribute('data-id');
      listaElementos.push(idElemento);
    }
    var response;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "PHP/subirEntrenamiento.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            mostrarModal("Todo bien", "El entrenamiento se subió exitosamente", 1);
        } else {
            mostrarModal("Error", "Hubo un problema al subir el entrenamiento.", 2);
        }
      }
    };
    xhr.send(JSON.stringify({ titulo: tituloEntrenamiento, elementos: listaElementos }));
  }