<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 07</title>
</head>

<body>
    <?php
    require_once __DIR__ . '/Cabecera.php';
    $cab1 = new Cabecera('El rincon del Programador');
    $cab1->graficar();
    echo '<br>';
    $cab2 = new Cabecera('El rincon del Programador','left');
    $cab2->graficar();
    echo '<br>';
    $cab3 = new Cabecera('El rincon del Programador','right','#FF0000');
    $cab3->graficar();
    echo '<br>';
    $cab4 = new Cabecera('El rincon del Programador','center','#FF0000','#FFFF00');
    $cab4->graficar();
    echo '<br>';

    ?>
</body>
</html>