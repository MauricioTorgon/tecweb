<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    
    // SE VERIFICA HABER RECIBIDO ALGÚN PARÁMETRO DE BÚSQUEDA
    if ( isset($_POST['search']) ) {
        $search = $_POST['search'];

        // SE ESCAPA LA CADENA DE BÚSQUEDA PARA EVITAR INYECCIÓN SQL
        $search = $conexion->real_escape_string($search);

        // MODIFICAMOS LA QUERY PARA BUSCAR POR NOMBRE, MARCA O DETALLES
        $query = "
            SELECT * 
            FROM productos 
            WHERE nombre LIKE '%{$search}%'
               OR marca LIKE '%{$search}%'
               OR detalles LIKE '%{$search}%'
        ";

        // SE REALIZA LA QUERY Y SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->query($query) ) {
            // SE OBTIENEN LOS RESULTADOS Y SE AGREGAN AL ARREGLO
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $producto = array();
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach ($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                // SE AGREGA CADA PRODUCTO AL ARREGLO FINAL
                $data[] = $producto;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>