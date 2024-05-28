  document.addEventListener("DOMContentLoaded", function() {
    const contentTitles = document.querySelectorAll(".content-title");

    contentTitles.forEach(function(title) {
      title.addEventListener("click", function() {
        const targetId = title.getAttribute("data-target");
        const targetList = document.getElementById(targetId);
        // Calculamos la altura de la lista desplegable
        const children = targetList.children;
        let totalHeight = 0;

        for (let i = 0; i < children.length; i++) {
          totalHeight += children[i].scrollHeight*5;
        }
        const listHeight = targetList.scrollHeight+totalHeight;

        // Cambiamos la altura máxima de la lista desplegable
        if (targetList.classList.contains("active")) {
          targetList.style.maxHeight = "0px"; // Ocultamos la lista si ya está activa
        } else {
          targetList.style.maxHeight = listHeight + "px"; // Mostramos la lista si no está activa
        }

        // Cambiamos el estado de activación de la lista desplegable
        targetList.classList.toggle("active");
      });
    });

    const sublistLists = document.querySelectorAll(".sublist-list");

    sublistLists.forEach(function(sublist) {
      sublist.addEventListener("click", function(event) {
        // Detenemos la propagación del evento para evitar que se cierre la lista desplegable padre
        event.stopPropagation();

        const subcontentList = sublist.querySelector('.subcontent-list');
        
        if (subcontentList) {
          const listHeight = subcontentList.scrollHeight;

          // Cambiamos la altura máxima de la lista desplegable
          if (subcontentList.classList.contains("active")) {
            subcontentList.style.maxHeight = "0px"; // Ocultamos la lista si ya está activa
          } else {
            subcontentList.style.maxHeight = listHeight + "px"; // Mostramos la lista si no está activa
          }
          
          subcontentList.classList.toggle("active");
        }
      });
    });
  });