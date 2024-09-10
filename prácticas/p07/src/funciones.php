<?php
function esMultiploDe5y7($numero) {
if(isset($_GET['numero']))
{
    $num = $_GET['numero'];
    if ($num%5==0 && $num%7==0)
    {
        echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
    }
    else
    {
        echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
    }
}
}

// Función para generar la secuencia impar, par, impar
function generarSecuenciaImparParImpar() {
    $matriz = [];  // Inicializamos la matriz
    $iteraciones = 0;
    $numerosGenerados = 0;

    // Ciclo que se repetirá hasta encontrar la secuencia impar, par, impar
    do {
        $numeros = [];
        for ($i = 0; $i < 3; $i++) {
            $numeroAleatorio = rand(1, 1000);  // Generar número aleatorio entre 1 y 1000
            $numeros[] = $numeroAleatorio;
        }

        // Guardar la secuencia generada en la matriz
        $matriz[] = $numeros;
        $iteraciones++;
        $numerosGenerados += 3;

        // Verificar si la secuencia es impar, par, impar
        $condicionImparParImpar = ($numeros[0] % 2 != 0) && ($numeros[1] % 2 == 0) && ($numeros[2] % 2 != 0);

    } while (!$condicionImparParImpar);

    // Retornar la matriz, el número de iteraciones y el total de números generados
    return [
        'matriz' => $matriz,
        'iteraciones' => $iteraciones,
        'numerosGenerados' => $numerosGenerados
    ];
}

?>



