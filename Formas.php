<?php
  require("PHP/ComprobarSesion.php");
  require("PHP/consultas.php");
  $formas= seleccionarTecnicasFormaTradicional($_SESSION['Rango']);
  $formasBohn= seleccionarTecnicasFormaBohn($_SESSION['Rango']);
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
    <li><a href="#">Formas</a></li>
    <li><a href="Ejercicio.php">Ejercicios</a></li>
    <li><a href="#">Defensas</a></li>
    <li><a href="Ranking.php">Ranking</a></li>
    <?php if($_SESSION['AlmID']===1):?>
    <li><a href="SubirRango.php">Añadir rangos</a></li>
    <li><a href="SubirTipos.php">Añadir tipos</a></li>
    <li><a href="FormEscuela.php">Añadir Escuelas</a></li>
    <li><a href="FormEjercicio.php">Añadir ejercicios</a></li>
    <li><a href="FormAlumno.php">Añadir Alumnos</a></li>
    <?php endif ;?>
    <li><a href="cerrarsesion.php">Cerrar Sesion</a></li>
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
      <div class="profile-dropdown">
          <p>Usuario: <?php echo $_SESSION['AlmUsuario']; ?></p>
          <p>Rango: <?php echo seleccionarNombreRango($_SESSION['Rango']); ?></p>
      </div>
    </div>
  </header>

  <div class="content">
    <h2 class="content-title" data-target="content-1">Formas tradicionales</h2>
    <ul class="content-list" id="content-1">
      <?php
      while($row = $formas->fetch_assoc()) {
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
      }

      ?>
    </ul>
  </div>
  
  <?php
    if($_SESSION['Rango']>8){
    echo "<div class='content'> <h2 class='content-title' data-target='content-2'>Formas de Bohn</h2>
    <ul class='content-list' id='content-2'>";
    $numero=0;
      while($row = $formasBohn->fetch_assoc()) {
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
      }
      echo "</ul></div>";
    }
    if($_SESSION['Rango']>15){
    echo "<div class='content'> <h2 class='content-title' data-target='content-2'>Formas de Sable</h2>
    <ul class='content-list' id='content-2'>";
    $numero=0;
      while($row = $formasBohn->fetch_assoc()) {
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
      }
      echo "</ul></div>";
    }
    if($_SESSION['Rango']>17){
      echo "<div class='content'> <h2 class='content-title' data-target='content-2'>Formas de cuchillo</h2>
      <ul class='content-list' id='content-2'>";
      $numero=0;
        while($row = $formasBohn->fetch_assoc()) {
          echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
        }
        echo "</ul></div>";
      }
  ?>
</div>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 id="modalName"></h2>
    <p id="modalDescription"></p>
    <video id="modalResource" src="" controls></video>
  </div>
</div>
<script src="JS/menu.js"></script>
<script src="JS/lists.js"></script>
<script src="JS/modal.js"></script>
</body>

</html>