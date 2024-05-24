<?php
  require("PHP/ComprobarSesion.php");
  require("PHP/consultas.php");
  $boxeo= seleccionarTecnicasBoxeo($_SESSION['Rango']);
  $pateo= seleccionarTecnicasPateo($_SESSION['Rango']);
  $defensa= seleccionarTecnicasDefensaPersonal($_SESSION['Rango']);
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
    <li><a href="#">Técnicas</a></li>
    <li><a href="formas.php">Formas</a></li>
    <li><a href="Ejercicio.php">Ejercicios</a></li>
    <li><a href="#">Defensas</a></li>
    <li><a href="#">Ranking</a></li>
    <?php if($_SESSION['AlmID']===1):?>
    <li><a href="SubirRango.html">Añadir rangos</a></li>
    <li><a href="SubirTipos.html">Añadir tipos</a></li>
    <li><a href="FormEscuela.html">Añadir Escuelas</a></li>
    <li><a href="FormEjericio.php">Añadir ejercicios</a></li>
    <li><a href="FormAlumnos.php">Añadir Alumnos</a></li>
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
    <h2 class="content-title" data-target="content-1">Técnicas de Boxeo</h2>
    <ul class="content-list" id="content-1">
      <?php
      $numero=0;
      while($row = $boxeo->fetch_assoc()) {
        if($numero%5==0){
          echo "<li class ='sublist-list'>Tecnicas de ". $numero+1 ."- ". $numero+5 ."<ul class ='subcontent-list'>";
        }
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
        if($numero%5==4){
          echo "</ul></li>";
        }
        $numero++;
      }

      ?>
    </ul>
  </div>
  
  <div class="content">
    <h2 class="content-title" data-target="content-2">Técnicas de pateo</h2>
    <ul class="content-list" id="content-2">
    <?php
      $numero=0;
      while($row = $pateo->fetch_assoc()) {
        if($numero%5==0){
          echo "<li class ='sublist-list'>Tecnicas de ". $numero+1 ."- ". $numero+5 ."<ul class ='subcontent-list'>";
        }
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
        if($numero%5==4){
          echo "</ul></li>";
        }
        $numero++;
      }

      ?>
    </ul>
  </div>
  <div class="content">
    <h2 class="content-title" data-target="content-3">Técnicas de defensa personal</h2>
    <ul class="content-list" id="content-3">
    <?php
      $numero=0;
      while($row = $defensa->fetch_assoc()) {
        if($numero%5==0){
          echo "<li class ='sublist-list'>Tecnicas de ". $numero+1 ."- ". $numero+5 ."<ul class ='subcontent-list'>";
        }
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
        if($numero%5==4){
          echo "</ul></li>";
        }
        $numero++;
      }

      ?>
    </ul>
  </div>

  <?php
    echo "<div class='content'> <h2 class='content-title' data-target='content-4'>Técnicas de Bohn</h2>
    <ul class='content-list' id='content-4'>";
    $numero=0;
      while($row = $defensa->fetch_assoc()) {
        if($numero%5==0){
          echo "<li class ='sublist-list'>Tecnicas de ". $numero+1 ."- ". $numero+5 ."<ul class ='subcontent-list'>";
        }
        echo "<li class='element-list' onclick='openModal(\"" . $row["Ejnombre"] . "\", \"" . $row["Ejdescripcion"] . "\", \"" . $row["Ejrecurso"] . "\")'>" . $row["Ejnombre"] . "</li>";
        if($numero%5==4){
          echo "</ul></li>";
        }
        $numero++;
      }
      echo "</ul></div>"
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