
<?php
include '../../db_connection.php';

// Inicializa la variable $result para evitar errores si no se encuentra un cliente
$result = null;

if (isset($_GET['id'])) {
    // Si existe un 'id' en la URL, buscamos ese cliente específico
    $id = $_GET['id'];
    $query = "SELECT * FROM people WHERE people_id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        // Solo hay un cliente si la consulta devuelve una fila
        $row = mysqli_fetch_array($result);
    } else {
        echo "<p>No se encontró un cliente con ese ID.</p>";
    }
} else {
    // Si no se pasa un 'id', mostramos todos los clientes
    $query = "SELECT * FROM people";
    $result = mysqli_query($conn, $query);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mx-auto mt-8 p-4">
  <div>
    <h2 class="text-4xl font-bold mb-4">CLIENTES</h2>
    <a href='views/clientview/client.php?id=" . $row['people_id'] . "' class='text-blue-500 hover:text-black'>
        <i class='fas fa-edit text-3xl'></i>
    </a>
    <a href='views/clientview/client.php?id=" . $row['people_id'] . "' class='text-red-500 hover:text-blue-700'>
        <i class='fas fa-trash text-3xl'></i>
    </a>
  </div>

  <?php if (isset($row)): ?>
    <!-- Mostrar detalles del cliente específico -->
    <div class="bg-white p-4 shadow-md rounded">
      <h3 class="text-xl font-semibold">Detalles del Cliente</h3>
      <p><span class='font-bold text-blue-700'>ID: </span><?php echo htmlspecialchars($row['people_id']); ?></p>
      <p><span class='font-bold text-blue-700'>Nombre: </span><?php echo htmlspecialchars($row['name']); ?></p>
      <p><span class='font-bold text-blue-700'>Apellidos: </span><?php echo htmlspecialchars($row['surname']); ?></p>
      <p><span class='font-bold text-blue-700'>Email: </span><?php echo htmlspecialchars($row['email']); ?></p>
      <p><span class='font-bold text-blue-700'>Telefono: </span><?php echo htmlspecialchars($row['phone_number']); ?></p>
      <p><span class='font-bold text-blue-700'>Direccion: </span><?php echo htmlspecialchars($row['address']); ?></p>
      <p><span class='font-bold text-blue-700'>Tipo de documento: </span><?php echo htmlspecialchars($row['document_type']); ?></p>
      <p><span class='font-bold text-blue-700'>Numero de documento: </span><?php echo htmlspecialchars($row['document_number']); ?></p>
      <p><span class='font-bold text-blue-700'>Fecha de registro: </span><?php echo htmlspecialchars($row['people_registration']); ?></p>
    </div>
  <?php endif; ?>
</div>

<?php include('../../includes/footer.php'); ?>
