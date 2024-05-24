<?php
// Obtener los datos del cliente
$data = json_decode(file_get_contents('php://input'), true);
$titulo = $data['titulo'];
$elementos = $data['elementos'];


try {
    require('conexion.php');
    require('consultas.php');
    require("ComprobarSesion.php");

    $conn->begin_transaction();

    $stmt1 = $conn->prepare('INSERT INTO Entrenamiento(entnombre, AlmID) VALUES (?, ?)');
    $stmt1->bind_param('si', $titulo, $_SESSION['AlmID']);
    $stmt1->execute();

    $entid = $conn->insert_id;
    if ($entid == 0) {
        throw new Exception('Error al obtener el ID del entrenamiento.');
    }
    $paso =1;
    foreach ($elementos as $elemento) {
        if($elemento ==='TB'){
            $boxeo = seleccionarTecnicasBoxeo($_SESSION['Rango']);
            while($tecnica = $boxeo->fetch_assoc()){
                $stmt2 = $conn->prepare('INSERT INTO Entrenamientodetalle(entid, entpaso, Ejid) VALUES (?, ?, ?)');
                $stmt2->bind_param('iis',$entid, $paso, $tecnica['Ejid']);
                $stmt2->execute();
                $paso++;
            } 
            continue;
        }
        if($elemento ==='TP'){
            $pateo = seleccionarTecnicasPateo($_SESSION['Rango']);
            while($tecnica = $pateo->fetch_assoc()){
                $stmt2 = $conn->prepare('INSERT INTO Entrenamientodetalle(entid, entpaso, Ejid) VALUES (?, ?, ?)');
                $stmt2->bind_param('iis',$entid, $paso, $tecnica['Ejid']);
                $stmt2->execute();
                $paso++;
            }
            continue;
        }
        if($elemento ==='DF'){
            $pateo = seleccionarTecnicasDefensaPersonal($_SESSION['Rango']);
            while($tecnica = $pateo->fetch_assoc()){
                $stmt2 = $conn->prepare('INSERT INTO Entrenamientodetalle(entid, entpaso, Ejid) VALUES (?, ?, ?)');
                $stmt2->bind_param('iis',$entid, $paso, $tecnica['Ejid']);
                $stmt2->execute();
                $paso++;
            }
            continue;
        }
        if($elemento ==='TBO'){
            $pateo = seleccionarTecnicasBohn($_SESSION['Rango']);
            while($tecnica = $pateo->fetch_assoc()){
                $stmt2 = $conn->prepare('INSERT INTO Entrenamientodetalle(entid, entpaso, Ejid) VALUES (?, ?, ?)');
                $stmt2->bind_param('iis',$entid, $paso, $tecnica['Ejid']);
                $stmt2->execute();
                $paso++;
            }
            continue;
        }
        $stmt2 = $conn->prepare('INSERT INTO Entrenamientodetalle(entid, entpaso, Ejid) VALUES (?, ?, ?)');
        $stmt2->bind_param('iis',$entid, $paso, $elemento);
        echo "$entid, $paso, $elemento \n";
        $stmt2->execute();
        $paso++;
    }
    echo $paso;
    $conn->commit();
    echo json_encode(['message' => '200']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['message' => '400', 'error' => $e->getMessage()]);
}


