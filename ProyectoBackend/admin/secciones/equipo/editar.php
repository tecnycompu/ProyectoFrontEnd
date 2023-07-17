<?php 
include("../../db.php");
include("../functions.php");

if (isset($_GET['txtID'])) {

    // Recuperar los datos del ID correspondiente o seleccionado
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM equipo WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Ahora, vamos a cambiar cómo se asignan los valores para evitar la duplicación
    // Verificamos si hay un envío por POST y tomamos los valores del formulario
    if ($_POST) {
        $nombrecompleto = (isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto'] : $registro['nombrecompleto'];
        $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : $registro['puesto'];
        $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : $registro['twitter'];
        $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : $registro['facebook'];
        $linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin'] : $registro['linkedin'];
    } else {
        // Si no hay envío por POST, tomamos los valores del registro obtenido de la base de datos
        $nombrecompleto = $registro['nombrecompleto'];
        $puesto = $registro['puesto'];
        $twitter = $registro['twitter'];
        $facebook = $registro['facebook'];
        $linkedin = $registro['linkedin'];
    }

    $imagen = $registro['imagen'];
}

if ($_POST) {

    // Recepcionamos los valores del formulario
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";

    // Recibimos los demás datos del formulario
    $nombrecompleto = (isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto'] : "";
    $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : ""; 
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : "";
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";
    $linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin'] : "";

    // Si el usuario ha seleccionado una nueva imagen, la procesamos y actualizamos en la base de datos
    if ($_FILES["imagen"]["name"] != "") {
        // Procesamos la imagen y la guardamos con un nombre único
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $_FILES["imagen"]["name"];
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        move_uploaded_file($tmp_imagen, "../../../assets/img/team/" . $nombre_archivo_imagen);
        
        // Borrado del archivo anterior
        $sentencia = $conexion->prepare("SELECT imagen FROM equipo WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/team/" . $registro_imagen["imagen"])) {
                unlink("../../../assets/img/team/" . $registro_imagen["imagen"]);
            }
        }

        // Actualizamos la ruta de la imagen en la base de datos
        $sentencia = $conexion->prepare("UPDATE equipo SET imagen=:imagen WHERE id=:id");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute(); 
    }

    // Preparamos la actualización en la base de datos para los otros campos
    $sentencia = $conexion->prepare("UPDATE equipo 
        SET nombrecompleto=:nombrecompleto, puesto=:puesto, twitter=:twitter, facebook=:facebook, linkedin=:linkedin 
        WHERE id=:id");

    // Reemplazamos los valores en la consulta
    $sentencia->bindParam(":nombrecompleto", $nombrecompleto);
    $sentencia->bindParam(":puesto", $puesto);
    $sentencia->bindParam(":twitter", $twitter);
    $sentencia->bindParam(":facebook", $facebook);
    $sentencia->bindParam(":linkedin", $linkedin);
    $sentencia->bindParam(":id", $txtID);

    // Ejecutamos la actualización
    $sentencia->execute();

    $mensaje = "Registro Modificado con éxito.";
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
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
                class="form-control" readonly value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/team/<?php echo $imagen; ?>" />
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
            </div>

            <div class="mb-3">
                <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
                <input type="text" class="form-control" value="<?php echo $nombrecompleto;?>" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre Completo">
            </div>

            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" value="<?php echo $puesto;?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
            </div>

            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter:</label>
                <input type="text" class="form-control" value="<?php echo $twitter;?>" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter">
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" value="<?php echo $facebook;?>" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook">
            </div>

            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" value="<?php echo $linkedin;?>" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php include("../../templates/footer.php");?>
