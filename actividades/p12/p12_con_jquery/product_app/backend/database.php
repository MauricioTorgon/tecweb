<?php
// Conexión a la base de datos
$conexion = @mysqli_connect(
    'localhost',
    'root',
    '12345678a',
    'marketzone'
);

// Verificar la conexión
if(!$conexion) {
    die('¡Base de datos NO conectada!');
}
/*
// Función para listar productos NO eliminados
function listarProductos() {
    global $conexion;
    $query = "SELECT * FROM productos WHERE eliminado = 0"; // Cambia 'productos' si el nombre de la tabla es diferente
    $result = mysqli_query($conexion, $query);
    $productos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }
    echo json_encode($productos);
}

// Función para buscar productos
function buscarProducto($search) {
    global $conexion;
    $search = mysqli_real_escape_string($conexion, $search);
    $query = "SELECT * FROM productos WHERE eliminado = 0 AND nombre LIKE '%$search%'";
    $result = mysqli_query($conexion, $query);
    $productos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }
    echo json_encode($productos);
}

// Función para agregar un nuevo producto
function agregarProducto($producto) {
    global $conexion;
    $nombre = mysqli_real_escape_string($conexion, $producto['nombre']);
    $precio = $producto['precio'];
    $unidades = $producto['unidades'];
    $modelo = mysqli_real_escape_string($conexion, $producto['modelo']);
    $marca = mysqli_real_escape_string($conexion, $producto['marca']);
    $detalles = mysqli_real_escape_string($conexion, $producto['detalles']);
    $imagen = mysqli_real_escape_string($conexion, $producto['imagen']);

    $query = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) 
              VALUES ('$nombre', '$precio', '$unidades', '$modelo', '$marca', '$detalles', '$imagen')";

    if (mysqli_query($conexion, $query)) {
        $response = ['status' => 'success', 'message' => 'Producto agregado correctamente'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error al agregar el producto'];
    }

    echo json_encode($response);
}

// Función para eliminar un producto
function eliminarProducto($id) {
    global $conexion;
    $query = "UPDATE productos SET eliminado = 1 WHERE id = $id";
    if (mysqli_query($conexion, $query)) {
        $response = ['status' => 'success', 'message' => 'Producto eliminado correctamente'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error al eliminar el producto'];
    }
    echo json_encode($response);
}
?>
*/