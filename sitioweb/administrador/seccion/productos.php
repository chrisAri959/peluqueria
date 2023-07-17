
<?php  include('../template/cabecera.php'); ?>   
<!-- .. (sale de la carpeta Seccion entra / carpeta Template)  -->

<?php
                              // entonces ?   // de lo contrario : 
$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";

$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

// prueba 2
//echo $txtID."<br/>";
//echo $txtNombre."<br/>";
//echo $txtImagen."<br/>";
//echo $accion."<br/>"; 

// prueba 1
//print_r($_POST);
//print_r($_FILES);

include('../config/bd.php');  //base de datos    

switch ($accion) {
    case 'agregar':
        //INSERT INTO `servicios` (`id`, `nombre`, `imagen`) VALUES (NULL, 'Libro de PHP', 'imagen.jpg');
    $sentenciaSQL = $conexion->prepare("INSERT INTO servicios (nombre, imagen) VALUES (:nombre,:imagen);");
    $sentenciaSQL->bindParam(':nombre',$txtNombre);
    
    $fecha = new DateTime();
    $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagen.jpg";

    $tmpImagen = $_FILES['txtImagen']['tmp_name'];

    if($tmpImagen!="") {
             move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
    }
    
    //$sentenciaSQL->bindParam(':imagen',$txtImagen);     no coincide 15-07-23
    $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
    $sentenciaSQL->execute();

    header('Location: productos.php');   
        break;
    case 'modificar':
        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);     
        $sentenciaSQL->execute();


        if($txtImagen!="") {
          
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagen.jpg";
            $tmpImagen = $_FILES['txtImagen']['tmp_name'];
           
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);


            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM servicios WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();   
            $servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
         
             if(isset($servicio['imagen']) && ($servicio['imagen']!="imagen.jpg")){
    
                if(file_exists("../../img/".$servicio['imagen'])){
                 
                  unlink("../../img/".$servicio['imagen']);
             }
            }

           $sentenciaSQL = $conexion->prepare("UPDATE servicios SET imagen=:imagen WHERE id=:id");
           $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
           $sentenciaSQL->bindParam(':id',$txtID);     
           $sentenciaSQL->execute();
        }
        header('Location: productos.php');
        //echo  "Precionado botón modificar";
        break;
    case 'cancelar':
        header('Location: productos.php');
       //echo  "Precionado botón cancelar";
        break;
    case 'seleccionar':
        $sentenciaSQL = $conexion->prepare("SELECT * FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);     
        $sentenciaSQL->execute();   
        $servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $servicio['nombre'];
        $txtImagen = $servicio['imagen'];


        //echo  "Precionado botón Seleccionar";
        break;
    case 'borrar':
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);     
        $sentenciaSQL->execute();   
        $servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
     
         if(isset($servicio['imagen']) && ($servicio['imagen']!="imagen.jpg")){

            if(file_exists("../../img/".$servicio['imagen'])){
             
              unlink("../../img/".$servicio['imagen']);
         }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM servicios WHERE id=:id");        
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();  
        

        header('Location: productos.php');
        //echo  "Precionado botón Borrar";    
        break;
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();   
$listarServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

                          <!--           INICIO           -->

<div class="col-md-5">

                             <!--  bs5-card-head-foot -->
<div class="card">
    <div class="card-header">
        Datos de los Servicios
    </div>

                           <!--  dentro card-body =>formulario     -->
    <div class="card-body">

    <form method="POST" enctype="multipart/form-data">

<div class="form-group">
  <label for="txtID">ID:</label>
  <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
</div>

<div class="form-group">
  <label for="txtNombre">Nombre:</label>
  <input type="text"  required  class="form-control"  value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del Servicio">
</div>



<div class="form-group">
  <label for="txtNombre">Imagen:</label>

     
  <br/>

  <?php
   
   if($txtImagen!="") {    ?>  
  
  <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="" srcset="">

  <?php }  ?>
  
  <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre del Servicio">
</div>

                          <!-- bs5- bgroup-default -->

<div class="btn-group" role="group" aria-label="">
    <button type="submit" name="accion" <?php echo ($accion=="seleccionar")?"disabled":""; ?> value="agregar" class="btn btn-success">Agregar</button>
    <button type="submit" name="accion" <?php echo ($accion!="seleccionar")?"disabled":""; ?> value="modificar" class="btn btn-warning">Modificar</button>
    <button type="submit" name="accion" <?php echo ($accion!="seleccionar")?"disabled":""; ?> value="cancelar" class="btn btn-info">Cancelar</button>
</div>

</form>

    </div>
   
</div>


                              <!--  tabla    -->

</div>
<div class="col-md-7">
                          <!-- bs5-table-default -->
<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($listarServicios as $servicio)     {   ?>
            <tr>
                <td><?php echo $servicio['id']; ?></td>
                <td><?php echo $servicio['nombre']; ?>></td>
                <td>
                    
                <img class="img-thumbnail rounded" src="../../img/<?php echo $servicio['imagen']; ?>" width="50" alt="" srcset="">
                
            
                </td>
               
                <td>
                    
                <form method="post">
                  <input type="hidden" name="txtID" id="txtID" value="<?php echo $servicio['id']; ?>"/>
              
                  <input type="submit" name="accion" value="seleccionar" class="btn btn-primary"/>

                  <input type="submit" name="accion" value="borrar" class="btn btn-danger"/>
              
                </form>
                
                
                </td>
            </tr>
           <?php   }  ?>
        </tbody>
    </table>
</div>


 
</div>

<?php  include('../template/pie.php'); ?>   