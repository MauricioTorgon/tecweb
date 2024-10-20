// Definimos el JSON base
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/defecto.png"
};

$(document).ready(function() {
    // Inicialización al cargar la página
    init();

    // Evento de buscar producto al escribir en el campo de búsqueda
    $('#search').on('input', function() {
        buscarProducto();
    });

    // Evento de agregar producto al enviar el formulario
    $('#product-form').submit(function(e) {
        e.preventDefault();
        agregarProducto();
    });

    // Cargar productos al abrir la página
    listarProductos();
});

function init() {
    // Convierte el JSON a string para poder mostrarlo
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
}

// Función para listar productos NO eliminados
function listarProductos() {
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function(response) {
            let productos = JSON.parse(response);
            if (productos.length > 0) {
                let template = '';
                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#products').html(template);
            }
        }
    });
}

// Función para buscar productos al teclear
function buscarProducto() {
    let search = $('#search').val();
    $.ajax({
        url: `./backend/product-search.php?search=${search}`,
        type: 'GET',
        success: function(response) {
            let productos = JSON.parse(response);
            let template = '';
            let template_bar = '';
            productos.forEach(producto => {
                let descripcion = `
                    <li>precio: ${producto.precio}</li>
                    <li>unidades: ${producto.unidades}</li>
                    <li>modelo: ${producto.modelo}</li>
                    <li>marca: ${producto.marca}</li>
                    <li>detalles: ${producto.detalles}</li>
                `;
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td><ul>${descripcion}</ul></td>
                        <td>
                            <button class="product-delete btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                `;
                template_bar += `<li>${producto.nombre}</li>`;
            });
            $('#product-result').removeClass('d-none').addClass('d-block');
            $('#container').html(template_bar);
            $('#products').html(template);
        }
    });
}

// Función para agregar producto
function agregarProducto() {
    let productoJsonString = $('#description').val();
    let finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = $('#name').val();
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    $.ajax({
        url: './backend/product-add.php',
        type: 'POST',
        contentType: 'application/json',
        data: productoJsonString,
        success: function(response) {
            let respuesta = JSON.parse(response);
            let template_bar = `
                <li>status: ${respuesta.status}</li>
                <li>message: ${respuesta.message}</li>
            `;
            $('#product-result').removeClass('d-none').addClass('d-block');
            $('#container').html(template_bar);
            listarProductos();
        }
    });
}

// Función para eliminar producto
$(document).on('click', '.product-delete', function() {
    if (confirm('¿De verdad deseas eliminar el Producto?')) {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.ajax({
            url: `./backend/product-delete.php?id=${id}`,
            type: 'GET',
            success: function(response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li>status: ${respuesta.status}</li>
                    <li>message: ${respuesta.message}</li>
                `;
                $('#product-result').removeClass('d-none').addClass('d-block');
                $('#container').html(template_bar);
                listarProductos();
            }
        });
    }
});
