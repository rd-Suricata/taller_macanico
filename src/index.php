<?php include 'db_connection.php';?>
<?php include('includes/header.php'); ?>

    <div class="container mx-auto mt-8 p-4">
        <h2 class="text-3xl font-bold mb-4">Panel General</h2>
        <p class="mb-4">Seleccione una opción del menú para comenzar.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold mb-2">Personal</h3>
                <p>Gestionar Personas</p>
                <a href="clientes.php" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver Clientes</a>
                <a href="employee/employee.php" class="mt-2 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ver Personal</a>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold mb-2">Órdenes de Trabajo</h3>
                <p>Crear y gestionar órdenes de trabajo.</p>
                <a href="ordenes.php" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver Órdenes</a>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold mb-2">Inventario</h3>
                <p>Gestionar el inventario de productos.</p>
                <a href="inventario.php" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver Inventario</a>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold mb-2">Facturas</h3>
                <p>Ver y gestionar facturas y pagos.</p>
                <a href="facturas.php" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver Facturas</a>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

