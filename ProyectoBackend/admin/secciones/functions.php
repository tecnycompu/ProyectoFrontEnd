<?php

function subirImagen($imagen, $rutaDestino) {
    if (!empty($imagen["name"])) {
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen["name"];
        $tmp_imagen = $imagen["tmp_name"];
        move_uploaded_file($tmp_imagen, $rutaDestino . $nombre_archivo_imagen);
        return $nombre_archivo_imagen;
    }
    return "";
}

function insertarRegistro($conexion, $tabla, $campos, $valores) {
    $sql = "INSERT INTO $tabla ($campos) VALUES ($valores);";
    $sentencia = $conexion->prepare($sql);
    return $sentencia->execute();
}
