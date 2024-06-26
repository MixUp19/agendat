<?php
    require("PHP/ComprobarSesion.php");
    require("PHP/consultas.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="IMGs/Logo.png">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="CSS/menu-encabezado.css">
    <title>Formulario para Agregar Escuela</title>
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
          <li><a href="SubirTipos.php">Añadir tipos</a></li>
          <li><a href="#">Añadir Escuelas</a></li>
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
    <form action="PHP/guardar_escuela.php" method="post">
        <h2>Agregar Nueva Escuela</h2>
        <label for="EscNombre">Nombre de la Escuela:</label>
        <input type="text" id="EscNombre" name="EscNombre" required><br><br>
        <button type="submit">Enviar</button>
    </form>
    </div>
    <footer>
  <div class="footer-content">
    <p>Hazlo cada día mejor</p>
    <p>Contacto: info@agendat.com | Teléfono: +34 123 456 789</p>
  </div>
</footer>
    </div>
</body>
<script src="JS/menu.js"></script>
</html>