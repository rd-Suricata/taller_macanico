
<?php
include '../db_connection.php';

$result = null;

if (isset($_GET['id'])) {
    // Si existe un 'id' en la URL, buscamos ese cliente específico
    $id = $_GET['id'];
    $query = "SELECT p.people_id, p.name, p.surname, p.email, p.phone_number, p.address, p.document_type, p.document_number,
                   e.job_title, e.salary, e.department
            FROM people p
            INNER JOIN employee e ON p.people_id = e.people_id
            WHERE p.people_id = $id"; // Asegúrate de usar p.people_id en lugar de people_id
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        // Solo hay un cliente si la consulta devuelve una fila
        $row = mysqli_fetch_array($result);
    } else {
        echo "<p>No se encontró un cliente con ese ID.</p>";
    }
} else {
    $query = "SELECT * FROM people";
    $result = mysqli_query($conn, $query);
}
?>

<?php include('../includes/header.php'); ?>

<div class="container mx-auto mt-8 p-4">
  <div>
    <h2 class="text-4xl font-bold mb-4">PERSONAL</h2>
  </div>

  <?php if (isset($row)): ?>
    <!-- Mostrar detalles del cliente específico -->
    <div class="bg-white p-4 shadow-md rounded">
      <h3 class="text-xl font-semibold">Detalles del Empleado</h3>
      <p><span class='font-bold text-blue-700'>ID: </span><?php echo htmlspecialchars($row['people_id']); ?></p>
      <p><span class='font-bold text-blue-700'>Nombre: </span><?php echo htmlspecialchars($row['name']); ?></p>
      <p><span class='font-bold text-blue-700'>Apellidos: </span><?php echo htmlspecialchars($row['surname']); ?></p>
      <p><span class='font-bold text-blue-700'>Email: </span><?php echo htmlspecialchars($row['email']); ?></p>
      <p><span class='font-bold text-blue-700'>Telefono: </span><?php echo htmlspecialchars($row['phone_number']); ?></p>
      <p><span class='font-bold text-blue-700'>Direccion: </span><?php echo htmlspecialchars($row['address']); ?></p>
      <p><span class='font-bold text-blue-700'>Tipo de documento: </span><?php echo htmlspecialchars($row['document_type']); ?></p>
      <p><span class='font-bold text-blue-700'>Numero de documento: </span><?php echo htmlspecialchars($row['document_number']); ?></p>
      <p><span class='font-bold text-blue-700'>Profesion: </span><?php echo htmlspecialchars($row['job_title']); ?></p>
      <p><span class='font-bold text-blue-700'>Salario: </span><?php echo htmlspecialchars($row['salary']); ?></p>
      <p><span class='font-bold text-blue-700'>Departamento: </span><?php echo htmlspecialchars($row['department']); ?></p>
    </div>

    <a href='./update.php?id=<?php echo $row['people_id']; ?>' class='text-blue-500 hover:text-black'>
        <i class='fas fa-edit text-3xl'></i>
    </a>
    <a href='./delete.php?id=<?php echo $row['people_id']; ?>' class='text-red-500 hover:text-blue-700'>
        <i class='fas fa-trash text-3xl'></i>
    </a>
  <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>
