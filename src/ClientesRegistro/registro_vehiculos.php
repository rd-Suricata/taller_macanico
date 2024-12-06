<?php

include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number_plate = $_POST['number_plate'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $color = $_POST['color'];
    $vehicle_type = $_POST['vehicle_type'];

    $check_sql = "SELECT * FROM vehicle WHERE number_plate = '$number_plate'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $mensaje = "Ya existe un vehículo con esa matrícula.";
    } else {
        $people_sql = "SELECT people_id FROM people ORDER BY people_id DESC LIMIT 1";
        $people_result = $conn->query($people_sql);

        if ($people_result->num_rows > 0) {
            $row = $people_result->fetch_assoc();
            $people_id = $row['people_id'];

            $sql = "INSERT INTO vehicle (people_id, number_plate, brand, model, color,  vehicle_type) 
                    VALUES ('$people_id', '$number_plate', '$brand', '$model', '$color', '$vehicle_type')";

            if ($conn->query($sql) === TRUE) {
                $mensaje = "Vehículo registrado con éxito.";
            } else {
                $mensaje = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $mensaje = "Error: No se ha encontrado ninguna persona registrada.";
        }
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
          <label>Placa</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="number_plate" type="text" name="number_plate" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label>Marca</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="brand" type="text" name="brand" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label>Modelo</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="model" type="number" name="model" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="address">Color</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="color" type="text" name="color" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label>Tipo</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="vehicle_type" type="text" name="vehicle_type" required>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <button href="registro_vehiculos" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Registrar Vehiculo
        </button>
      </div>
    </form>
    <a href="./registro_estado.php" class="inline-block shadow border rounded bg-green-500 font-bold text-white py-2 px-4 mx-6 hover:bg-green-700 text-center">
      Registrar Estado
    </a>
  </div>
<?php include('../includes/footer.php'); ?>

