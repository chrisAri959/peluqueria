


<?php
$host = "localhost";
$bd = "sitio";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
  ///  $conexion->exec("USE $bd"); // Select the database
    if($conexion) { echo "Conectado.... a sistema"; } 
} catch (PDOException $ex) {
    echo "Error al conectar a la base de datos: " . $ex->getMessage();
}
?>

