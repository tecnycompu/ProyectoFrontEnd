<?php
include("../../db.php");

if ($_POST) {

    //print_r($_POST);

    // recepcionamos los valores del formulario

    $nombreconfiguracion = (isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion'] : "";
    $valor = (isset($_POST['valor'])) ? $_POST['valor'] : "";

    //echo $icono;

    //Recibe los datos del formulario y prepara la insercion a la base

    $sentencia = $conexion->prepare("INSERT INTO `configuraciones` (`ID`, `nombreconfiguracion`, `valor`) VALUES (NULL, :nombreconfiguracion, :valor);");

    //Dnde encuentre ":   " reemplaza el valor de la variable

    $sentencia->bindParam(":nombreconfiguracion", $nombreconfiguracion);
    $sentencia->bindParam(":valor", $valor);

    //ejecuta la inserción de los datos

    $sentencia->execute();
    $mensaje = "Registro agregado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php"); ?>


<div class="card">
    <div class="card-header">
        Configuración
    </div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="nombreconfiguracion" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="Nombre de la Configuración">
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor:</label>
                <input type="text" class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor de la Configuración">
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>