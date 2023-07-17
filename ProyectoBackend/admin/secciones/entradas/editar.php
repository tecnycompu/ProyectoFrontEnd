<?php
include("../../db.php");
include("../functions.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM entradas WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Asignamos los valores a las variables
    $fecha = $registro['fecha'];
    $titulo = $registro['titulo'];
    $descripcion = $registro['descripcion'];
    $imagen = $registro['imagen'];
}

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    
    // Verificamos si el usuario ha seleccionado una nueva imagen
    if ($_FILES["imagen"]["name"] != "") {
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $_FILES["imagen"]["name"];
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        move_uploaded_file($tmp_imagen, "../../../assets/img/about/" . $nombre_archivo_imagen);

        // Borrado del archivo anterior
        if (file_exists("../../../assets/img/about/" . $imagen)) {
            unlink("../../../assets/img/about/" . $imagen);
        }

        // Actualizamos la ruta de la imagen en la base de datos
        $sentencia = $conexion->prepare("UPDATE entradas SET imagen=:imagen WHERE id=:id");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        // Actualizamos el valor de la variable $imagen con el nombre de la nueva imagen
        $imagen = $nombre_archivo_imagen;
    }

    // Preparamos la actualización en la base de datos para los otros campos
    $sentencia = $conexion->prepare("UPDATE entradas 
        SET fecha=:fecha, titulo=:titulo, descripcion=:descripcion 
        WHERE id=:id");

    // Reemplazamos los valores en la consulta
    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txtID);

    // Ejecutamos la actualización
    $sentencia->execute();

    $mensaje = "Registro Modificado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Entradas
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" class="form-control" readonly value="<?php echo $txtID; ?>" name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" value="<?php echo $fecha; ?>" name="fecha" id="fecha"
                    aria-describedby="helpId" placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo"
                    aria-describedby="helpId" placeholder="Título">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion"
                    id="descripcion" aria-describedby="helpId" placeholder="Descripción">
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/about/<?php echo $imagen; ?>" />
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId"
                    placeholder="Imagen">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>