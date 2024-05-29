<!DOCTYPE html>
<?php
    require("PHP/conexion.php");
    require("PHP/ComprobarSesion.php");
    require("PHP/consultas.php");
    $sql = "Select * from escuela";

    $result = $conn->query($sql);
    $sql = "Select * from rango";

    $result2 = $conn->query($sql);

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="IMGs/Logo.png">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="CSS/menu-encabezado.css">
    <title>Formulario de Registro de Alumno</title>
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
    <?php if($_SESSION['AlmID']===1):?>
    <li><a href="SubirRango.php">Añadir rangos</a></li>
    <li><a href="SubirTipos.php">Añadir tipos</a></li>
    <li><a href="FormEscuela.php">Añadir Escuelas</a></li>
    <li><a href="FormEjercicio.php">Añadir ejercicios</a></li>
    <li><a href="#">Añadir Alumnos</a></li>
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
    </div><div class="form-container">
    <form action="PHP/guardar_alumno.php" method="post">
        <h2>Registro de Nuevo Alumno</h2>
        <label for="EscID">ID de la Escuela:</label>
        <select name="EscID" id="EscID">
            <?php
             while($fila=$result->fetch_assoc()){
                    echo "<option value =". $fila['EscID'].">".$fila['EscNombre']."</option>";
                }
            ?>
        </select><br><br>

        <label for="AlmUsuario">Nombre de Usuario:</label>
        <input type="text" id="AlmUsuario" name="AlmUsuario" required><br><br>

        <label for="AlmCorreo">Correo Electrónico:</label>
        <input type="email" id="AlmCorreo" name="AlmCorreo" required><br><br>

        <label for="AlmContrasena">Contraseña:</label>
        <input type="password" id="AlmContrasena" name="AlmContrasena" required><br><br>

        <label for="Rango">Rango:</label>
        <select name="Rango" id="Rango">
            <?php
             while($fila=$result2->fetch_assoc()){
                    echo "<option value =". $fila['Rango'].">".$fila['ColorCinta']."</option>";
                }
                $conn->close();
            ?>
        </select><br><br>

        <button type="submit">Enviar</button>
    </form>
    </div>
    </div>
</body>
<script src="JS/menu.js"></script>
</html>