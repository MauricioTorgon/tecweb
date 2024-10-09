<?php
// MySQL Conexion
$link = mysqli_connect("localhost", "root", "12345678a", "marketzone");

// Chequea coneccion
if($link === false){
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

// Verifica si se han enviado datos mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario usando $_POST
    $id_producto = $_POST['id']; // Recoge el ID del producto
    $nombre = mysqli_real_escape_string($link, $_POST['nombre']);
    $marca = mysqli_real_escape_string($link, $_POST['marca']);
    $modelo = mysqli_real_escape_string($link, $_POST['modelo']);
    $precio = mysqli_real_escape_string($link, $_POST['precio']);
    $detalles = mysqli_real_escape_string($link, $_POST['detalles']);
    $unidades = mysqli_real_escape_string($link, $_POST['unidades']);
    $imagen = mysqli_real_escape_string($link, $_POST['imagen']);

    // Construye la consulta SQL para actualizar el registro usando el ID
    $sql = "UPDATE productos 
            SET nombre = '$nombre', 
                marca = '$marca', 
                modelo = '$modelo', 
                precio = $precio, 
                detalles = '$detalles', 
                unidades = $unidades, 
                imagen = '$imagen' 
            WHERE id = $id_producto"; // Se usa el ID recibido del formulario

    // Ejecuta la consulta y verifica si fue exitosa
    if (mysqli_query($link, $sql)) {
        echo "Registro actualizado exitosamente.";
    } else {
        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($link);
    }
}

// Cierra la conexion
mysqli_close($link);
?>
