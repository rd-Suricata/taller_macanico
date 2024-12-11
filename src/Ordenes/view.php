<?php
include '../db_connection.php';

// Capturamos los valores de los filtros si están presentes
$number_plate = isset($_GET['number_plate']) ? $_GET['number_plate'] : '';

$sql = "SELECT 
            wo.order_id, 
            wo.entry_date, 
            wo.delivery_date, 
            wo.status, 
            wo.observations, 
            c.client_id, 
            p.name AS client_name,  -- Nombre del cliente
            p.email AS client_email,  -- Correo del cliente
            e.employee_id, 
            ep.name AS employee_name,  -- Nombre del empleado
            v.vehicle_id, 
            v.number_plate AS vehicle_number_plate,  -- Matrícula del vehículo
            v.brand AS vehicle_brand,  -- Marca del vehículo
            v.model AS vehicle_model,  -- Modelo del vehículo
            v.color AS vehicle_color,  -- Color del vehículo
            v.vehicle_type AS vehicle_type  -- Tipo de vehículo
        FROM work_orders wo
        INNER JOIN client c ON wo.client_id = c.client_id
        INNER JOIN people p ON c.people_id = p.people_id  -- Relación entre cliente y la tabla people
        INNER JOIN employee e ON wo.employee_id = e.employee_id
        INNER JOIN people ep ON e.people_id = ep.people_id  -- Relación entre empleado y la tabla people
        INNER JOIN vehicle v ON wo.vehicle_id = v.vehicle_id";

// Añadimos el filtro si es necesario
$whereClauses = [];
if ($number_plate != '') {
    // Utilizamos real_escape_string para evitar inyecciones SQL
    $whereClauses[] = "v.number_plate LIKE '%" . $conn->real_escape_string($number_plate) . "%'";
}

// Si hay filtros, los añadimos a la consulta
if (count($whereClauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

// Ejecutamos la consulta
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<?php include('../includes/header.php'); ?>

<div class="container mx-auto mt-8 p-4">
    <h2 class="text-4xl font-bold mb-4">REGISTROS DE TRABAJO</h2>
    
    <!-- Formulario de filtros -->
    <form method="GET" action="" class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="flex space-x-6">
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

    <!-- Tabla de resultados -->
    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Cliente</th>
                <th class="py-3 px-6 text-left">Encargado</th>
                <th class="py-3 px-6 text-left">Vehiculo</th>
                <th class="py-3 px-6 text-left">Fecha de Entrada</th>
                <th class="py-3 px-6 text-left">Fecha de Salida</th>
                <th class="py-3 px-6 text-left">Estado</th>
                <th class="py-3 px-6 text-left">Observaciones</th>
                <th class="py-3 px-6 text-left">Opsiones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["order_id"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["client_name"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["employee_name"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["vehicle_number_plate"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["entry_date"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["delivery_date"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["status"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["observations"]) . "</td>";
                echo "<td class='py-3 px-6 text-left'>
                        <a href='views/clientview/client.php?id=" . $row['order_id'] . "' class='text-green-500 hover:text-blue-700'>
                            <i class='fas fa-plus text-3xl'></i>
                        </a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='py-3 px-6 text-center'>No hay ordenes registrados</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>

