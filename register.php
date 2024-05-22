<?php
require_once 'conexion.php';
header('Content-Type: application/json');

$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre = $data["nombre"];
    $apellido = $data["apellido"];
    $email = $data["email"];
    $usuario = $data["usuario"];
    $contrasena = password_hash($data["contrasena"], PASSWORD_DEFAULT);
    $rol_ID = $data["rol"];

    $sql = "INSERT INTO usuarios (nombre, apellido, email, usuario, contrasena, rol_ID) VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contrasena', '$rol_ID')";

    if ($conexion->query($sql) === TRUE) {
        $response["success"] = true;
        $response["message"] = "Usuario registrado exitosamente.";
    } else {
        $response["message"] = "Error al registrar: " . $conexion->error;
    }
}

echo json_encode($response);
exit();