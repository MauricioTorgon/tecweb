<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 08</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Operacion.php';

    $suma = new Suma;
    $suma->setValor1(10); //Método definido en la clase 'Operacion'
    $suma->setValor2(20); //Método definido en la clase 'Operación'
    $suma->operar();            //Método definido en la clase 'Suma'
    echo 'El resultado es: '.$suma->getResultado().'<br>';

    $resta = new Resta;
    $resta->setValor1(10); //Método definido en la clase 'Operacion'
    $resta->setValor2(20); //Método definido en la clase 'Operación'
    $resta->operar();            //Método definido en la clase 'resta'
    echo 'El resultado es: '.$resta->getResultado().'<br>';
    ?>
</body>
</html>