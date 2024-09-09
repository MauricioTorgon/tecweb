<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Manejo de Variables en PHP</title>
</head>
<body>
    <?php
    //INCISO 1: Variables válidas
    $_myvar = "Esta variable es válida. Los nombres de variables pueden comenzar con un guion bajo.";
    $_7var = "Esta variable es válida. Los nombres de variables pueden comenzar con un guion bajo y luego un número.";
    $myvar = "Esta variable es válida. Las variables pueden comenzar con una letra.";
    $var7 = "Esta variable es válida";
    $_element1 = "Esta variable es válida";

    // Variable no válida, comentario ya que no puede ser declarada


    echo "<h1>Validación de Variables</h1>";

    // Mostrar las variables válidas
    echo "<p>\$_myvar: $_myvar</p>";
    echo "<p>\$_7var: $_7var</p>";
    echo "myvar no es válida.  Las variables en PHP deben comenzar con el símbolo $";
    echo "<p>\$myvar: $myvar</p>";
    echo "<p>\$var7: $var7</p>";
    echo "<p>\$_element1: $_element1</p>";
    echo "<p>\$house*5: No es válida. No se pueden utilizar caracteres especiales como * en el nombre de una variable.";

    // Liberar variables
    unset($_myvar, $_7var, $myvar, $var7, $_element1);

    // SERGUNDO INCISO. Primer bloque de asignaciones:
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a; // $c es una referencia a $a

    echo "<h1>Primer bloque de asignaciones</h1>";
    echo "<p>Valor de \$a: $a</p>";
    echo "<p>Valor de \$b: $b</p>";
    echo "<p>Valor de \$c (referencia de \$a): $c</p>";

    // Segundo bloque de asignaciones
    $a = "PHP server"; // Se cambia el valor de $a
    $b = &$a; // Ahora $b es una referencia a $a

    echo "<h1>Segundo bloque de asignaciones</h1>";
    echo "<p>Valor de \$a: $a</p>";
    echo "<p>Valor de \$b (referencia de \$a): $b</p>";
    echo "<p>Valor de \$c (referencia original de \$a): $c</p>";

    // Descripción del comportamiento
    echo "<h2>Explicación</h2>";
    echo "<p>En el segundo bloque de asignaciones, cuando \$a cambia a \"PHP server\", tanto \$b como \$c apuntan a este nuevo valor. 
    Esto ocurre porque \$b se convirtió en una referencia a \$a, y \$c también es una referencia previa a \$a. 
    Por lo tanto, cualquier cambio en \$a se refleja en ambas variables (\$b y \$c).</p>";

    ?>
</body>
</html>
