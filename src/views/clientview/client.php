
<?php
include '../../db_connection.php';

$result = null;
$result2 = null;

if (isset($_GET['id'])) {
    // Si existe un 'id' en la URL, buscamos ese cliente específico
    $id = $_GET['id'];
    $query = "SELECT * FROM people WHERE people_id=$id";
    $query2 = "SELECT * FROM vehicle WHERE people_id=$id";
    $result = mysqli_query($conn, $query);
    $result2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "<p>No se encontró un cliente con ese ID.</p>";
    }
    if (mysqli_num_rows($result2) == 1) {
        $row2 = mysqli_fetch_array($result2);
    } else {
        echo "<p>No se encontró un vehiculo con ese ID.</p>";
    }
} else {
  echo "<p>No se encontró un ID.</p>";
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mx-auto mt-8 p-4">
  <div>
    <h2 class="text-4xl font-bold mb-4">CLIENTES</h2>
  </div>

  <?php if (isset($row)): ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
      <div class="bg-white p-4 shadow-md rounded">
        <div class='grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2'>
          <h3 class="text-xl font-semibold">Detalles del Cliente</h3>
          <div>
            <a href='./update.php?id=<?php echo $row['people_id']; ?>' class='text-blue-500 hover:text-black'>
                <i class='fas fa-edit text-3xl'></i>
            </a>
            <a href='./delete.php?id=<?php echo $row['people_id']; ?>' class='text-red-500 hover:text-green-500'>
                <i class='fas fa-trash text-3xl'></i>
            </a>
          </div>
        </div>
        <p><span class='font-bold text-blue-700'>ID: </span><?php echo htmlspecialchars($row['people_id']); ?></p>
        <p><span class='font-bold text-blue-700'>Nombre: </span><?php echo htmlspecialchars($row['name']); ?></p>
        <p><span class='font-bold text-blue-700'>Apellidos: </span><?php echo htmlspecialchars($row['surname']); ?></p>
        <p><span class='font-bold text-blue-700'>Email: </span><?php echo htmlspecialchars($row['email']); ?></p>
        <p><span class='font-bold text-blue-700'>Telefono: </span><?php echo htmlspecialchars($row['phone_number']); ?></p>
        <p><span class='font-bold text-blue-700'>Direccion: </span><?php echo htmlspecialchars($row['address']); ?></p>
        <p><span class='font-bold text-blue-700'>Tipo de documento: </span><?php echo htmlspecialchars($row['document_type']); ?></p>
        <p><span class='font-bold text-blue-700'>Numero de documento: </span><?php echo htmlspecialchars($row['document_number']); ?></p>

      </div>
  
      <?php if (isset($row2)): ?>
        <div class="bg-white p-4 shadow-md rounded">
          <div class='grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2'>
            <h3 class="text-xl font-semibold">Detalles del Vehiculo</h3>
            <div>
              <a href='./update.php?id=<?php echo $row['people_id']; ?>' class='text-blue-500 hover:text-black'>
                  <i class='fas fa-edit text-3xl'></i>
              </a>
              <a href='./delete.php?id=<?php echo $row['people_id']; ?>' class='text-red-500 hover:text-green-500'>
                  <i class='fas fa-trash text-3xl'></i>
              </a>
            </div>
          </div>
          <p><span class='font-bold text-blue-700'>ID: </span><?php echo htmlspecialchars($row2['vehicle_id']); ?></p>
          <p><span class='font-bold text-blue-700'>Numero de Placa: </span><?php echo htmlspecialchars($row2['number_plate']); ?></p>
          <p><span class='font-bold text-blue-700'>Marca: </span><?php echo htmlspecialchars($row2['brand']); ?></p>
          <p><span class='font-bold text-blue-700'>Modelo: </span><?php echo htmlspecialchars($row2['model']); ?></p>
          <p><span class='font-bold text-blue-700'>Color: </span><?php echo htmlspecialchars($row2['color']); ?></p>
          <p><span class='font-bold text-blue-700'>Tipo de Vehiculo: </span><?php echo htmlspecialchars($row2['vehicle_type']); ?></p>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<?php include('../../includes/footer.php'); ?>
