<?php
include("../../db.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro['usuario'];
    $correo = $registro['correo'];
}

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";

    // Solo actualizamos la contraseña si se proporciona una nueva
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sentencia = $conexion->prepare("UPDATE usuarios 
            SET usuario=:usuario, correo=:correo, password=:password 
            WHERE id=:id");
        $sentencia->bindParam(":password", $password);
    } else {
        $sentencia = $conexion->prepare("UPDATE usuarios 
            SET usuario=:usuario, correo=:correo 
            WHERE id=:id");
    }

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro modificado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Usuario
    </div>
    <div class="card-body">
        <form action="" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input readonly type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" value="<?php echo $usuario; ?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" value="<?php echo $correo; ?>" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="correo@mail.com">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>