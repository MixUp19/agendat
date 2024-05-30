<?php
require("conexion.php");
require("ComprobarSesion.php");


$data = json_decode(file_get_contents("php://input"));

$totalTime = $data->totalTime; 
$entrenamientoId = $data->entrenamientoId; 


$sql = "UPDATE entrenamiento SET EntUltimaFecha = current_timestamp() WHERE entid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $entrenamientoId);
$result = $stmt->execute();

$sql = "update alumno set almtiempoentrenado = ? + almtiempoentrenado where almid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $totalTime, $_SESSION['AlmID']);
$result = $stmt->execute();

$sql = "select Almtiempoentrenado from alumno where almid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['AlmID']);
$stmt->execute();
$result=$stmt->get_result();
$result = $result->fetch_all();
session_start();
$_SESSION['Almtiempoentrenado'] = $result['Almtiempoentrenado'];
