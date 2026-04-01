<?php
session_start();
include("config.php");

// Agregar tarea
if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $user_id = $_SESSION['id'];

    mysqli_query($conn, "INSERT INTO tareas (titulo, usuario_id) VALUES ('$titulo', $user_id)");
}

// Completar tarea
if (isset($_GET['completar'])) {
    $id = $_GET['completar'];
    mysqli_query($conn, "UPDATE tareas SET estado=1 WHERE id=$id");
}

// Eliminar tarea (solo admin)
if (isset($_GET['eliminar']) && $_SESSION['rol'] == 'admin') {
    $id = $_GET['eliminar'];
    mysqli_query($conn, "DELETE FROM tareas WHERE id=$id");
}

header("Location: dashboard.php");
?>