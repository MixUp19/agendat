<?php
  require("PHP/ComprobarSesion.php");
  require("PHP/consultas.php");
  $ejercicios= seleccionarEjercicios($_SESSION['Rango']);
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
  <link rel="stylesheet" href="CSS/modal.css">
</head>

<body>

<div class="sidebar">
  <h2>Menú</h2>
  <ul class="menu">
    <li><a href="principal.php">Inicio</a></li>
    <li><a href="entrenamientos.php">Entrenamientos</a></li>
    <li><a href="tecnics.php">Técnicas</a></li>
    <li><a href="formas.php">Formas</a></li>
    <li><a href="#">Ejercicios</a></li>
    <li><a href="#">Defensas</a></li>
    <li><a href="Ranking.php">Ranking</a></li>
    <?php if($_SESSION['AlmID']===1):?>
    <li><a href="SubirRango.php">Añadir rangos</a></li>
    <li><a href="SubirTipos.php">Añadir tipos</a></li>
    <li><a href="FormEscuela.php">Añadir Escuelas</a></li>
    <li><a href="FormEjercicio.php">Añadir ejercicios</a></li>
    <li><a href="FormAlumno.php">Añadir Alumnos</a></li>
    <?php endif ;?>
  </ul>
</div>

<div class="main-content">
  <header>
    <button class="menu-toggle">&#9776;</button>
    <div class="logo">
      <img src="IMGs/Logo.png" alt="Logo">
      <h1>AgendaT</h1>
    </div>
    <div class="profile-picture">
      <img src=<?php echo $_SESSION['imagen']?> alt="Foto de perfil">
    </div>
  </header>

  <div class="content">
    <h2 class="content-title" data-target="content-1">Ejercicios</h2>
    <ul class="content-list" id="content-1">
      <?php
      while($row = $ejercicios->fetch_assoc()) {
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
      }

      ?>
    </ul>
  </div>
</div>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 id="modalName"></h2>
    <p id="modalDescription"></p>
    <img id="modalResource" src="">
  </div>
</div>
</body>
<script src="JS/menu.js"></script>
<script src="JS/lists.js"></script>
<script src="JS/modal.js"></script>
</html>