<?php
  require("PHP/ComprobarSesion.php");
  require("PHP/consultas.php");

  $entrenamientos = seleccionarEntrenamientosAlumno($_SESSION['AlmID']);
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
  <style>
    .floating-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: blue;
      color: white;
      border: none;
      border-radius: 25%;
      width: 50px;
      height: 50px;
      font-size: 40px;
      cursor: pointer;
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.5);
      text-align: center;
      text-decoration: none;
    }
    a {
      text-decoration: none;
    }
    .floating-button:hover {
      background-color: #2c2574;
    }
    .main-content{
      max-height: 95%;
      
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2>Menú</h2>
  <ul class="menu">
    <li><a href="principal.php">Inicio</a></li>
    <li><a href="#">Entrenamientos</a></li>
    <li><a href="tecnics.php">Técnicas</a></li>
    <li><a href="formas.php">Formas</a></li>
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
  
  <a href="CrearEntrenamiento.php" class="floating-button">&#43;</a>
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