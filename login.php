
<?php

include_once('conexion.php');

session_start();

if (isset($_POST)) {
    $email = (isset($_POST['correo'])?$_POST['correo']:''); // textbox name 
    $password = (isset($_POST['password'])?$_POST['password']:''); // password
    

    if (empty($email)) {
        $errorMsg[] = "Please enter email";
    } else if (empty($password)) {
        $errorMsg[] = "Please enter password";
    } else if ($email AND $password ) {
        try {
            $select_stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :uemail ");
            $select_stmt->bindParam(":uemail", $email);
            
            $select_stmt->execute(); 

            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            $rol = $row['rol_id'];
            $id = $row['id'];
            $password_bd=$row['password'];

           /*  password_verify($password,$password_bd)->$password es el que se recibe por post y $password_bd el del usuario en la base de datos  password_verify es un método que compara y verifica si las contraseñas son iguales */

            if ($select_stmt->rowCount() > 0 && password_verify($password,$password_bd)) {

                switch($rol) {
                    case '1':
                        $_SESSION['admin_login'] = $email;
                        $_SESSION['id'] = $id;
                        $_SESSION['success'] = "Admin... Successfully Login...";
                        header("location: Admin/");
                    break;
                    case '2':
                        $_SESSION['user_medico'] = $email;
                        $_SESSION['success'] = "Employee... Successfully Login...";
                        header("location: Medico/");
                    break;
                    case '3':
                        $_SESSION['user_paciente'] = $email;
                        $_SESSION['success'] = "Employee... Successfully Login...";
                        header("location: Paciente/");
                    break;
                    default:
                        $_SESSION['error'] = "Wrong email or password or role";
                        header("location: index.php");
                }

            }else {
                    $_SESSION['error'] = "Los datos suministrados son erroneos";
                    header("location: index.php");
                }
            
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }
}

if($_POST['correo']=='' || $_POST['password']==''){
    header("location: index.php");
}


?>