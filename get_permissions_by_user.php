<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario_ID'])) {
    http_response_code(401);
    echo json_encode(["message" => "No has iniciado sesión"]);
    exit();
}

function obtenerPermisosUsuario($usuario_ID, $conexion)
{
    $sql = "SELECT p.ID, p.nombre FROM permisos p
        INNER JOIN roles_permisos rp ON p.ID = rp.permiso_ID
        INNER JOIN usuarios u ON rp.rol_ID = u.rol_ID
        WHERE u.ID = $usuario_ID";
    $result = $conexion->query($sql);
    $permisos = array();
    while ($row = $result->fetch_assoc()) {
        $permisos[$row["ID"]] = $row["nombre"];
    }
    return $permisos;
}

$usuario_ID = $_SESSION["usuario_ID"];
$permisos = obtenerPermisosUsuario($usuario_ID, $conexion);

$response = [
    "permisos" => $permisos
];

echo json_encode($response);