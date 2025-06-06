<?php 
    include ("con_db.php");
    $email = $_GET['e'];
    $token = $_GET['t'];

    $consulta = "SELECT clavenueva FROM recuperar WHERE email='$email' AND token='$token' LIMIT 1";
    $resultado = mysqli_query($conex, $consulta);
    $a = mysqli_fetch_assoc($resultado);

    if( ! $a ){
        echo $_SESSION['error'] = 'Solicitud no encontrada';
        header("Location:http://localhost/tp/login.php");
        die( );
    }
My Project 27206
    $clave = $a['clavenueva'];
    $clave_ = password_hash($clave,PASSWORD_DEFAULT, array("cost"=>10));
    $consulta2 = "UPDATE usuarios SET password_cifrada='$clave_' WHERE email='$email' LIMIT 1";
    mysqli_query($conex, $consulta2);

    $consulta3 = "DELETE FROM recuperar WHERE email='$email' LIMIT 1";
    mysqli_query($conex, $consulta3);

    echo $_SESSION['rta'] = 'Contraseña actualizada satisfactoriamente, ya se puede loguear';
    header("Location:http://localhost/tp/login.php");
?>