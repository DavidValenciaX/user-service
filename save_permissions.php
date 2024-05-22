<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST["permisos"] as $rol_ID => $permisos) {
        // Eliminar permisos anteriores del rol
        $sql = "DELETE FROM roles_permisos WHERE rol_ID = $rol_ID";
        $conexion->query($sql);

        // Insertar nuevos permisos del rol
        foreach ($permisos as $permiso_ID) {
            $sql = "INSERT INTO roles_permisos (rol_ID, permiso_ID) VALUES ($rol_ID, $permiso_ID)";
            $conexion->query($sql);
        }
    }
    echo "Permisos actualizados.";
}