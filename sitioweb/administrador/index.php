<?php   
session_start();


if ($_POST) {
     if(($_POST['usuario']=="toby") && ($_POST['contrasenia']=="sistema")) {
     $_SESSION['usuario']="ok";
     $_SESSION['nombreUsuario']="toby";

  header('Location: inicio.php');
}else {
  $mensaje="Error: El usuario o contraseña son incorrectos";
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Administrador del sitio Web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
    
    
    <div class="container">
        <div class="row">


        <div class="col-md-4">
            
        </div>


            <div class="col-md-4" >
<br/><br/><br/>                
                 <div class="card login text-center">
                    <div class="card-header">
                     <strong>Login</strong>
                    </div>
                    <div class="card-body">
                    
                    <?php if(isset($mensaje))  {?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $mensaje; ?>
                  </div>
                  <?php }  ?>


                    <form method="POST" > 
                          <div class="form-group">
                            <label class="form-label"><em>Usuario</em></label>
                            <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario">
                          </div>

                          <div class="form-group">
                            <label class="form-label"><em>Contraseña</em></label>
                            <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu contraseña">
                         </div>              
                           <br/>
                            <button type="submit" class="btn btn-info">Entrar al Administrador</button>
                    </form> 
                    </div>
                    
                 </div>

            </div>
                        
        </div>
    </div>


</body>

</html>