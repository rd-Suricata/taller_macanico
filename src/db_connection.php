<?php
$servername = "localhost"; 
$username = "root";   
$password = ""; 
$database = "mecanic_shop"; 

// Crear la conexión
$conn = new mysqli($servername , $username, $password, $database);

// Verificar la conexión
if ($conn->connect_errno) {
    die("Conexión fallida: " . $conn->connect_errno);
}
?>
