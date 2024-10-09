<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Electronicos</title>
    <style>
    /* Estilo general */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 20px;
    }

    /* Contenedor del formulario */
    .container {
        max-width: 600px;
        margin: 40px auto;
        background-color: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    /* Efecto hover sobre el contenedor */
    .container:hover {
        transform: scale(1.02);
    }

    /* Título */
    h2 {
        text-align: center;
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
    }

    /* Estilo de los grupos del formulario */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-size: 16px;
        color: #333;
        transition: border 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #007bff;
        background-color: #ffffff;
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    /* Ocultar botones de número en Chrome */
    .form-group input[type="number"]::-webkit-outer-spin-button,
    .form-group input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Estilo del botón de envío */
    .form-group button {
        display: block;
        width: 100%;
        padding: 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .form-group button:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    /* Estilo de los selects */
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        color: #333;
        font-size: 16px;
        transition: border 0.3s ease;
    }

    select:focus {
        border-color: #007bff;
        background-color: #ffffff;
        outline: none;
    }
</style>

</head>
<body>

    <div class="container">
        <h2>Registrar Electronico</h2>
        <form id="formulario" action="http://localhost/tecweb/prácticas/p10/update.php" method="POST" enctype="multipart/form-data">
    
            <input type="hidden" id="id" name="id" value="<?= !empty($_POST['id'])?$_POST['id']:$_GET['id'] ?>">
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre"  value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <select id="marca" name="marca" required>
                    <option value="LG">Selecciona una marca</option>
                    <option value="Sony">Sony</option>
                    <option value="Atvio">Atvio</option>
                    <option value="Huawei">Huawei</option>
                    <option value="Desconocido">Desconocido</option>
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
                <input type="text" id="imagen" name="imagen" placeholder="ej: /img/producto.jpg">
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
                document.getElementById('imagen').value = "/img/default.jpg"; // Imagen por defecto
            }
        });
    </script>

</body>
</html>
