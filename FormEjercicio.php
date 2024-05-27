<?php
    require("PHP/conexion.php");
    require("PHP/ComprobarSesion.php");
    $sql = "Select * from tipo";

    $result = $conn->query($sql);
    $sql = "Select * from rango";

    $result2 = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="IMGs/Logo.png">
    <link rel="stylesheet" href="CSS/menu-encabezado.css">
    <link rel="stylesheet" href="css/forms.css">
    <title>Formulario de Ejercicio</title>
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
    <li><a href="#">Defensas</a></li>
    <li><a href="Ranking.php">Ranking</a></li>
    <?php if($_SESSION['AlmID'] === 1): ?>
    <li><a href="SubirRango.php">Añadir rangos</a></li>
    <li><a href="SubirTipos.php">Añadir tipos</a></li>
    <li><a href="FormEscuela.php">Añadir Escuelas</a></li>
    <li><a href="#">Añadir ejercicios</a></li>
    <li><a href="FormAlumnos.php">Añadir Alumnos</a></li>
    <?php endif; ?>
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
      <img src=<?php echo $_SESSION['imagen']; ?> alt="Foto de perfil">
    </div>
  </header>
  <div class="form-container">
  <form action="PHP/insertar_ejercicio.php" method="POST" enctype="multipart/form-data">
    <h2>Formulario de Ejercicio</h2>
    <label for="recurso">Recurso:</label><br>
    <input type="file" id="recurso" name="recurso" required><br><br>

    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>

    <label for="tipo">Tipo:</label><br>
    <select id="tipo" name="tipo" required>
      <?php while($fila = $result->fetch_assoc()): ?>
        <option value="<?php echo $fila['TipoID']; ?>"><?php echo $fila['TipoNombre']; ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label for="rango">Rango:</label><br>
    <select id="rango" name="rango" required>
      <?php while($fila = $result2->fetch_assoc()): ?>
        <option value="<?php echo $fila['Rango']; ?>"><?php echo $fila['ColorCinta']; ?></option>
      <?php endwhile; ?>
      <?php $conn->close(); ?>
    </select><br><br>

    <input type="submit" value="Enviar">
  </form>
  </div>
</div>
<script src="JS/menu.js"></script>
</body>
</html>