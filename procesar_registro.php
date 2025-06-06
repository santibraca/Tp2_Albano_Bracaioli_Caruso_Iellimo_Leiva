<?php
include("con_db.php");

if (isset($_POST['registro_usuario'])) {
    if (strlen($_POST['usuario']) >= 1 && strlen($_POST['password']) >= 1) {
        $usuario = trim($_POST['usuario']);
	    $email = trim($_POST['email']);
	    $password = trim($_POST['password']);
		$password_cifrada = password_hash($password,PASSWORD_DEFAULT,array("cost"=>10));

        $consulta = "INSERT INTO usuarios (username, email, password_cifrada) 
                     VALUES ('$usuario', '$email', '$password_cifrada')";
        $resultado = mysqli_query($conex, $consulta);
        if ($resultado) {
            echo "<p>Usuario registrado correctamente.</p><br>
            <a href='login.php'>Acceda con su nuevo usuario</a>";
        } else {
            echo "<p>Error al registrar el usuario.</p>
            <a href='registro.php'>Reintentar registro</a>". mysqli_error($conex);;
        }
    } else {
        echo "<p>Por favor, completá todos los campos.</p>";
    }
}
?>
