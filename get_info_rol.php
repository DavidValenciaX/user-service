<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario_ID'])) {
    http_response_code(401);
    echo json_encode(["message" => "No has iniciado sesión"]);
    exit();
}

function obtenerInfoRol($rol_ID, $conexion)
{
    $sql = "SELECT * FROM roles WHERE ID = $rol_ID";
    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    return $row["nombre"];
}

$usuario_rol = $_SESSION["usuario_rol"];
$rol_nombre = obtenerInfoRol($usuario_rol, $conexion);

$response = [
    "usuario_rol" => $rol_nombre
];

echo json_encode($response);