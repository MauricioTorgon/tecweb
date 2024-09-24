<?php
// Mostrar datos recibidos para depuración
echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

// Establecemos el encabezado para codificación UTF-8
header("Content-Type: text/html; charset=utf-8");

// Validar si los campos han sido enviados antes de acceder a ellos
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$marca  = isset($_POST['marca']) ? $_POST['marca'] : null;
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : null;
$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
$detalles = isset($_POST['detalles']) ? $_POST['detalles'] : null;
$unidades = isset($_POST['unidades']) ? $_POST['unidades'] : null;
$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;

// Verificar que todos los campos requeridos están presentes
if (!$nombre || !$marca || !$modelo || !$precio || !$detalles || !$unidades || !$imagen) {
    die('<p>Error: Todos los campos son obligatorios.</p>');
}

// Validación de imagen subida
$directorioImagen = 'img/';
$imagenRuta = $directorioImagen . basename($imagen);

// Mover imagen subida al servidor
if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenRuta)) {
    die('<p>Error al subir la imagen.</p>');
}

// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');
if ($link->connect_errno) {
    die('<p>Falló la conexión: ' . $link->connect_error . '</p>');
}

// Validar que el nombre, modelo y marca no existan ya en la BD
$sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo '<p>Ya existe un producto con el mismo nombre, marca y modelo.</p>';
} else {
    // Insertar nuevo producto en la base de datos con la columna 'eliminado' en 0
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
            VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagenRuta', 0)";
    
    if ($link->query($sql)) {
        echo '<p>Producto registrado con éxito:</p>';
        echo '<ul>';
        echo '<li>Nombre: ' . $nombre . '</li>';
        echo '<li>Marca: ' . $marca . '</li>';
        echo '<li>Modelo: ' . $modelo . '</li>';
        echo '<li>Precio: ' . $precio . '</li>';
        echo '<li>Detalles: ' . $detalles . '</li>';
        echo '<li>Unidades: ' . $unidades . '</li>';
        echo '<li>Imagen: <img src="' . $imagenRuta . '" alt="Imagen del producto" width="100" /></li>';
        echo '</ul>';
    } else {
        echo '<p>Error al insertar el producto: ' . $link->error . '</p>';
    }
}

$link->close();
?>
