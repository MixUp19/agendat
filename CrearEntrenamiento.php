<?php
  require("PHP/ComprobarSesion.php");
  require("PHP/consultas.php");
  $todo= seleccionarTodo($_SESSION['Rango']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMGs/Logo.png">
  <title>AgendaT</title>
  <link rel="stylesheet" href="CSS/menu-encabezado.css">
  <link rel="stylesheet" href="CSS/lists.css">
  <link rel="stylesheet" href="CSS/dragstyles.css">
</head>
<body>

<div class="main-content">
  <header>
    <a href="entrenamientos.php" class="back-arrow">← Volver</a>
    <div class="logo">
      <img src="IMGs/Logo.png" alt="Logo">
      <h1>AgendaT</h1>
    </div>
    <div class="profile-picture">
      <img src=<?php echo $_SESSION['imagen']?> alt="Foto de perfil">
    </div>
  </header>
  <div class="principal">
  <input type="text" id="titulo-entrenamiento" placeholder="Nombre entrenamiento" required>
  <div class="container">
  <div class="drop-container">
    <h2>Lista</h2>
    <ul id="droppable-list" class="droppable"></ul>
  </div>
  <div class="drag-container">
    <h2>Elementos Arrastrables</h2>
    <ul id="draggable-list" class="draggable">
      <?php
        foreach ($todo as $tecnica) {
          echo "<li class='item' draggable='true' data-id='".$tecnica["EjID"]."'>" . $tecnica["Ejnombre"] . "</li>";
        }
        if ($_SESSION['Rango']!==0){
          echo "<li class='item' draggable='true' data-id='TB'>Técnicas de boxeo</li>";
          echo "<li class='item' draggable='true' data-id='TP'>Técnicas de pateo</li>";
          echo "<li class='item' draggable='true' data-id='DF'>Técnicas de defensa personal</li>";
        }
        if ($_SESSION['Rango']>=8){
          echo "<li class='item' draggable='true' data-id='TBO'>Técnicas de Bohn</li>";
        }
      ?>
    </ul>
  </div>
  </div>
  <button id="enviar-lista" onclick="enviarLista()">Enviar Lista</button>
</div>
<div id="respuesta-modal" class="modal">
    <div class="modal-content">
      <span class="close" id="close-modal">&times;</span>
      <h2 id="modal-title"></h2>
      <p id="modal-message"></p>
      <a class="back-button" id="back-button" href="entrenamientos.php">Volver</a>
  </div>
<script src="JS/lists.js"></script>
<script src="JS/dragdrop.js"></script>

</body>
</html>