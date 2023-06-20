<?php
$servidor="localhost";
$baseDeDatos="atc";
$usuario="root";
$contrasenia="";

try{
    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
    //echo "Conexión Realizada...";

}catch(Exception $error){
    echo $error->getMessage();

}


?>