<?php

    $servidor="localhost"; //127.0.0.1
    $usuario="root";
    $pass="";
    $bd="prueba_usco";

    try{

        $conexion= new PDO("mysql:host=$servidor;dbname=$bd",$usuario, $pass );
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

       /*  echo "Conexión Exitosa";
 */
       

        

    }catch(PDOException $error){

        echo "Conexión Fallida".$error;
    }

?>