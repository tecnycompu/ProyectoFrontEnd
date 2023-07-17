<?php
include("../../db.php");
include("../functions.php");

if ($_POST) {
    // Recepcionamos los valores del formulario
    $nombrecompleto = (isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto'] : "";
    $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : "";
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : "";
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";
    $linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin'] : "";

    // Recepcionamos imagen
    $imagen = $_FILES["imagen"];
    $nombre_archivo_imagen = subirImagen($imagen, "../../../assets/img/team/");

    // Preparamos los datos para la inserción a la base de datos
    $campos = "`imagen`, `nombrecompleto`, `puesto`, `twitter`, `facebook`, `linkedin`";
    $valores = ":imagen, :nombrecompleto, :puesto, :twitter, :facebook, :linkedin";

    // Insertamos el registro en la base de datos
    $sql = "INSERT INTO `equipo` ($campos) VALUES ($valores);";
    $sentencia = $conexion->prepare($sql);
    
    $sentencia->execute([
        ":imagen" => $nombre_archivo_imagen,
        ":nombrecompleto" => $nombrecompleto,
        ":puesto" => $puesto,
        ":twitter" => $twitter,
        ":facebook" => $facebook,
        ":linkedin" => $linkedin
    ]);

    $mensaje = "Registro agregado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        Equipo
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
            </div>

            <div class="mb-3">
                <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
                <input type="text" class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre Completo">
            </div>

            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
            </div>

            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter:</label>
                <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter">
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook">
            </div>

            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted">

    </div>
</div>





<?php include("../../templates/footer.php"); ?>