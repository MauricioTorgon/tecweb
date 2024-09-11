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
        
        <h2>Ejercicio 3</h2>
        <?php
        // Comprobar si se requiere ejecutar el ejercicio 2
        if (isset($_GET['ejercicio']) && $_GET['ejercicio'] == 3) {
        // Obtener el número dado a través de la variable superglobal $_GET
        $numeroDado = isset($_GET['num']) ? (int)$_GET['num'] : 1;

        if ($numeroDado <= 0) {
            echo "Por favor, proporciona un número mayor a 0.";
            exit;
        }

        // Usar la función con ciclo while
        $numeroConWhile = encontrarMultiploConWhile($numeroDado);
        echo "Con ciclo while: El primer número entero aleatorio múltiplo de $numeroDado es: $numeroConWhile<br>";

        // Usar la función con ciclo do-while
        $numeroConDoWhile = encontrarMultiploConDoWhile($numeroDado);
        echo "Con ciclo do-while: El primer número entero aleatorio múltiplo de $numeroDado es: $numeroConDoWhile";
        }
        ?>
        
        <h2>Ejercicio 4</h2>
        <?php
        // Comprobar si se requiere ejecutar el ejercicio 4
        if (isset($_GET['ejercicio']) && $_GET['ejercicio'] == 4) {
        // Llamar a la función que crea el arreglo
        $arregloLetras = crearArregloLetras();

        // Mostrar el arreglo en una tabla usando un ciclo foreach
        echo "<h2>Tabla de Letras ASCII</h2>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Índice ASCII</th><th>Letra</th></tr>";

        foreach ($arregloLetras as $key => $value) {
            echo "<tr>";
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }
        }
        ?>
        <h2> Ejercicio 5</h2>
        <?php
        // Verificar si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los valores enviados por el formulario
            $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : null;
            $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';

            // Validar los datos
            if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
                // Mostrar mensaje de bienvenida si cumple las condiciones
                echo "<!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Mensaje de Bienvenida</title>
                </head>
                <body>
                    <h2>Bienvenida, usted está en el rango de edad permitido.</h2>
                </body>
                </html>";
            } else {
                // Mostrar mensaje de error si no cumple las condiciones
                echo "<!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Error</title>
                </head>
                <body>
                    <h2>Error: No cumple con los requisitos de edad o sexo.</h2>
                </body>
                </html>";
            }
        } else {
            // Si no se ha enviado el formulario, mostrar el formulario HTML
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Formulario de Solicitud</title>
            </head>
            <body>
                <h2>Formulario de Solicitud</h2>
                <form action='' method='post'>
                    <label for='edad'>Edad:</label>
                    <input type='number' name='edad' id='edad' required><br><br>
                    
                    <label for='sexo'>Sexo:</label>
                    <select name='sexo' id='sexo' required>
                        <option value=''>Seleccione una opción</option>
                        <option value='femenino'>Femenino</option>
                        <option value='masculino'>Masculino</option>
                    </select><br><br>
                    
                    <input type='submit' value='Enviar'>
                </form>
            </body>
            </html>";
        }
        ?>

</body>
</html>