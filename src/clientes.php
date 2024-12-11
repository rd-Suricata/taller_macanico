<?php
include 'db_connection.php';

// Capturamos los valores de los filtros si están presentes
$document_number = isset($_GET['document_number']) ? $_GET['document_number'] : '';
$number_plate = isset($_GET['number_plate']) ? $_GET['number_plate'] : '';

// Consulta SQL base
$sql = "SELECT p.people_id, p.name, p.surname, p.email, p.phone_number,
               v.number_plate, p.document_type, p.document_number
        FROM people p
        LEFT JOIN vehicle v ON p.people_id = v.people_id
        INNER JOIN client c ON p.people_id = c.people_id";

// Si se ha proporcionado un número de documento, añadimos una cláusula WHERE
$whereClauses = [];
if ($document_number != '') {
    $whereClauses[] = "p.document_number LIKE '%" . $conn->real_escape_string($document_number) . "%'";
}
if ($number_plate != '') {
    $whereClauses[] = "v.number_plate LIKE '%" . $conn->real_escape_string($number_plate) . "%'";
}

// Si hay filtros, añadimos la cláusula WHERE
if (count($whereClauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<?php include('includes/header.php'); ?>

<div class="container mx-auto mt-8 p-4">
    <h2 class="text-4xl font-bold mb-4">CLIENTES</h2>
    <!-- Formulario de filtros -->
    <form method="GET" action="" class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="flex space-x-6">
            <!-- Filtro por Número de Documento -->
            <div class="flex-1">
                <label for="document_number" class="text-lg font-medium text-gray-700">Filtrar por número de documento:</label>
                <input type="text" id="document_number" name="document_number" 
                       class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Número de documento" 
                       value="<?php echo isset($_GET['document_number']) ? htmlspecialchars($_GET['document_number']) : ''; ?>" />
            </div>
            <!-- Filtro por Número de Matrícula -->
            <div class="flex-1">
                <label for="number_plate" class="text-lg font-medium text-gray-700">Filtrar por matrícula:</label>
                <input type="text" id="number_plate" name="number_plate" 
                       class="px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Número de matrícula" 
                       value="<?php echo isset($_GET['number_plate']) ? htmlspecialchars($_GET['number_plate']) : ''; ?>" />
            </div>
        </div>

        <!-- Botón de Filtro -->
        <div class="mt-4 flex justify-center">
            <button type="submit" class="px-6 py-2 bg-blue-500 font-bold text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Filtrar
            </button>
            <a href="./ClientesRegistro/registro_clientes.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mx-4 rounded focus:shadow-outline">
              Agregar
            </a>
        </div>
    </form>

    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Nombre</th>
                <th class="py-3 px-6 text-left">Apellidos</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Telefono</th>
                <th class="py-3 px-6 text-left">Documento</th>
                <th class="py-3 px-6 text-left">Numero</th>
                <th class="py-3 px-6 text-left">Matricula</th>
                <th class="py-3 px-6 text-left">Opsiones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["people_id"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["surname"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["phone_number"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["document_type"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["document_number"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["number_plate"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>
                        <a href='views/clientview/client.php?id=" . $row['people_id'] . "' class='text-green-500 hover:text-blue-700'>
                            <i class='fas fa-plus text-3xl'></i>
                        </a>
                      </td>";
        
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='py-3 px-6 text-center'>No hay clientes registrados</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>

