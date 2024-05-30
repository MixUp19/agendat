<?php
require("PHP/comprobarSesion.php");
require("PHP/consultas.php");
$entrenamiento_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pasos = seleccionarEntrenamientoPasos($entrenamiento_id, $_SESSION['AlmID']);
$nombre = $pasos->fetch_array();
if($nombre==null){
    header("Location: error.html");
}
$nombre = $nombre['entnombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nombre); ?></title>
    <link rel="stylesheet" href="CSS/entrenamiento.css">
    <link rel="icon" type="image/png" href="IMGs/Logo.png">
</head>
<body>
    <div class="container">
    <button id="back-button">← Volver</button> 
        <h1><?php echo htmlspecialchars($nombre); ?></h1>
        <div id="total-timer">Total: 00:00:00</div>
        <div id="exercise-timer"></div>
        <div class="carousel">
            <div class="ejercicios-list">
                <?php foreach ($pasos as $ejercicio): ?>
                    <div class="ejercicio" data-tiempo="<?php echo htmlspecialchars($ejercicio['ejtiempo']); ?>">
                        <h3><?php echo htmlspecialchars($ejercicio['EjNombre']); ?></h3>
                        <p><?php echo htmlspecialchars($ejercicio['EjDescripcion']); ?></p>
                        <?php if (strpos($ejercicio['EjRecurso'], '.mp4') !== false): ?>
                            <video controls>
                                <source src="<?php echo htmlspecialchars($ejercicio['EjRecurso']); ?>" type="video/mp4">
                                Tu navegador no soporta la etiqueta de video.
                            </video>
                        <?php else: ?>
                            <img src="<?php echo htmlspecialchars($ejercicio['EjRecurso']); ?>" alt="<?php echo htmlspecialchars($ejercicio['EjNombre']); ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="boton-container">
        <button id="next-button" disabled>Siguiente</button>
        <button id="finish-button" disabled>Terminar</button>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="close-modal">&times;</span>
            <h2>Entrenamiento completado</h2>
            <p>Tiempo total entrenado: <span id="total-time"></span></p>
            <a href="entrenamientos.php" id="back-button">Volver</a>
        </div>
    </div>

    <div id="confirm-modal" class="modal"> <!-- Modal de confirmación añadido -->
        <div class="modal-content">
            <h2>¿Estás seguro de que quieres salir?</h2>
            <p >Si has entrenado menos de un minuto, no se guardará tu progreso. Llevas:<span id="confirm-modal-msg"></span></p>
            <button id="confirm-exit">Sí, salir</button>
            <button id="cancel-exit">No, continuar</button>
        </div>
    </div>

    <script src="JS/entrenamiento.js"></script>
</body>
</html>
