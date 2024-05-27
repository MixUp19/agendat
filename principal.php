<?php
  require("PHP/ComprobarSesion.php");
  require("PHP/consultas.php");
  $tiempo= seleccionarTiempo($_SESSION['AlmID']);
  $entrenamientos=seleccionarEntrenamientosViejos($_SESSION['AlmID'])
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMGs/Logo.png">
  <title>AgendaT</title>
  <link rel="stylesheet" href="CSS/menu-encabezado.css">
  <link rel="stylesheet" href="CSS/contenido-principal.css">
  <link rel="stylesheet" href="CSS/lists.css">
</head>
<body>


<div class="sidebar">
  <h2>Menú</h2>
  <ul class="menu">
    <li><a href="#">Inicio</a></li>
    <li><a href="entrenamientos.php">Entrenamientos</a></li>
    <li><a href="tecnics.php">Técnicas</a></li>
    <li><a href="formas.php">Formas</a></li>
    <li><a href="Ejercicio.php">Ejercicios</a></li>
    <li><a href="#">Defensas</a></li>
    <li><a href="Ranking.php">Ranking</a></li>
    <?php if($_SESSION['AlmID']===1):?>
    <li><a href="SubirRango.html">Añadir rangos</a></li>
    <li><a href="SubirTipos.html">Añadir tipos</a></li>
    <li><a href="FormEscuela.html">Añadir Escuelas</a></li>
    <li><a href="FormEjercicio.php">Añadir ejercicios</a></li>
    <li><a href="FormAlumnos.php">Añadir Alumnos</a></li>
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
      <img src=" <?php echo $_SESSION['imagen'] ?> " alt="Foto de perfil">
    </div>
  </header>

  <div class="progress-container">
    <div class="progress-bar">
      <div class="progress" style="width:<?php echo ($tiempo/200)*100 ?>%"></div>
    </div>
    <p class="progress-text"><?php echo $tiempo?> minutos entrenados</p>
  </div>

  <div class="content">
    <?php
      while($row = $entrenamientos->fetch_assoc()) {
       echo "<a href='sesion.php?id=".$row['EntID']."'><h2 class='content-title'>".$row['EntNombre']."</h2> </a>";
      }
      ?>
  </div>
</div>

<script src="JS/menu.js"></script>

</body>
</html>