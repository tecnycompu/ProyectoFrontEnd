<?php 

include("../../db.php");

if(isset($_GET['txtID'])){
// borrar dicho registro con el ID correspondiente

//echo $_GET['txtID'];


// Código para borrar registro
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion->prepare("DELETE FROM servicios WHERE id=:id");
//Dnde encuentre ":   " reemplaza el valor de la variable
$sentencia->bindParam(":id",$txtID);
//ejecuta la inserción de los datos
$sentencia->execute();

}


//Selecciona todos los registros

$sentencia=$conexion->prepare("SELECT * FROM `servicios`");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


//print_r($lista_servicios);


include("../../templates/header.php");

?>


    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
            
        </div>
        <div class="card-body">
           
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Icono</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acción</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_servicios as $registros){?>
                        <tr class="">
                            <td><?php echo $registros['ID'];?></td>
                            <td><?php echo $registros['icono'];?></td>
                            <td><?php echo $registros['titulo'];?></td>
                            <td><?php echo $registros['descripcion'];?></td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                                │
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID'];?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            

        </div>
        
    </div>

<?php include("../../templates/footer.php");?>
