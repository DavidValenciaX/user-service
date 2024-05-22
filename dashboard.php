<?php
session_start();

require_once 'conexion.php';

if (!isset($_SESSION['usuario_ID'])) {
    http_response_code(401);
    echo json_encode(["message" => "No has iniciado sesión"]);
    exit();
}

function showAlert($message, $redirect = null)
{
    echo "<script type='text/javascript'>
        Swal.fire({
            title: 'Alerta',
            text: '$message',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed && '$redirect') {
                window.location.href = '$redirect';
            }
        });
      </script>";
}

function obtenerNombreRol($rol_ID, $conexion)
{
    $sql = "SELECT nombre FROM roles WHERE ID = $rol_ID";
    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    return $row["nombre"];
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
$usuario_nombre = $_SESSION["usuario_nombre"];
$usuario_rol = $_SESSION["usuario_rol"];
$permisos = obtenerPermisosUsuario($usuario_ID, $conexion);
$rol_nombre = obtenerNombreRol($usuario_rol, $conexion);

$response = [
    "usuario_nombre" => $usuario_nombre,
    "usuario_rol" => $rol_nombre,
    "permisos" => $permisos
];

echo json_encode($response);