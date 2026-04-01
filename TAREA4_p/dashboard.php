<?php
session_start();
include("config.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
?>

<h2>Bienvenido <?php echo $_SESSION['usuario']; ?></h2>

<form method="POST" action="tareas.php">
    <input type="text" name="titulo" placeholder="Nueva tarea" required>
    <button type="submit" name="agregar">Agregar</button>
</form>

<h3>Lista de tareas</h3>

<?php
$id = $_SESSION['id'];
$res = mysqli_query($conn, "SELECT * FROM tareas WHERE usuario_id=$id");

while ($row = mysqli_fetch_assoc($res)) {
    echo "<p>";
    echo $row['titulo'];

    // Marcar como completada
    echo " <a href='tareas.php?completar=".$row['id']."'>✔</a>";

    // Solo admin puede eliminar
    if ($_SESSION['rol'] == 'admin') {
        echo " <a href='tareas.php?eliminar=".$row['id']."'>❌</a>";
    }

    echo "</p>";
}
?>