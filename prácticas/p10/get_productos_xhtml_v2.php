<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    // Inicializar la variable $tope
    $tope = isset($_GET['tope']) ? $_GET['tope'] : null;

    /* SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'IMREDj2128@', 'marketzone');

    /** comprobar la conexión */
    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    /* Crear una tabla que no devuelve un conjunto de resultados */
    if ($result = $link->query("SELECT * FROM productos " . (!empty($tope) ? " AND unidades <= {$tope}" : ""))) {
        /* Almacenar todos los resultados en un arreglo */
        $rows = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        /* útil para liberar memoria asociada a un resultado con demasiada información */
        $result->free();
    }

    $link->close();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <script>
        function show() {
            // se obtiene el id de la fila donde está el botón presinado
            var rowId = event.target.parentNode.parentNode.id;

            // se obtienen los datos de la fila en forma de arreglo
            var data = document.getElementById(rowId).querySelectorAll(".row-data");


            var name = data[0].innerHTML;
            var marca = data[1].innerHTML;
            var modelo = data[2].innerHTML;
            var precio  = data[3].innerHTML;
            var detalles = data[5].innerHTML;
            var unidades =  data[4].innerHTML;
            var imagen = data[6].innerHTML;

            alert("Name: " + name + "\nMarca: " + marca +"\nModelo: " +modelo +"\nPrecio: " +precio +"\nUnidades: "+unidades +"\nImgen: "+imagen);

            send2form(name, marca, modelo, precio, detalles, unidades,imagen);
        }
        function send2form(name, marca, modelo, precio, detalles, unidades,imagen) {     //form) { 
            var urlForm = "http://localhost/tecweb/Practicas/p10/formulario_productos_v3.php";
            var propName = "nombre="+name;
            var propAge = "marca="+marca;
            var porpMod = "modelo="+modelo;
            var propPrecio = "precio="+precio;
            var propUnidades = "unidades="+unidades;
            var propDetalles = "detalles="+detalles;
            var propImg = "imagen="+imagen;
            window.open(urlForm+"?"+propName+"&"+propAge+"&"+porpMod+"&"+propPrecio+"&"+propUnidades+"&"+propDetalles+"&"+propImg);
        }
    </script>
    <h3>PRODUCTOS</h3>

    <br/>

    <?php if (isset($rows) && count($rows) > 0) : ?>

        <table class="table">
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
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $index = 1; 
            foreach ($rows as $row) : ?>
                <tr id="row-<?= $index ?>">
                    <th scope="row"><?= htmlspecialchars($row['id']) ?></th>
                    <td class="row-data"><?= htmlspecialchars($row['nombre']) ?></td>
                    <td class="row-data"><?= htmlspecialchars($row['marca']) ?></td>
                    <td class="row-data"><?= htmlspecialchars($row['modelo']) ?></td>
                    <td class="row-data"><?= htmlspecialchars($row['precio']) ?></td>
                    <td class="row-data"><?= htmlspecialchars($row['unidades']) ?></td>
                    <td class="row-data"><?= htmlspecialchars(utf8_encode($row['detalles'])) ?></td>
                    <td class="row-data">
                        <img src="<?= htmlspecialchars($row['imagen'] ?: 'placeholder.jpg') ?>" alt="<?= htmlspecialchars($row['nombre']) ?>" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <input type="button" value="edit" onclick="show()" aria-label="Edit <?= htmlspecialchars($row['nombre']) ?>"/>
                    </td>
                </tr>
            <?php 
                $index++; 
            endforeach; ?>
            </tbody>
        </table>

    <?php elseif (!empty($tope)) : ?>

        <script>
            alert('No hay productos con unidades menores o iguales a ' + <?= $tope ?>);
        </script>

    <?php endif; ?>
</body>
</html>
