<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 06</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Opcion.php';
    require_once __DIR__ . '/Menu.php';

    $menu1 = new Menu('vertical');

    $opc1 = new Opcion('Facebook','https://www.facebook.com','#C3D9FF');
    $menu1->insertar_opcion($opc1);

    $opc2 = new Opcion('Outlook','https://www.outlook.com','#CDEB8B');
    $menu1->insertar_opcion($opc2);

    $opc3 = new Opcion('Instagram','https://www.instagram.com','#FFD9C3');
    $menu1->insertar_opcion($opc3);

    $menu1->graficar();
    ?>
</body>
</html>