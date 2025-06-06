<?php
include("con_db.php");

if (isset($_POST['login_usuario'])) {
    if (strlen($_POST['usuario']) >= 1 && strlen($_POST['password']) >= 1) {
        
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        $consulta = "SELECT * FROM usuarios WHERE username='$usuario'";
        $resultado = mysqli_query($conex, $consulta);

        if ($resultado && mysqli_num_rows($resultado) == 1) {
            $fila = mysqli_fetch_assoc($resultado);

            if (password_verify($password, $fila['password_cifrada'])) {
                echo "<p>Login Correcto</p>";
                exit();
            } else {
                echo "<p>Contraseña incorrecta.</p><br>
                <a href='login.php'>Reintentar iniciar sesion</a>";
            }
        } else {
            echo "El usuario no existe<br>
                <a href='login.php'>Registrate aca</a>";
        }

    } else {echo "Por favor, completá todos los campos.";
    }
}
?>