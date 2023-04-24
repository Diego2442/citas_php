<?php 
    $url='http://localhost/prueba_usco/';
    
    session_start();
    
    if(!isset($_SESSION['admin_login'])){
      header('Location:'.$url);
    }
    
    ?>

<?php 

if($_POST){

    include_once('../../conexion.php');

    $nombre=(isset($_POST['nombre'])?$_POST['nombre']:'');
    $correo=(isset($_POST['correo'])?$_POST['correo']:'');
    $documento=(isset($_POST['documento'])?$_POST['documento']:'');
    $direccion=(isset($_POST['direccion'])?$_POST['direccion']:'');
    $telefono=(isset($_POST['telefono'])?$_POST['telefono']:'');
    $fecha_nacimiento=(isset($_POST['fecha_nacimiento'])?$_POST['fecha_nacimiento']:'');
    $rol=(isset($_POST['rol'])?$_POST['rol']:'');
    $password=(isset($_POST['password'])?$_POST['password']:'');

    $sentencia = $conexion->prepare('INSERT INTO usuarios(id,nombre_usuario,correo,password,documento,fecha_nacimiento,rol_id,direccion,telefono) VALUES (null,:nombre_usuario,:correo,:password,:documento,:fecha_nacimiento,:rol_id,:direccion,:telefono)');

    $sentencia->bindParam(':nombre_usuario',$nombre);
    $sentencia->bindParam(':correo',$correo);
    $sentencia->bindParam(':documento',$documento);
    $sentencia->bindParam(':direccion',$direccion);
    $sentencia->bindParam(':telefono',$telefono);
    $sentencia->bindParam(':fecha_nacimiento',$fecha_nacimiento);
    $sentencia->bindParam(':rol_id',$rol);
    $sentencia->bindParam(':password',password_hash($password,PASSWORD_DEFAULT)); //passeord_hash encrypta la contraseña se envia contraseña y un valor por defecto

      
    print_r($sentencia);
    if($sentencia->execute()){
        header('Location:index.php?mensaje=Se creo el usuairo con exito&icon=success');
    }
    else{
        header('Location:index.php?mensaje=Ocurrió un error al guardar&icon=error');
    }

}else{
    header('Location:crear.php?mensaje=faltan datos&icon=error');
}



?>