<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ejercicios</title>
</head>
<body>
    <h1>Respuesta a los ejercicios de la práctica</h1>

    <h2>Ejercicio 1</h2>
    <p>
        <?php
            echo 'Variables válidas: $_myvar, $_7var, $myvar, $var7, $_element1<br />';
            echo 'Variables inválidas: myvar, $house*5<br />';
            echo 'Las variables necesitan empezar con $ seguidas por un guion bajo (_) o letra, sin caracteres especiales como *.<br />';
        ?>
    </p>

    <h2>Ejercicio 2</h2>
    <p>
        <?php
            $a = "ManejadorSQL";  
            $b = 'MySQL';  
            $c = &$a;  // Asignación por referencia

            // Imprimir los valores de las variables con concatenación
            echo '$a: ' . htmlspecialchars($a) . ' $b: ' . htmlspecialchars($b) . ' $c: ' . htmlspecialchars($c) . '<br />';

            $a = "PHP server";  
            $b = &$a; 

            // Imprimir los valores de las variables actualizados
            echo '$a: ' . htmlspecialchars($a) . ' $b: ' . htmlspecialchars($b) . ' $c: ' . htmlspecialchars($c) . '<br />';
            echo 'Al hacer que las variables $b y $c referencien a $a, el contenido de $a se copió en las demás variables.<br />';

            unset($a, $b, $c);
        ?>
    </p>

    <h2>Ejercicio 3</h2>
    <p>
        <?php
            $a = "PHP5";
            $z[] = &$a;
            $b = "5a version de PHP";
            
            // Convertir $b a un valor numérico antes de multiplicar
            $c = intval($b) * 10;
            $a .= $b;
            $b = intval($b);
            $b *= $c;
            $z[0] = "MySQL";

            echo "Valores de las variables:<br />";
            echo "\$a = ";
            var_dump($a);
            echo "<br />\$b = ";
            var_dump($b);
            echo "<br />\$c = ";
            var_dump($c);
            echo "<br />\$z = ";
            print_r($z);

            unset($a, $b, $c, $z);
        ?>
    </p>

    <h2>Ejercicio 4</h2>
    <p>
        <?php
            $a = "PHP5";
            $z[] = &$a;
            $b = "5a version de PHP";
            
            // Convertir $b a un valor numérico antes de multiplicar
            $c = intval($b) * 10;

            echo "Valores usando \$GLOBALS:<br />";
            echo "\$a = " . htmlspecialchars($GLOBALS['a']) . "<br />";
            echo "\$b = " . htmlspecialchars($GLOBALS['b']) . "<br />";
            echo "\$c = " . htmlspecialchars($GLOBALS['c']) . "<br />";

            unset($a, $b, $c, $z);
        ?>
    </p>

    <h2>Ejercicio 5</h2>
    <p>
        <?php
            $a = "7 personas";
            $b = (integer) $a;
            $a = "9E3";
            $c = (double) $a;

            echo "Valores después de las conversiones:<br />";
            echo "\$a = " . htmlspecialchars($a) . "<br />";
            echo "\$b = " . htmlspecialchars($b) . "<br />";
            echo "\$c = " . htmlspecialchars($c) . "<br />";

            unset($a, $b, $c);
        ?>
    </p>

    <h2>Ejercicio 6</h2>
    <p>
        <?php
            $a = "0";
            $b = "TRUE";
            $c = FALSE;
            $d = ($a || $b);
            $e = ($a && $c);
            $f = ($a xor $b);

            echo "Valores booleanos usando var_dump:<br />";
            var_dump($a, $b, $c, $d, $e, $f);

            // Convertir booleanos a valores que se puedan mostrar con echo
            echo "<br />Valores de \$c y \$e mostrables:<br />";
            echo "c = " . (int)$c . "<br />";
            echo "e = " . (int)$e . "<br />";

            unset($a, $b, $c, $d, $e, $f);  
        ?>
    </p>

    <h2>Ejercicio 7</h2>
    <p>
        <?php
            echo "Versión de Apache y PHP: " . htmlspecialchars($_SERVER['SERVER_SOFTWARE']) . "<br />";
            echo "Sistema operativo del servidor: " . htmlspecialchars(PHP_OS) . "<br />";
            echo "Idioma del navegador: " . htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE']) . "<br />";
        ?>
    
    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer"><img
        src="https://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
    </p>
    </p>
</body>
</html>
