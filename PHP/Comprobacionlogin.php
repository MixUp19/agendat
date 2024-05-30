<?php
require("conexion.php");

$sql = "select AlmID, AlmUsuario, AlmContrasena, Rango, Almfoto, AlmTiempoEntrenado from alumno where almcorreo= ? ";

$usuario = $_POST['txtCorreo'];
$contrasena = $_POST['txtPassword'];
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if (!$stmt) {
    $mensaje_error = "Error al preparar la consulta: " . $conn->error;
    header("Location: ../login.php?error=$mensaje_error");
    exit();
} 
if ($result->num_rows <= 0) {
    $mensaje_error = "Usuario%20no%20encontrado";
    header("Location: ../login.php?error=$mensaje_error");
    exit();
} 
$row = $result->fetch_assoc();
$almID = $row['AlmID'];
$almUsuario = $row['AlmUsuario'];
$hash_contraseña = $row['AlmContrasena'];
$rango = $row['Rango'];
$imagen = $row['Almfoto'];
$tiempo = $row['AlmTiempoEntrenado'];
$stmt->close();
$conn->close();

if (password_verify($contrasena, $hash_contraseña)) {
    session_start();
    $_SESSION['AlmID'] = $almID;
    $_SESSION['AlmUsuario'] = $almUsuario;
    $_SESSION['Rango'] = $rango;
    $_SESSION['imagen'] = $imagen;
    $_SESSION['AlmTiempoEntrenado'] = $tiempo;
    if($tiempo>=2):
        $_SESSION['Medalla'] = 'IMGs/Medals/gold.jpg';
    endif;
    header('Location: ../principal.php');
} else {
    $mensaje_error = "Contraseña%20incorrecta";
    header("Location: ../login.php?error=$mensaje_error");
}
