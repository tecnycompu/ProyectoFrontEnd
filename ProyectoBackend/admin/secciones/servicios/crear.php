<?php
include("../../db.php");
if ($_POST) {

  //print_r($_POST);

  // recepcionamos los valores del formulario

  $icono = (isset($_POST['icono'])) ? $_POST['icono'] : "";
  $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
  $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

  //echo $icono;

  //Recibe los datos del formulario y prepara la insercion a la base

  $sentencia = $conexion->prepare("INSERT INTO `servicios` (`ID`, `icono`, `titulo`, `descripcion`) VALUES (NULL, :icono, :titulo, :descripcion);");

  //Dnde encuentre ":   " reemplaza el valor de la variable

  $sentencia->bindParam(":icono", $icono);
  $sentencia->bindParam(":titulo", $titulo);
  $sentencia->bindParam(":descripcion", $descripcion);

  //ejecuta la inserción de los datos

  $sentencia->execute();
  $mensaje = "Registro agregado con éxito.";
  header("Location:index.php?mensaje=" . $mensaje);
}


include("../../templates/header.php");

?>


<div class="card">

  <div class="card-header">
    Crear Servicios
  </div>
  <div class="card-body">
    <form action="" enctype="multipart/formt-data" method="post">


      <div class="mb-3">
        <label for="icono" class="form-label">Icono</label>
        <input type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono">
      </div>
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título">
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción">
      </div>

      <button type="submit" class="btn btn-success">Agregar</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

  </div>

  <div class="card-footer text-muted">


  </div>
</div>

<?php include("../../templates/footer.php"); ?>