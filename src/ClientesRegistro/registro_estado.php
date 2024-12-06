<?php

include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $general_status = $_POST['general_status'];
    $repair_description= $_POST['repair_description'];
    
    $vehicle_sql = "SELECT vehicle_id FROM vehicle ORDER BY vehicle_id DESC LIMIT 1";
    $check_result = $conn->query($vehicle_sql);

    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        $vehicle_id = $row['vehicle_id'];

        $sql = "INSERT INTO vehicle_status (vehicle_id, general_status, repair_description) 
                VALUES ('$vehicle_id', '$general_status', '$repair_description')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Vehículo registrado con éxito.";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
      $mensaje = "Error: No se ha encontrado ninguna persona registrada.";
    }
}
?>

<?php include('../includes/header.php'); ?>
 
  <div class="container mx-auto mt-8 p-4">
    <h2 class="text-4xl font-bold mb-4">REGISTRO VEHICULOS</h2>
    <?php if (isset($mensaje)): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?php echo $mensaje; ?></span>
      </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="flex flex-wrap -mx-2 mb-4">
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label>Estado General</label>
          <textarea class="shadow border rounded w-full py-2 px-3" id="general_status" type="text" name="general_status" required></textarea>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label>Detalle reparacion</label>
          <textarea class="shadow border rounded w-full py-2 px-3" id="repair_description" type="text" name="repair_description" required></textarea>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <button href="registro_vehiculos" class="bg-blue-500 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Listo
        </button>
      </div>
    </form>
    <a href="../clientes.php" class="inline-block shadow border rounded bg-green-500 font-bold text-white py-2 px-4 mx-6 hover:bg-green-700 text-center">
      Salir
    </a>
  </div>
<?php include('../includes/footer.php'); ?>

