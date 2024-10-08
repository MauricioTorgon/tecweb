<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de discos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="number"]::-webkit-outer-spin-button,
        .form-group input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        select{
            width: 50vh;
            border: solid 1px #ccc;
            padding: 5px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Registrar ElectronicosS</h2>
        <form id="formulario" action="http://localhost/tecweb/prácticas/p10/set_producto_v2.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre"  value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <select id="marca" name="marca" required>
                    <option value="">Selecciona una marca</option>
                    <option value="Sony">Sony</option>
                    <option value="Bose">Atlantic</option>
                    <option value="Sennheiser">Unknow</option>
                    <option value="Apple">Universal</option>
                </select>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo"  value="<?= !empty($_POST['modelo'])?$_POST['modelo']:$_GET['modelo'] ?>" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?= !empty($_POST['precio'])?$_POST['precio']:$_GET['precio'] ?>" required>
            </div>

            <div class="form-group">
                <label for="detalles">Detalles:</label>
                <textarea id="detalles" name="detalles" rows="4" >"<?= !empty($_POST['detalles'])?$_POST['detalles']:$_GET['detalles'] ?>" </textarea>
            </div>

            <div class="form-group">
                <label for="unidades">Unidades disponibles:</label>
                <input type="number" id="unidades" name="unidades" value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>" required>
            </div>

            <div class="form-group">
                <label for="imagen">Ruta de la Imagen:</label>
                <input type="text" id="imagen" name="imagen" placeholder="ej: /img/defecto.png">
            </div>

            <div class="form-group">
                <button type="submit">Registrar Producto</button>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('formulario').addEventListener('submit', function(event) {
            let nombre = document.getElementById('nombre').value.trim();
            let modelo = document.getElementById('modelo').value.trim();
            let precio = parseFloat(document.getElementById('precio').value);
            let detalles = document.getElementById('detalles').value.trim();
            let unidades = parseInt(document.getElementById('unidades').value);
            let imagen = document.getElementById('imagen').value.trim();

            // Validación del nombre (requerido y máximo 100 caracteres)
            if (nombre === "" || nombre.length > 100) {
                alert("El nombre del producto es requerido y debe tener 100 caracteres o menos.");
                event.preventDefault();
                return;x
            }

            // Validación del modelo (alfanumérico y máximo 25 caracteres)
            if (!/^[a-zA-Z0-9]+$/.test(modelo) || modelo.length > 25) {
                alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
                event.preventDefault();
                return;
            }

            // Validación del precio (mayor a 99.99)
            if (isNaN(precio) || precio <= 99.99) {
                alert("El precio es requerido y debe ser mayor a 99.99.");
                event.preventDefault();
                return;
            }

            // Validación de los detalles (opcional, pero máximo 250 caracteres)
            if (detalles.length > 250) {
                alert("Los detalles no deben exceder los 250 caracteres.");
                event.preventDefault();
                return;
            }

            // Validación de unidades (requerido y mayor o igual a 0)
            if (isNaN(unidades) || unidades < 0) {
                alert("Las unidades deben ser mayores o iguales a 0.");
                event.preventDefault();
                return;
            }

            // Validación de la imagen (opcional, usar imagen por defecto si no se proporciona)
            if (imagen === "") {
                document.getElementById('imagen').value = "/img/defecto.png"; // Imagen por defecto
            }
        });
    </script>

</body>
</html>
