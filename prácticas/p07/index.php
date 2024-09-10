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
    ?>
        <h2>Ejemplo de POST</h2>
        <form action="index.php" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
        </form>
        <br>
        <?php
        if (isset($_POST["name"]) && isset($_POST["email"])) {
            echo ($_POST["name"]);  
            echo '<br>';
            echo ($_POST["email"]);
        }
        ?>

        <h2>Ejercicio 2</h2>
        <?php
        // Comprobar si se requiere ejecutar el ejercicio 2
        if (isset($_GET['ejercicio']) && $_GET['ejercicio'] == 2) {
            // Llamar a la función para generar la secuencia impar, par, impar
            $resultado = generarSecuenciaImparParImpar();

            // Mostrar la matriz generada
            echo "<h3>Matriz generada:</h3>";
            echo "<table border='1'>";
            foreach ($resultado['matriz'] as $fila) {
                echo "<tr>";
                foreach ($fila as $numero) {
                    echo "<td>$numero</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

            // Mostrar el número de iteraciones y cantidad de números generados
            echo "<p>{$resultado['numerosGenerados']} números obtenidos en {$resultado['iteraciones']} iteraciones.</p>";
        }
        ?>


</body>
</html>