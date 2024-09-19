<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejericios</title>
</head>
<body>
    <H1>Respuesta a los ejercicios de la practica</H1>
    <h2>Ejercicio 1</h2>
    <?php
        echo 'Variables válidas: $_myvar, $_7var, $myvar, $var7, $_element1'."<br>";
        echo 'Variables inválidas: myvar, $house*5'."<br>";
        echo 'Las variables necesitan empezar con $ seguidas por un guion bajo (_) o letra, sin caracteres especiales como *'."<br>";
    ?>

    <h2>Ejericio 2</h2>
    <?php
        $a = "ManejadorSQL";  
        $b = 'MySQL';  
        $c = &$a;  // Asignación por referencia

        // Imprimir los valores de las variables con concatenación
        echo '$a: ' . $a . ' $b: ' . $b . ' $c: ' . $c . "<br>";

        $a = "PHP server";  
        $b = &$a; 

        // Imprimir los valores de las variables actualizados
        echo '$a: ' . $a . ' $b: ' . $b . ' $c: ' . $c . "<br>";
        echo 'Al hacer que las vairables $b y $c referencien a $a el contenido de a se copio en las demas variabels'."<br>";

        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 3</h2>
    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;
        $a .= $b;
        $b *= $c;
        $z[0] = "MySQL";

        echo "Valores de las variables:<br>";
        echo "\$a = ";
        var_dump($a);
        echo "<br>\$b = ";
        var_dump($b);
        echo "<br>\$c = ";
        var_dump($c);
        echo "<br>\$z = ";
        print_r($z);

        unset($a, $b, $c, $z);
    ?>
    <h2>Ejercicio 4</h2>

    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;

        echo "Valores usando \$GLOBALS:<br>";
        echo "\$a = " . $GLOBALS['a'] . "<br>";
        echo "\$b = " . $GLOBALS['b'] . "<br>";
        echo "\$c = " . $GLOBALS['c'] . "<br>";

        unset($a, $b, $c, $z);
    ?>
    <h2>Ejercicio 5</h2>

    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "Valores después de las conversiones:<br>";
        echo "\$a = $a<br>";
        echo "\$b = $b<br>";
        echo "\$c = $c<br>";

        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 6</h2>

    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo "Valores booleanos usando var_dump:<br>";
        var_dump($a, $b, $c, $d, $e, $f);

        // Convertir booleanos a valores que se puedan mostrar con echo
        echo "<br>Valores de \$c y \$e mostrables:<br>";
        echo "c = " . (int)$c . "<br>";
        echo "e = " . (int)$e . "<br>";

        unset($a, $b, $c, $d, $e, $f);  
    ?>
    
    <h2>Ejericio 7</h2>
    <?php
        echo "Versión de Apache y PHP: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
        echo "Sistema operativo del servidor: " . PHP_OS . "<br>";
        echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
    ?>
</body>
</html>