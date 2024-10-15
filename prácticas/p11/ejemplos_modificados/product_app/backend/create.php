<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        $sql = "SELECT * FROM productos WHERE nombre = ? and eliminado = 0";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $jsonOBJ->nombre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "El producto ya existe. Por favor, introduce un producto diferente";
        } else {
            $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', '0')";
            if ( $conexion->query($sql) ) 
            {
                echo 'Producto insertado con ID: '.$conexion->insert_id;
            }
            else
            {
                echo 'El Producto no pudo ser insertado';
            }
        }
    }
?>