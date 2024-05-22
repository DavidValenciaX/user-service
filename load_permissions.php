<?php
require_once 'conexion.php';

$response = array();

$sql_roles = "SELECT * FROM roles";
$result_roles = $conexion->query($sql_roles);
$roles = array();

while ($rol = $result_roles->fetch_assoc()) {
    $rol_id = $rol['ID'];
    $sql_rol_permisos = "SELECT permiso_ID FROM roles_permisos WHERE rol_ID = $rol_id";
    $result_rol_permisos = $conexion->query($sql_rol_permisos);
    $rol_permisos = array();
    while ($rol_permiso = $result_rol_permisos->fetch_assoc()) {
        $rol_permisos[] = $rol_permiso['permiso_ID'];
    }
    $rol['permisos'] = $rol_permisos;
    $roles[] = $rol;
}

$sql_permisos = "SELECT * FROM permisos";
$result_permisos = $conexion->query($sql_permisos);
$permisos = array();

while ($permiso = $result_permisos->fetch_assoc()) {
    $permisos[] = $permiso;
}

$response['roles'] = $roles;
$response['permisos'] = $permisos;

header('Content-Type: application/json');
echo json_encode($response);
