<?php
    require("PHP/ComprobarSesion.php");
    require("PHP/consultas.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="IMGs/Logo.png">
    <link rel="stylesheet" href="CSS/menu-encabezado.css">
    <title>Document</title>
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <div class="sidebar">
        <h2>Menú</h2>
        <ul class="menu">
          <li><a href="principal.php">Inicio</a></li>
          <li><a href="entrenamientos.php">Entrenamientos</a></li>
          <li><a href="tecnics.php">Técnicas</a></li>
          <li><a href="formas.php">Formas</a></li>
          <li><a href="Ejercicio.php">Ejercicios</a></li>
          <li><a href="Ranking.php">Ranking</a></li>
          <?php if($_SESSION['AlmID']===1):?>
          <li><a href="SubirRango.php">Añadir rangos</a></li>
          <li><a href="#">Añadir tipos</a></li>
          <li><a href="FormEscuela.php">Añadir Escuelas</a></li>
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
            <img src=<?php echo $_SESSION['imagen']?> alt="Foto de perfil">
            <div class="profile-dropdown">
              <p>Usuario: <?php echo $_SESSION['AlmUsuario']; ?></p>
              <p>Rango: <?php echo seleccionarNombreRango($_SESSION['Rango']); ?></p>
              <?php if($_SESSION['AlmTiempoEntrenado']>=200):?>
              <img id="medal" src="IMGs/Medals/gold.jpg" alt="Dropdown Image">
              <p>Medalla del mes obtenida</p>
              <?php endif;?>
          </div>
          </div>
        </header>
        <div class="form-container">
    <form action="PHP/SubirTipo.php" method="post">
        <h2>Formulario</h2>
        <form id="miFormulario">
            <label for="ID">TipoID:</label>
            <input type="number" id="ID" name="ID">
            <label for="colorCinta">Tipo Nombre:</label>
            <input type="text" id="TipoNombre" name="TipoNombre">
          <button type="submit">Enviar</button>
    </form>
          </div>
    </div>
</body>
<script src="JS/menu.js"></script>
</html>