<?php 

include("../../db.php");

if(isset($_GET['txtID'])){
    
    // recuperar los datos del ID correspondiente o seleccionado
    
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM servicios WHERE id=:id");
    //Dnde encuentre ":   " reemplaza el valor de la variable
    $sentencia->bindParam(":id",$txtID);
    //ejecuta la inserción de los datos
    $sentencia->execute();
    
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    //Igualamos cada registro capturado 
    $icono = $registro['icono'];
    $titulo = $registro['titulo'];
    $descripcion = $registro['descripcion'];

}

if($_POST){

    //print_r($_POST);

    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $icono = (isset($_POST['icono'])) ? $_POST['icono'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
  
  
    //Recibe los datos del formulario y prepara la insercion a la base
  
    $sentencia=$conexion->prepare("UPDATE  servicios  
    SET
    icono=:icono,
    titulo=:titulo,
    descripcion=:descripcion
    WHERE id=:id");
  
    $sentencia->bindParam(":icono",$icono);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtID);
  
    //ejecuta la inserción de los datos
    
    $sentencia->execute();
    $mensaje="Registro modificado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);
}


include("../../templates/header.php");

?>


<div class="card">

  <div class="card-header">
    Editando la información de servicios
  </div>
  <div class="card-body">
    <form action="" enctype="multipart/formt-data" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

      <div class="mb-3">
        <label for="icono" class="form-label">Icono</label>
        <input value="<?php echo $icono;?>" type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono">
      </div>
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input value="<?php echo $titulo;?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título">
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input value="<?php echo $descripcion;?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción">
      </div>

      <button type="submit" class="btn btn-success">Actualizar</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

  </div>

  <div class="card-footer text-muted">


  </div>
</div>



<?php include("../../templates/footer.php");?>
