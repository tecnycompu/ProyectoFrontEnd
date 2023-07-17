<?php
include("../../db.php");
include("../functions.php");

if (isset($_GET['txtID'])) {

    // Recuperar los datos del ID correspondiente o seleccionado
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM portafolio WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Ahora, vamos a cambiar cómo se asignan los valores para evitar la duplicación
    // Verificamos si hay un envío por POST y tomamos los valores del formulario
    if ($_POST) {
        $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : $registro['titulo'];
        $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : $registro['subtitulo'];
        $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : $registro['descripcion'];
        $cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : $registro['cliente'];
        $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : $registro['categoria'];
        $url = (isset($_POST['url'])) ? $_POST['url'] : $registro['url'];
    } else {
        // Si no hay envío por POST, tomamos los valores del registro obtenido de la base de datos
        $titulo = $registro['titulo'];
        $subtitulo = $registro['subtitulo'];
        $descripcion = $registro['descripcion'];
        $cliente = $registro['cliente'];
        $categoria = $registro['categoria'];
        $url = $registro['url'];
    }

    $imagen = $registro['imagen'];
}

if ($_POST) {

    // Recepcionamos los valores del formulario
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";

    // Recibimos los demás datos del formulario
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";
    $url = (isset($_POST['url'])) ? $_POST['url'] : "";

    // Si el usuario ha seleccionado una nueva imagen, la procesamos y actualizamos en la base de datos
    if ($_FILES["imagen"]["name"] != "") {
        // Procesamos la imagen y la guardamos con un nombre único
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $_FILES["imagen"]["name"];
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);
        
        // Borrado del archivo anterior
        $sentencia = $conexion->prepare("SELECT imagen FROM portafolio WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/portfolio/" . $registro_imagen["imagen"])) {
                unlink("../../../assets/img/portfolio/" . $registro_imagen["imagen"]);
            }
        }

        // Actualizamos la ruta de la imagen en la base de datos
        $sentencia = $conexion->prepare("UPDATE portafolio SET imagen=:imagen WHERE id=:id");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute(); 
    }

    // Preparamos la actualización en la base de datos para los otros campos
    $sentencia = $conexion->prepare("UPDATE portafolio 
        SET titulo=:titulo, subtitulo=:subtitulo, descripcion=:descripcion, cliente=:cliente, categoria=:categoria, url=:url 
        WHERE id=:id");

    // Reemplazamos los valores en la consulta
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":cliente", $cliente);
    $sentencia->bindParam(":categoria", $categoria);
    $sentencia->bindParam(":url", $url);
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
        Producto del portafolio
    </div>
    <div class="card-body">

        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" class="form-control" readonly name="txtID" id="txtID" value="<?php echo $txtID; ?>" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>

            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" value="<?php echo $subtitulo; ?>" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen</label>
                <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen; ?>" />
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción;</label>
                <input type="text" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>

            <div class="mb-3">
                <label for="cliente" class="form-label">cliente:</label>
                <input type="text" class="form-control" value="<?php echo $cliente; ?>" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Cliente">
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" value="<?php echo $categoria; ?>" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categoria">
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="text" class="form-control" value="<?php echo $url; ?>" name="url" id="url" aria-describedby="helpId" placeholder="URL del proyecto">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php include("../../templates/footer.php"); ?>