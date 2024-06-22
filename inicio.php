<?php
session_start();

include("conexion.php");

//creamos la variable para que reconozca los datos que vienen del index
$usuario=$_POST['correo'];
$clave=$_POST['clave'];


if(empty($_SESSION)){
    if (isset($_POST['correo']) && isset($_POST['clave'])) {
        $usuario = mysqli_real_escape_string($connect, $_POST['correo']);
        $clave = $_POST['clave'];

        $query = "SELECT nombre, correo, foto 
                  FROM users
                  WHERE correo = ?";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, 's', $usuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($resultado) == 0){
            header('Location: index.html');
            exit();
        } else {
            $fila = mysqli_fetch_assoc($resultado);

            if(password_verify($clave, $fila['clave'])){
                $_SESSION['usuario'] = $fila['nombre'];
                $_SESSION['correo'] = $fila['correo'];
            } else {
                header('Location: index.html');
                exit();
            }
        }
    }
}
?>

<h1>Bienvenido <b><?php  echo $_SESSION['usuario'];?></b> tu correo es <?php echo $_SESSION["correo"]?> !</h1>

