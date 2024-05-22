<?php
require_once 'conexion.php';
header('Content-Type: application/json');

$sql = "SELECT ID, nombre FROM roles WHERE nombre != 'Superusuario'";
$result = $conexion->query($sql);
$roles = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }
}

echo json_encode($roles);