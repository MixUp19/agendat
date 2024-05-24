

<?php
if (isset($_GET['error'])) {
    $mensaje_error = $_GET['error'];
} else {
    $mensaje_error = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar Sesión</title>
<link rel="icon" type="image/png" href="IMGs/Logo.png">
<link rel="stylesheet" href="CSS/login.css">
</head>
<body>

<div class="login-container" id="login-container">
    <div class="login-box" id="login-box">
        <h2>Iniciar Sesión</h2>
        <?php if ($mensaje_error !== ""): ?>
        <p style="color: red;"><?php echo $mensaje_error; ?></p>
        <?php endif; ?>
        <form action="PHP/Comprobacionlogin.php" method="post">
            <input type="email" placeholder="Correo" required id="txtCorreo" name="txtCorreo"><br>
            <input type="password" placeholder="Contraseña" required id="txtPassword" name="txtPassword"><br>
            <input type="submit" value="Iniciar Sesión" id="btnlogin">
        </form>
    </div>
</div>
<script src="JS/login.js"></script>
</body>
</html>