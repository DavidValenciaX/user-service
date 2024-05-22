<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_roles = $_POST["user_roles"];

    foreach ($user_roles as $usuario_ID => $rol_ID) {
        $sql = "UPDATE usuarios SET rol_ID = ? WHERE ID = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $rol_ID, $usuario_ID);
        $stmt->execute();
    }

    echo json_encode(["message" => "Roles de usuario actualizados exitosamente."]);
}