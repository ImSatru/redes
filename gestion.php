<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_house";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['employeeName'];
    $cargo = $_POST['employeePosition'];
    $email = $_POST['employeeEmail'];
    $fecha_contratacion = $_POST['employeeHireDate'];

    // Insertar empleado
    $sql = "INSERT INTO empleados (nombre, cargo, email, fecha_contratacion) VALUES ('$nombre', '$cargo', '$email', '$fecha_contratacion')";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener empleados
$sql = "SELECT * FROM empleados";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Personal</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="admin-panel">

    <aside class="sidebar">
        <div class="logo">
        </div>
        <nav class="sidebar-nav">
        </nav>
    </aside>

    <div class="main-content">
        <header class="main-header">
            <h1>Gestión de Personal</h1>
        </header>

        <section class="employee-management">
            <h2>Administrar Empleados</h2>

            <!-- Formulario para agregar empleado -->
            <form id="employeeForm" class="employee-form" method="POST" action="">
                <input type="text" name="employeeName" placeholder="Nombre del Empleado" required>
                <input type="text" name="employeePosition" placeholder="Cargo del Empleado" required>
                <input type="email" name="employeeEmail" placeholder="Correo Electrónico" required>
                <input type="date" name="employeeHireDate" required>
                <button type="submit">Agregar Empleado</button>
            </form>

            <!-- Tabla de empleados -->
            <h3>Lista de Empleados</h3>
            <table id="employeeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Email</th>
                        <th>Fecha de Contratación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["nombre"] . "</td>
                                <td>" . $row["cargo"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["fecha_contratacion"] . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay empleados registrados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="scrips.js"></script>
</body>
</html>

<?php
$conn->close();
?>
