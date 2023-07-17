<?php
include("../../db.php");
include("../functions.php");

if ($_POST) {
    // Recepcionamos los valores del formulario
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    // Recepcionamos imagen
    $imagen = $_FILES["imagen"];
    $nombre_archivo_imagen = subirImagen($imagen, "../../../assets/img/about/");

    // Preparamos los datos para la inserción a la base de datos
    $campos = "`fecha`, `titulo`, `descripcion`, `imagen`";
    $valores = ":fecha, :titulo, :descripcion, :imagen";

    // Insertamos el registro en la base de datos
    $sql = "INSERT INTO `entradas` ($campos) VALUES ($valores);";
    $sentencia = $conexion->prepare($sql);
    
    $sentencia->execute([
        ":fecha" => $fecha,
        ":titulo" => $titulo,
        ":descripcion" => $descripcion,
        ":imagen" => $nombre_archivo_imagen
    ]);

    $mensaje = "Registro Agregado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}



include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Entradas
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción">
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php include("../../templates/footer.php"); ?>