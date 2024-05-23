<?php
require_once 'conexion.php';
header('Content-Type: application/json');

$sql = "SELECT ID, nombre FROM roles";
$result = $conexion->query($sql);

$roles = [];
while ($row = $result->fetch_assoc()) {
    $roles[] = $row;
}

echo json_encode(["roles" => $roles]);