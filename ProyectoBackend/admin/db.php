<?php
$servidor="localhost";
$baseDeDatos="atc";
$usuario="root";
$contrasenia="";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET NAMES utf8");
    return $conexion;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    return null;
}

?>