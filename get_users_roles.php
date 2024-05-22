<?php
require_once 'conexion.php';

$sql_usuarios = "SELECT u.ID, u.nombre, u.apellido, u.email, r.nombre AS rol 
                 FROM usuarios u
                 INNER JOIN roles r ON u.rol_ID = r.ID";
$result_usuarios = $conexion->query($sql_usuarios);

$sql_roles = "SELECT * FROM roles";
$result_roles = $conexion->query($sql_roles);

$usuarios = [];
while ($usuario = $result_usuarios->fetch_assoc()) {
    $usuarios[] = $usuario;
}

$roles = [];
while ($rol = $result_roles->fetch_assoc()) {
    $roles[] = $rol;
}

echo json_encode(["usuarios" => $usuarios, "roles" => $roles]);