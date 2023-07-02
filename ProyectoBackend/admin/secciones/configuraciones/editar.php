<?php
include("../../db.php");

if (isset($_GET['txtID'])) {

    // recuperar los datos del ID correspondiente o seleccionado

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM configuraciones WHERE id=:id");
    //Dnde encuentre ":   " reemplaza el valor de la variable
    $sentencia->bindParam(":id", $txtID);
    //ejecuta la inserción de los datos
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    //Igualamos cada registro capturado 
    $nombreconfiguracion = $registro['nombreconfiguracion'];
    $valor = $registro['valor'];
    
}

if ($_POST) {

    //print_r($_POST);

    // recepcionamos los valores del formulario
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombreconfiguracion = (isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion'] : "";
    $valor = (isset($_POST['valor'])) ? $_POST['valor'] : "";

    //echo $icono;

    //Recibe los datos del formulario y prepara la insercion a la base

    $sentencia = $conexion->prepare("UPDATE configuraciones 
    SET nombreconfiguracion=:nombreconfiguracion,valor=:valor WHERE id=:id;");

    //Dnde encuentre ":   " reemplaza el valor de la variable

    $sentencia->bindParam(":nombreconfiguracion", $nombreconfiguracion);
    $sentencia->bindParam(":valor", $valor);
    $sentencia->bindParam(":id", $txtID);

    //ejecuta la inserción de los datos

    $sentencia->execute();
    $mensaje = "Registro modificado con éxito.";
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
                <label for="txtID" class="form-label">ID:</label>
                <input value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="nombreconfiguracion" class="form-label">Nombre:</label>
                <input value="<?php echo $nombreconfiguracion;?>" type="text" class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="Nombre de la Configuración">
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor:</label>
                <input value="<?php echo $valor;?>" type="text" class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor de la Configuración">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php include("../../templates/footer.php"); ?>