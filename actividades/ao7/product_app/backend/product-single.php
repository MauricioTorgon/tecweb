<?php
    include_once __DIR__.'/database.php';
    
    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "SELECT * FROM productos WHERE id = $id";
        if ( $result = $conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    unset($row['eliminado']);
                    foreach($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data[0], JSON_PRETTY_PRINT);
?>