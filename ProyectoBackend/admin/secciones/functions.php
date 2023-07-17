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


function actualizarRegistro($tabla, $datos, $idCampo, $idValor)
{
    global $conexion;

    if (!$conexion) {
        return false;
    }

    // Construir la consulta UPDATE
    $campos = "";
    foreach ($datos as $campo => $valor) {
        $campos .= "$campo=:$campo,";
    }
    $campos = rtrim($campos, ",");

    try {
        $sentencia = $conexion->prepare("UPDATE $tabla SET $campos WHERE $idCampo=:id");
        foreach ($datos as $campo => $valor) {
            $sentencia->bindParam(":$campo", $valor);
        }
        $sentencia->bindParam(":id", $idValor);
        $sentencia->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error al actualizar el registro: " . $e->getMessage();
        return false;
    }
}

function actualizarImagen($tabla, $idCampo, $idValor, $imagenCampo, $directorio)
{
    global $conexion; 
    
    if (!$conexion) {
        return false;
    }

    // Obtener la imagen actual para borrarla
    $sentencia = $conexion->prepare("SELECT $imagenCampo FROM $tabla WHERE $idCampo=:id");
    $sentencia->bindParam(":id", $idValor);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Actualizar la imagen si se proporciona una nueva
    if (isset($_FILES[$imagenCampo]["name"]) && $_FILES[$imagenCampo]["name"] !== "") {
        $imagen = $_FILES[$imagenCampo]["name"];
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;
        $tmp_imagen = $_FILES[$imagenCampo]["tmp_name"];
        move_uploaded_file($tmp_imagen, "$directorio/$nombre_archivo_imagen");

        // Borrar la imagen anterior
        if (isset($registro_imagen[$imagenCampo])) {
            $imagen_antigua = $registro_imagen[$imagenCampo];
            if (file_exists("$directorio/$imagen_antigua")) {
                unlink("$directorio/$imagen_antigua");
            }
        }

        // Actualizar la ruta de la imagen en la base de datos
        try {
            $sentencia = $conexion->prepare("UPDATE $tabla SET $imagenCampo=:imagen WHERE $idCampo=:id");
            $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
            $sentencia->bindParam(":id", $idValor);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la imagen: " . $e->getMessage();
            return false;
        }
    }

    return true;
}

?>
