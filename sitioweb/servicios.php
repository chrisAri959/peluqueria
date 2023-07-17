<?php include('template/cabecera.php'); ?>

<?php

include('administrador/config/bd.php');

$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
$listarServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach ($listarServicios as $servicio) {  ?>
    <div class="col-md-3">
        <br />
        <div class="card">
            <img class="card-img-top img-fluid" src="./img/<?php echo $servicio['imagen'];  ?>" alt="Title">
            <div class="card-body">
                <h4 class="card-title"><?php echo $servicio['nombre']; ?></h4>
               
            </div>
        </div>
        <br />
    </div>

<?php  }  ?>

<?php include('template/pie.php');  ?>