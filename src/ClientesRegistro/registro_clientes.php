<?php
include '../db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Captura los datos del formulario
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $document_type = $_POST['document_type'];
  $document_number = $_POST['document_number'];

  // Verificar si ya existe un cliente con ese número de documento
  $check_sql = "SELECT * FROM people WHERE document_number = '$document_number'";
  $check_result = $conn->query($check_sql);

  if ($check_result->num_rows > 0) {
    $mensaje = "Ya existe un cliente con ese documento de identificación.";
  } else {
    // Insertar en la tabla `people`
    $sql_people = "INSERT INTO people (name, surname, email, phone_number, address, document_type, document_number) 
                   VALUES ('$name', '$surname', '$email', '$phone_number', '$address', '$document_type', '$document_number')";
    
    if ($conn->query($sql_people) === TRUE) {
      // Obtener el ID del nuevo registro en la tabla `people`
      $people_id = $conn->insert_id;  // Esto obtiene el último ID insertado
      
      // Insertar en la tabla `client` usando el `people_id` obtenido
      $sql_client = "INSERT INTO client (people_id) VALUES ('$people_id')";
      
      if ($conn->query($sql_client) === TRUE) {
        $mensaje = "Cliente registrado con éxito en ambas tablas.";
      } else {
        // Si hubo error en la inserción en la tabla `client`
        $mensaje = "Error al registrar el cliente en la tabla client: " . $conn->error;
      }
    } else {
      // Si hubo error en la inserción en la tabla `people`
      $mensaje = "Error al registrar el cliente en la tabla people: " . $conn->error;
    }
  }
}

?>

<?php include('../includes/header.php'); ?>
 
  <div class="container mx-auto mt-8 p-4">
    <h2 class="text-4xl font-bold mb-4">REGISTRO CLIENTES</h2>
    <?php if (isset($mensaje)): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?php echo $mensaje; ?></span>
      </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="flex flex-wrap -mx-2 mb-4">
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="nombre">Nombre</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="name" type="text" name="name" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="apellido">Apellido</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="surname" type="text" name="surname" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="email">Email</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="email" type="email" name="email" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="phone_number">Teléfono</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="phone_number" type="number" name="phone_number" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="address">Dirección</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="address" type="text" name="address" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="job_title">Tipo Documento</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="document_type" type="text" name="document_type" required>
        </div>

        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="salary">Numero Documento</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="document_number" type="number" name="document_number" required>
        </div>
      </div>
    
      <div class="flex items-center justify-between">
        <button href="registro_vehiculos" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Registrar Cliente
        </button>
      </div>
    </form>
    <a href="./registro_vehiculos.php" class="inline-block shadow border rounded bg-green-500 font-bold text-white py-2 px-4 mx-6 hover:bg-green-700 text-center">
      Registrar Vehiculo
    </a>
  </div>
<?php include('../includes/footer.php'); ?>
