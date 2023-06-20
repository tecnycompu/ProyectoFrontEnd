<?php

include("../../db.php");

// Código para eliminar registros

if (isset($_GET['txtID'])) {

    // recuperar los datos del ID correspondiente o seleccionado
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    
    // para borrar la imagen fisica en la capeta
    $sentencia=$conexion->prepare("SELECT imagen FROM portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){

        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
        }
    }


    $sentencia=$conexion->prepare("DELETE FROM portafolio WHERE id=:id");
    //Dnde encuentre ":   " reemplaza el valor de la variable
    $sentencia->bindParam(":id",$txtID);
    //ejecuta la inserción de los datos
    $sentencia->execute();

}


//Selecciona todos los registros

$sentencia = $conexion->prepare("SELECT * FROM `portafolio`");
$sentencia->execute();
$lista_portafolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php");

?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cliente&Categoria</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_portafolio as $registros) { ?>
                        <tr class="">
                            <td scope="col"><?php echo $registros['ID']; ?></td>
                            <td scope="col">
                                <h6> <?php echo $registros['titulo']; ?> </h6>
                                <?php echo $registros['subtitulo']; ?>
                                <br>-<?php echo $registros['url']; ?>
                            </td>

                            <td scope="col">
                                <img width="50" src="../../../assets/img/portfolio/<?php echo $registros['imagen']; ?>" />
                            </td>

                            <td scope="col"><?php echo $registros['descripcion']; ?></td>
                            <td scope="col">
                                -<?php echo $registros['categoria']; ?>
                                <br>-<?php echo $registros['cliente']; ?>
                            </td>

                            <td scope="col">
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                │
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                            </td>

                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>



    </div>

</div>


<?php include("../../templates/footer.php"); ?>