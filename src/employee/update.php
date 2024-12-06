<?php
include '../db_connection.php';

$name = '';
$surname= '';
$email= '';
$phone_number= '';
$address= '';
$document_type= '';
$document_number= '';
$people_registration= '';
$job_title= '';
$salary= '';
$department= '';

if (isset($_GET['id'])) {
  // Obtener el parámetro 'id'
  $id = $_GET['id'];

  // Sanitización del ID (por si es un número)
  $id = mysqli_real_escape_string($conn, $id);

  // Consulta SQL para obtener los datos de la persona y el empleado
  $query = "SELECT p.people_id, p.name, p.surname, p.email, p.phone_number, p.address, p.document_type, p.document_number,
                   e.job_title, e.salary, e.department
            FROM people p
            INNER JOIN employee e ON p.people_id = e.people_id
            WHERE p.people_id = '$id'"; // Asegúrate de que $id esté en comillas si es un valor numérico

  // Ejecutar la consulta
  $result = mysqli_query($conn, $query); // --> linea 32

  // Verificar si se encontró una fila
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $surname = $row['surname'];
    $email = $row['email'];
    $phone_number = $row['phone_number'];
    $address = $row['address'];
    $document_type = $row['document_type'];
    $document_number = $row['document_number'];
    $job_title = $row['job_title'];
    $salary = $row['salary'];
    $department = $row['department'];
  } else {
    // Si no se encuentra el id en la base de datos
    echo "No se encontró el registro con ese ID.";
  }
}


if (isset($_POST['update'])) {
  // Obtener los datos del formulario
  $id = $_GET['id'];
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $surname = mysqli_real_escape_string($conn, $_POST['surname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $document_type = mysqli_real_escape_string($conn, $_POST['document_type']);
  $document_number = mysqli_real_escape_string($conn, $_POST['document_number']);
  $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
  $salary = mysqli_real_escape_string($conn, $_POST['salary']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);

  // Consulta SQL para actualizar los datos en la tabla people
  $query = "UPDATE people SET 
    name = '$name', 
    surname = '$surname', 
    email = '$email', 
    phone_number = '$phone_number', 
    address = '$address',
    document_type = '$document_type', 
    document_number = '$document_number' 
    WHERE people_id = $id"; // Usar 'people_id' en vez de 'id'

  // Ejecutar la consulta
  if (mysqli_query($conn, $query)) {
    echo "Datos actualizados correctamente.";
  } else {
    echo "Error al actualizar los datos: " . mysqli_error($conn);
  }

  // Si también quieres actualizar la tabla employee, deberías hacer una segunda consulta.
  $query_employee = "UPDATE employee SET 
    job_title = '$job_title', 
    salary = '$salary', 
    department = '$department' 
    WHERE people_id = $id";

  if (mysqli_query($conn, $query_employee)) {
    echo "Datos de empleado actualizados correctamente.";
  } else {
    echo "Error al actualizar los datos del empleado: " . mysqli_error($conn);
  }

  header("Location: employee.php");  // Cambia "listado_empleados.php" por la página que quieras
  exit();
}

?>

<?php include('../includes/header.php'); ?>
 
  <div class="container mx-auto mt-8 p-4">
    <h2 class="text-4xl font-bold mb-4">REGISTRO PERSONAL</h2>
    <?php if (isset($mensaje)): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?php echo $mensaje; ?></span>
      </div>
    <?php endif; ?>
    <form action="./update.php?id=<?php echo $_GET['id']; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="flex flex-wrap -mx-2 mb-4">
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="nombre">Nombre</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="name" type="text" name="name" required value="<?php echo $name; ?>">
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="apellido">Apellido</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="surname" type="text" name="surname" required value="<?php echo $surname; ?>">
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="email">Email</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="email" type="email" name="email" required value="<?php echo $email; ?>">
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="phone_number">Teléfono</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="phone_number" type="number" name="phone_number" required value="<?php echo $phone_number; ?>">
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="address">Dirección</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="address" type="text" name="address" required value="<?php echo $address; ?>">
        </div>
    
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="document_type">Tipo Documento</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="document_type" type="text" name="document_type" required value="<?php echo $document_type; ?>">
        </div>

        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="document_number">Numero Documento</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="document_number" type="number" name="document_number" required value="<?php echo $document_number; ?>">
        </div>
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="job_title">Profesion</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="job_title" type="text" name="job_title" required value="<?php echo $job_title; ?>">
        </div>
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="salary">Salario</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="salary" type="number" name="salary" required value="<?php echo $salary; ?>">
        </div>
        <div class="w-full sm:w-1/3 px-2 mb-4">
          <label for="department">Departamento</label>
          <input class="shadow border rounded w-full py-2 px-3 focus:outline-none" id="department" type="text" name="department" required value="<?php echo $department; ?>">
        </div>
      </div>
    
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="update">
          Actualizar Personal
        </button>
      </div>
    </form>
    <a href="./employee.php" class="inline-block shadow border rounded bg-green-500 font-bold text-white py-2 px-4 mx-6 hover:bg-green-700 text-center">
      Cancelar
    </a>
  </div>
<?php include('../includes/footer.php'); ?>
