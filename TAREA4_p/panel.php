<?php
session_start();
include("config.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Tareas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Panel de Usuario</h2>

<p>Bienvenido: <strong><?php echo $_SESSION['usuario']; ?></strong></p>
<p>Rol: <strong><?php echo $_SESSION['rol']; ?></strong></p>

<a href="logout.php">Cerrar sesión</a>

<hr>

<!-- FORMULARIO -->
<form method="POST" action="tareas.php">
    <input type="text" name="titulo" placeholder="Nueva tarea" required>
    <button type="submit" name="agregar">Agregar</button>
</form>

<hr>

<h3>Lista de tareas</h3>

<?php
$id = $_SESSION['id'];
$res = mysqli_query($conn, "SELECT * FROM tareas WHERE usuario_id=$id");

while ($row = mysqli_fetch_assoc($res)) {

    echo "<div style='margin:10px;'>";

    // Estado visual
    if ($row['estado']) {
        echo "<span style='text-decoration:line-through; color:gray;'>";
    }

    echo $row['titulo'];

    if ($row['estado']) {
        echo "</span>";
    }

    // Completar tarea
    if (!$row['estado']) {
        echo " <a href='tareas.php?completar=".$row['id']."'>✔</a>";
    }

    // Eliminar solo admin
    if ($_SESSION['rol'] == 'admin') {
        echo " <a href='tareas.php?eliminar=".$row['id']."' onclick='return confirm(\"¿Eliminar tarea?\")'>❌</a>";
    }

    echo "</div>";
}
?>

</body>
</html>