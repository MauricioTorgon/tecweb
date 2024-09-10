<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        // Incluir el archivo con las funciones
        include 'src/funciones.php';
        // Verificar si se ha pasado el número como parámetro en la URL
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];

            // Validar si el valor es numérico
            if (is_numeric($numero)) {
                // Llamar a la función y mostrar el resultado
                echo esMultiploDe5y7($numero);
            } else {
                echo "Por favor, ingresa un número válido.";
            }
        } else {
            echo "No se ha proporcionado ningún número en la URL.";
        }

        echo postear();
    ?>
</body>
</html>