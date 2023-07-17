<?php
include("../../db.php");
include("../functions.php");

if ($_POST) {
    // Recepcionamos los valores del formulario
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";
    $url = (isset($_POST['url'])) ? $_POST['url'] : "";

    // Recepcionamos imagen
    $imagen = $_FILES["imagen"];
    $nombre_archivo_imagen = subirImagen($imagen, "../../../assets/img/portfolio/");

    // Preparamos los datos para la inserción a la base de datos
    $campos = "`titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`";
    $valores = ":titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url";

    // Insertamos el registro en la base de datos
    $sql = "INSERT INTO `portafolio` ($campos) VALUES ($valores);";
    $sentencia = $conexion->prepare($sql);
    
    $sentencia->execute([
        ":titulo" => $titulo,
        ":subtitulo" => $subtitulo,
        ":imagen" => $nombre_archivo_imagen,
        ":descripcion" => $descripcion,
        ":cliente" => $cliente,
        ":categoria" => $categoria,
        ":url" => $url
    ]);

    $mensaje = "Registro agregado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Producto del portafolio
    </div>
    <div class="card-body">

        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>



            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción;</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>

            <div class="mb-3">
                <label for="cliente" class="form-label">cliente:</label>
                <input type="text" class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Cliente">
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoria">
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="text" class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="URL del proyecto">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>




<?php include("../../templates/footer.php"); ?>