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
          $ID = $_POST["ID"];
          $TipoNombre = $_POST["TipoNombre"];
          $sql ="Insert into tipo(TipoID, TipoNombre) values ($ID, '$TipoNombre')";
        if(mysqli_query($conn, $sql)){
          echo "¡El formulario se ha enviado correctamente!<br>";
          echo "ID: $ID<br>";
          echo "Tipo: $TipoNombre";
        }
        else{
            echo "Error: ". $sql. mysqli_error($conn);
        }
      ?>
    </div>
    <a href="../SubirTipos.html">Volver al Formulario</a>
  </div>
</body>
</html>