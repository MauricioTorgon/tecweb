<?php
    header("Content-Type: application/json; charset=utf-8"); 
    $data = array();

    if (isset($_GET['tope'])) {
        $tope = $_GET['tope'];
    } else {
        die('Parámetro "tope" no detectado...');
    }

    if (!empty($tope)) {
        /** SE CREA EL OBJETO DE CONEXION */
        $link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

        /** comprobar la conexión */
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error . '<br/>');
        }

        /** Establecer el conjunto de caracteres en UTF-8 */
        $link->set_charset("utf8");

        /** Crear una consulta que no devuelve un conjunto de resultados */
        if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
            /** Se extraen las tuplas obtenidas de la consulta */
            $row = $result->fetch_all(MYSQLI_ASSOC);

            /** Se crea un arreglo con la estructura deseada */
            foreach ($row as $num => $registro) {
                foreach ($registro as $key => $value) {
                    $data[$num][$key] = $value; // utf8_encode ya no es necesario
                }
            }

            /** Liberar memoria */
            $result->free();
        }

        $link->close();

        /** Devolver los datos en formato JSON */
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
?>
