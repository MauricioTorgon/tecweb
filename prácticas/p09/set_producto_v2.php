<?php
// Conexión a la base de datos 
$host = 'localhost';
$dbname = 'marketzone';
$user = 'root';
$pass = '12345678a';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Función para validar los datos
function validarDatos($nombre, $marca, $modelo, $pdo) {
    $query = "SELECT COUNT(*) FROM productos WHERE nombre = :nombre AND marca = :marca AND modelo = :modelo";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->execute();
    $existe = $stmt->fetchColumn();

    return $existe > 0;
}

// Validar que se envió el formulario correctamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    $imagen = $_POST['imagen'];

    // Validar que no exista ya un producto con el mismo nombre, marca y modelo
    if (validarDatos($nombre, $marca, $modelo, $pdo)) {
        echo <<<HTML
        <html>
        <head><title>Error</title></head>
        <body>
            <h2>Error al insertar el producto</h2>
            <p>El producto con el nombre, marca y modelo ya existe en la base de datos.</p>
            <a href="formulario_productos.html">Volver al formulario</a>
        </body>
        </html>
HTML;
    } else {
        // Insertar el nuevo producto en la base de datos, con 'eliminado' en 0
        //$query = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
        //          VALUES (:nombre, :marca, :modelo, :precio, :detalles, :unidades, :imagen, 0)";
        $query = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                    VALUES (:nombre, :marca, :modelo, :precio, :detalles, :unidades, :imagen)";
        $stmt = $pdo->prepare($query);
        
        try {
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':detalles', $detalles);
            $stmt->bindParam(':unidades', $unidades);
            $stmt->bindParam(':imagen', $imagen);
            
            $stmt->execute();

            // Mostrar un resumen de los datos insertados
            echo <<<HTML
            <html>
            <head><title>Producto Insertado</title></head>
            <body>
                <h2>Producto registrado con éxito</h2>
                <p><strong>Nombre:</strong> {$nombre}</p>
                <p><strong>Marca:</strong> {$marca}</p>
                <p><strong>Modelo:</strong> {$modelo}</p>
                <p><strong>Precio:</strong> {$precio}</p>
                <p><strong>Detalles:</strong> {$detalles}</p>
                <p><strong>Unidades:</strong> {$unidades}</p>
                <p><strong>Ruta de la imagen:</strong> {$imagen}</p>
                <p><strong>Estado (Eliminado):</strong> 0</p>
                <a href="formulario_productos.html">Registrar otro producto</a>
            </body>
            </html>
HTML;
        } catch (PDOException $e) {
            // Mostrar mensaje de error si ocurre algún problema al insertar
            echo <<<HTML
            <html>
            <head><title>Error</title></head>
            <body>
                <h2>Error al insertar el producto</h2>
                <p>Error: {$e->getMessage()}</p>
                <a href="formulario_productos.html">Volver al formulario</a>
            </body>
            </html>
HTML;
        }
    }
} else {
    // Redirigir al formulario si no se ha enviado un POST
    header('Location: formulario_productos.html');
    exit();
}
?>
