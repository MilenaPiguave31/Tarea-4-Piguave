<?php
session_start();
include("config.php");

if ($_POST) {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE usuario='$user' AND password='$pass'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        $data = mysqli_fetch_assoc($res);
        $_SESSION['usuario'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];
        $_SESSION['id'] = $data['id'];

        header("Location: dashboard.php");
    } else {
        echo "Usuario incorrecto";
    }
}
?>