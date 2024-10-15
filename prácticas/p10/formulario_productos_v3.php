<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Electronicos</title>
    <style>
            body {
        font-family: 'Roboto', sans-serif;
        background-color: #121212;
        color: #e0e0e0;
        margin: 0;
        padding: 20px;
        line-height: 1.6;
    }

    .container {
        max-width: 700px;
        margin: 0 auto;
        background-color: #1e1e1e;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 255, 255, 0.2);
        border: 1px solid #00ccff;
    }

    h2 {
        text-align: center;
        color: #00ccff;
        font-size: 28px;
        letter-spacing: 1.2px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #00ccff;
        font-size: 14px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #444;
        background-color: #2b2b2b;
        color: #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #00ccff;
        outline: none;
        box-shadow: 0 0 10px rgba(0, 204, 255, 0.5);
    }

    .form-group button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(90deg, #00ccff, #00ff88);
        color: #121212;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .form-group button:hover {
        background: linear-gradient(90deg, #00ff88, #00ccff);
        transform: scale(1.05);
    }

    select {
        width: 100%;
        padding: 12px;
        border: 2px solid #444;
        background-color: #2b2b2b;
        color: #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    select:focus {
        border-color: #00ccff;
        outline: none;
        box-shadow: 0 0 10px rgba(0, 204, 255, 0.5);
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
                    <option value="">Selecciona una marca</option>
                    <option value="Sony">Sony</option>
                    <option value="LG">LG</option>
                    <option value="Atvio">Unknow</option>
                    <option value="Apple">Apple</option>
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
                document.getElementById('imagen').value = "img/defecto.png"; // Imagen por defecto
            }
        });
    </script>

</body>
</html>
