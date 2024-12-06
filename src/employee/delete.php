<?php
include("../db_connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero eliminamos al empleado de la tabla `employee`
    $query = "DELETE FROM employee WHERE people_id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    // Luego eliminamos la persona de la tabla `people`
    $query = "DELETE FROM people WHERE people_id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    // Redirigir después de la eliminación (opcional)
    header("Location: employee.php");  // Cambia "listado_empleados.php" por la página que quieras
    exit();
}
?>
