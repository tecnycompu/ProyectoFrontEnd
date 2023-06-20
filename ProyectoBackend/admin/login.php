<?php 

session_start();


if($_POST){
  include("./db.php");
  //print_r($_POST);

  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
  $password = (isset($_POST['password'])) ? $_POST['password'] : "";
  
  $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario 
                        FROM `usuarios`
                        WHERE usuario=:usuario
                        AND password=:password                        
                        ");
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->execute();


  $lista_usuarios = $sentencia->fetch(PDO::FETCH_LAZY);

  //print_r($lista_usuarios);

  if($lista_usuarios['n_usuario']>0){
    //print_r("el usuario y contraseña existe");
    $_SESSION['usuario']=$lista_usuarios['usuario'];
    $_SESSION['logueado']=true;
    header("Location:index.php");
  }else{
    $mensaje="Error: El Usuario o contraseña son incorrectos";

  }

}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    
                </div>
                <div class="col-4">
                    <br/><br/>
                      <?php if(isset($mensaje)){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          <strong><?php echo $mensaje;?></strong> 
                        </div>
                      <?php } ?>
                    <div class="card">
                        <div class="card-header">
                            login
                        </div>
                        <div class="card-body">
                                           
                        <script>
                          var alertList = document.querySelectorAll('.alert');
                          alertList.forEach(function (alert) {
                            new bootstrap.Alert(alert)
                          })
                        </script>
                        
                        <form action=""method="post">
                            <div class="mb-3">
                              <label for="usuario" class="form-label">Usuario</label>
                              <input type="text"
                                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
                            </div>

                        <div class="mb-3">
                          <label for="contrasenia" class="form-label">Contraseña</label>
                          <input type="password"
                            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                        </div>

                        
                        <input name="" id="" class="btn btn-primary" type="submit" value="Entrar">
                        
                        </form>
                        </div>                    
                        <div class="card-footer text-muted">
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>