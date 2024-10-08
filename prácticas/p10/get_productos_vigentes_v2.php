<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos Vigentes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <h3>Productos Vigentes</h3>
    <br/>

    <?php
    @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

    if ($link->connect_errno) {
        die('<p>Falló la conexión: ' . $link->connect_error . '</p>');
    }

    $link->set_charset("utf8");

    $sql = "SELECT * FROM productos WHERE eliminado = 0";
    if ($result = $link->query($sql)) {
        if ($result->num_rows > 0) {
            echo '<table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Unidades</th>
                            <th scope="col">Detalles</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Modificar</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <th scope="row">' . $row['id'] . '</th>
                        <td>' . $row['nombre'] . '</td>
                        <td>' . $row['marca'] . '</td>
                        <td>' . $row['modelo'] . '</td>
                        <td>' . $row['precio'] . '</td>
                        <td>' . $row['unidades'] . '</td>
                        <td>' . $row['detalles'] . '</td>
                        <td><img src="' . $row['imagen'] . '" alt="Imagen del producto" width="100" /></td>
                        <td><a href="formulario_productos_v2.php?id=' . $row['id'] . '">Modificar</a></td>
                      </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No se encontraron productos vigentes.</p>';
        }
        $result->free();
    } else {
        echo '<p>Error en la consulta a la base de datos.</p>';
    }
    $link->close();
    ?>
</body>
</html>
