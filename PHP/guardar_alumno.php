<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Procesar Formulario</title>
  <style>
    /* Estilos opcionales para mejorar la apariencia */
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .message {
      text-align: center;
      font-size: 18px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Resultado del Formulario</h2>
    <div class="message">
      <?php
      require('conexion.php');
      $EscID = $_POST['EscID'];
      $AlmUsuario = $_POST['AlmUsuario'];
      $AlmCorreo = $_POST['AlmCorreo'];
      $AlmContrasena = password_hash($_POST['AlmContrasena'], PASSWORD_DEFAULT); // Encriptar la contraseña
      $Rango = $_POST['Rango'];
      
      $sql = "INSERT INTO Alumno (EscID, AlmUsuario, AlmCorreo, AlmContrasena, Rango) VALUES ($EscID, '$AlmUsuario', '$AlmCorreo', '$AlmContrasena', $Rango)";
      
      if ($conn->query($sql)) {
          echo "Alumno guardado correctamente";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
      ?>
    </div>
    <a href="../FormAlumnos.php">Volver al Formulario</a>
  </div>
</body>
</html>