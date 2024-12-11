<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Captura los datos del formulario
  $employee_id = $_POST['employee_id'];  // Ahora está correcto
  $entry_date = $_POST['entry_date'];
  $delivery_date = $_POST['delivery_date'];
  $status = $_POST['status'];
  $observations = $_POST['observations'];

  // Obtener el último ID de la tabla `client`
  $sql_last_client = "SELECT client_id FROM client ORDER BY client_id DESC LIMIT 1";
  $result_client = $conn->query($sql_last_client);
  if ($result_client->num_rows > 0) {
    $row_client = $result_client->fetch_assoc();
    $client_id = $row_client['client_id'];  // Último ID del cliente
  }

  // Obtener el último ID de la tabla `vehicle`
  $sql_last_vehicle = "SELECT vehicle_id FROM vehicle ORDER BY vehicle_id DESC LIMIT 1";
  $result_vehicle = $conn->query($sql_last_vehicle);
  if ($result_vehicle->num_rows > 0) {
    $row_vehicle = $result_vehicle->fetch_assoc();
    $vehicle_id = $row_vehicle['vehicle_id'];  // Último ID del vehículo
  }

  // Verificar que employee_id no esté vacío y sea un valor válido
  if (empty($employee_id) || !is_numeric($employee_id)) {
    $mensaje = "Empleado no válido.";
  } else {
    // Insertar en la tabla `work_orders`
    $sql_work_order = "INSERT INTO work_orders (client_id, employee_id, vehicle_id, entry_date, delivery_date, status, observations) 
                       VALUES ('$client_id', '$employee_id', '$vehicle_id', '$entry_date', '$delivery_date', '$status', '$observations')";

    if ($conn->query($sql_work_order) === TRUE) {
      $mensaje = "Orden de trabajo registrada con éxito.";
    } else {
      // Si hubo un error al registrar la orden de trabajo
      $mensaje = "Error al registrar la orden de trabajo: " . $conn->error;
    }
  }
}
?>

<?php include('../includes/header.php'); ?>
 
<div class="container mx-auto mt-8 p-4">
  <h2 class="text-4xl font-bold mb-4">ORDENES DE TRABAJO</h2>
  <?php if (isset($mensaje)): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline"><?php echo $mensaje; ?></span>
    </div>
  <?php endif; ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="flex flex-wrap -mx-2 mb-4">
      <div class="w-full sm:w-1/3 px-2 mb-4">
        <label for="employee_id">Empleado</label>
        <select class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="employee_id" name="employee_id" required>
          <option value="2">Ana (Mecanico)</option>
          <option value="3">Carlitos (Mecanico)</option>
          <option value="4">Maria (Mecanico)</option>
          <option value="5">Luis (Electricista)</option>
          <option value="6">Elena (Electricista)</option>
          <option value="7">Pedro (Electricista)</option>
          <option value="61">Luis (Ingeniero)</option>
        </select>
      </div>

      <div class="w-full sm:w-1/3 px-2 mb-4">
        <label for="entry_date">Entrada</label>
        <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="entry_date" type="text" name="entry_date" required>
      </div>

      <div class="w-full sm:w-1/3 px-2 mb-4">
        <label for="delivery_date">Salida</label>
        <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="delivery_date" type="text" name="delivery_date" required>
      </div>

      <div class="w-full sm:w-1/3 px-2 mb-4">
        <label for="status">Estado</label>
        <select class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="status" name="status" required>
          <option value="pending">Pendiente</option>
          <option value="in progress">En progreso</option>
          <option value="completed">Completado</option>
        </select>
      </div>

      <div class="w-full sm:w-1/3 px-2 mb-4">
        <label>Observaciones</label>
        <textarea class="shadow border rounded w-full py-2 px-3" id="observations" type="text" name="observations" required></textarea>
      </div>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Registrar Orden
      </button>
    </div>
  </form>
  <a href="../clientes.php" class="inline-block shadow border rounded bg-green-500 font-bold text-white py-2 px-4 mx-6 hover:bg-green-700 text-center">
    Inicio
  </a>
</div>
<?php include('../includes/footer.php'); ?>

