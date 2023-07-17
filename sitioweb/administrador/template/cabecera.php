<?php
session_start();
  if(!isset($_SESSION['usuario'])) {
header('Location: ../index.php');

}else {
    if($_SESSION['usuario']=="ok") {
       $nombreUsuario = $_SESSION['nombreUsuario'];

    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

<?php $url = "http://".$_SERVER['HTTP_HOST']."/sitioweb";  ?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="#" aria-current="page">Administrador del Sitio Web<span class="visually-hidden">(current)</span></a>
        <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Inicio</a>
        <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/productos.php">Servicios</a>
        <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">Cerrar</a>
        <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver Sitio Web</a>
    </div>
</nav>




    <div class="container">
        <br/>
        <div class="row">