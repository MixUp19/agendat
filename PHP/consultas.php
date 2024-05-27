<?php
function seleccionarTecnicasBoxeo($rango){
    require("conexion.php");
    $sql = "SELECT Ejid, Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND Ejid LIKE 'TB%'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarTecnicasPateo($rango){
    require("conexion.php");
    $sql = "SELECT Ejid, Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND Ejid LIKE 'TP%'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarTecnicasDefensaPersonal($rango){
    require("conexion.php");
    $sql = "SELECT Ejid, Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND Ejid LIKE 'DF%'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarTecnicasBohn($rango){
    require("conexion.php");
    $sql = "SELECT Ejid, Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND Ejid LIKE 'TBO%'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarTecnicasFormaTradicional($rango){
    require("conexion.php");
    $sql = "SELECT Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND EjTipo = 8";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarTecnicasFormaBohn($rango){
    require("conexion.php");
    $sql = "SELECT Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND EjTipo = 9";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}

function seleccionarFormaSable($rango){
    require("conexion.php");
    $sql = "SELECT Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND EjTipo = 8";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarFormaCuchillo($rango){
    require("conexion.php");
    $sql = "SELECT Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND EjTipo = 8";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarEjercicios($rango){
    require("conexion.php");
    $sql = "SELECT Ejnombre, Ejdescripcion, Ejrecurso FROM ejercicio WHERE rango <= ? AND EjTipo = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}

function seleccionarTodo($rango){
    require("conexion.php");
    $sql = "SELECT EjID, Ejnombre FROM ejercicio WHERE rango <= ? and Ejtipo not in (4,5,6,7)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rango);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarEntrenamientoPasos($entrenamiento){
    require("conexion.php");
    $sql = "select  ed.entpaso, ej.EjNombre, ej.EjRecurso, ej.ejtiempo, ej.EjDescripcion, ejTiempo from entrenamiento as e inner join entrenamientodetalle as ed ON e.entid = ed.entid inner join ejercicio as ej on ed.ejid=ej.ejid where e.entid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $entrenamiento);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function seleccionarnombreEntrenamiento($entrenamiento){
    require("conexion.php");
    $sql = "select Entnombre from entrenamiento where entid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $entrenamiento);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $result = $result->fetch_array();
    $result = $result['Entnombre'];
    $conn->close();
    return $result;
}
function seleccionarEntrenamientosAlumno($AlmID){
    require("conexion.php");
    $sql = "SELECT EntID, EntNombre FROM entrenamiento WHERE AlmID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $AlmID);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}

function seleccionarTiempo($AlmID){
    require("conexion.php");
    $sql = "SELECT AlmTiempoEntrenado FROM alumno WHERE AlmID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $AlmID);
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $result = $result->fetch_array();
    $result = $result['AlmTiempoEntrenado'];
    $conn->close();
    return $result;
}

function seleccionarEntrenamientosViejos($AlmID){
    require("conexion.php");
    $sql = "SELECT EntID, EntNombre FROM entrenamiento WHERE AlmID = ?  order by EntUltimaFecha asc limit 4";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $AlmID);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}
function listaAlumnos(){
    require("conexion.php");
    $sql = "SELECT AlmUsuario, AlmFoto, AlmTiempoEntrenado FROM alumno ORDER BY AlmTiempoEntrenado desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute(); 
    $result = $stmt->get_result(); // Obtener resultados antes de cerrar la conexión
    $conn->close();
    return $result;
}