<?php
include("../../db.php");

if ($_POST) {
    // Recibimos los datos del formulario
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";

    // Encriptamos la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparamos la inserción en la base de datos
    $sentencia = $conexion->prepare("INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)");

    // Reemplazamos los valores en la consulta
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $hashed_password);

    // Ejecutamos la inserción
    $sentencia->execute();

    $mensaje = "Usuario creado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Crear Usuario
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-success">Crear Usuario</button>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>