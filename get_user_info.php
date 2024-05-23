<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario_ID'])) {
    http_response_code(401);
    echo json_encode(["message" => "No has iniciado sesión"]);
    exit();
}

$usuario_ID = $_SESSION["usuario_ID"];
$usuario_nombre = $_SESSION["usuario_nombre"];

$response = [
    "usuario_ID" => $usuario_ID,
    "usuario_nombre" => $usuario_nombre
];

echo json_encode($response);