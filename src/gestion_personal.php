<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $surname = $_POST['apellido'];
  $email = $_POST['cargo'];
  $phone_number = $_POST['telefono'];
  $address = $_POST['email'];

  $sql = "INSERT INTO people (name, surname, email, phone_number, address) 
    VALUES ('$name', '$surname', '$email', '$phone_number', '$address')";

  if ($conn->query($sql) === TRUE) {
    $mensaje = "Empleado registrado con éxito.";
  } else {
    $mensaje = "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Obtener lista de empleados
$empleados_sql = "SELECT * FROM people";
#$empleados_result = $conn->query($empleado_sql);
?>

<?php include('includes/header.php'); ?>
  <div class="container mx-auto mt-8 p-4">
    <h2 class="text-4xl font-bold mb-4">GESTION PERSONAL</h2>
    <?php if (isset($mensaje)): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?php echo $mensaje; ?></span>
      </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="flex flex-wrap -mx-2 mb-4">
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="nombre">Nombre</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="nombre" type="text" name="nombre" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="apellido">Apellido</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="apellido" type="text" name="apellido" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="email">Email</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="cargo" type="text" name="cargo" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="phone_number">Teléfono</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="telefono" type="text" name="telefono" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="address">Dirección</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="correo" type="text" name="correo" required>
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="job_title">Cargo</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="direccion" type="text" name="direccion" required>
        </div>

        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="salary">Salario</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="direccion" type="text" name="direccion" required>
        </div>

        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="departament">Departamento</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="direccion" type="text" name="direccion" required>
        </div>

        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="document_number">CI</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="direccion" type="text" name="direccion" required>
        </div>
      </div>
    
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Registrar Empleado
        </button>
      </div>
    </form>
    <h3 class="text-2xl font-bold mt-8 mb-4">Lista de Empleados</h3>
    <table class="w-full bg-white shadow-md rounded">
      <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
          <th class="py-3 px-6 text-left">Nombre</th>
          <th class="py-3 px-6 text-left">Apellido</th>
         <th class="py-3 px-6 text-left">Cargo</th>
          <th class="py-3 px-6 text-left">Teléfono</th>
          <th class="py-3 px-6 text-left">Email</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 text-sm font-light">
        <?php
        if ($empleados_result->num_rows > 0) {
          while($row = $empleados_result->fetch_assoc()) {
            echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>";
            echo "<td class='py-3 px-6 text-left whitespace-nowrap'>" . $row["Nombre"] . "</td>";
            echo "<td class='py-3 px-6 text-left'>" . $row["Apellido"] . "</td>";
            echo "<td class='py-3 px-6 text-left'>" . $row["Cargo"] . "</td>";
            echo "<td class='py-3 px-6 text-left'>" . $row["Teléfono"] . "</td>";
            echo "<td class='py-3 px-6 text-left'>" . $row["Email"] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='py-3 px-6 text-center'>No hay empleados registrados</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
