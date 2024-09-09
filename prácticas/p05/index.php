<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Validación de Variables en PHP</title>
</head>
<body>
    <?php
    // Variables válidas
    $_myvar = "Esta variable es válida";
    $_7var = "Esta variable es válida";
    $myvar = "Esta variable es válida";
    $var7 = "Esta variable es válida";
    $_element1 = "Esta variable es válida";

    // Variable no válida, comentario ya que no puede ser declarada
    // $house*5 = "Esta variable NO es válida";

    echo "<h1>Validación de Variables</h1>";

    // Mostrar las variables válidas
    echo "<p>\$_myvar: $_myvar</p>";
    echo "<p>\$_7var: $_7var</p>";
    echo "<p>\$myvar: $myvar</p>";
    echo "<p>\$var7: $var7</p>";
    echo "<p>\$_element1: $_element1</p>";

    // Liberar variables
    unset($_myvar, $_7var, $myvar, $var7, $_element1);

    ?>
</body>
</html>
