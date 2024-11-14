<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="admin-panel">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <a href="#">Panel de administración Coffe House</a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="gestion.php">Gestiona de personal</a></li>
                <!-- Enlace al blog de la página principal -->
                <li><a href="blog.html">Blog</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="main-header">
            <h1>Bienvenido al Panel de Administración</h1>
            <div class="user-info">
            </div>
        </header>

        <section class="overview">
            <h2>Resumen General</h2>
            <div class="stats">
                <div class="stat-card">
                    <h3>Total de Productos</h3>
                    <p>120</p>
                </div>
                <div class="stat-card">
                    <h3>Total de Servicios</h3>
                    <p>15</p>
                </div>
                <div class="stat-card">
                    <h3>Usuarios Activos</h3>
                    <p>350</p>
                </div>
            </div>
        </section>

        <section class="product-management">
            <h2>Gestionar Productos</h2>

            <!-- Formulario para agregar producto -->
            <form method="POST" action="admin_panel.php" class="product-form">
                <input type="text" name="productName" placeholder="Nombre del Producto" required>
                <input type="number" name="productPrice" placeholder="Precio" required>
                <input type="date" name="productDate" required>
                <button type="submit">Agregar Producto</button>
            </form>

            <!-- Tabla de productos -->
            <h3>Lista de Productos</h3>
            <table id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conectar a la base de datos cambiar los datos respectivos a la pc
                    $conn = new mysqli('localhost', 'root', '', 'coffee_house');

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Manejar el envío del formulario
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = $_POST['productName'];
                        $precio = $_POST['productPrice'];
                        $fecha = $_POST['productDate'];

                        // Inserción de datos
                        $sql = "INSERT INTO productos (nombre, precio, fecha) VALUES ('$nombre', '$precio', '$fecha')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<p>Producto agregado correctamente</p>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // Mostrar productos en la tabla
                    $sql = "SELECT * FROM productos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar datos de cada fila
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['nombre']}</td>
                                    <td>{$row['precio']}</td>
                                    <td>{$row['fecha']}</td>
                                    <td>
                                        <button onclick=\"editProduct({$row['id']})\">Editar</button>
                                        <button onclick=\"deleteProduct({$row['id']})\">Eliminar</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay productos en la base de datos.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

    </div> <!-- End Main Content -->

    <script src="script.js"></script>
</body>
</html>

