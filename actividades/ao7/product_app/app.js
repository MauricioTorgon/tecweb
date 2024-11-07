// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  "precio": 0.0,
  "unidades": 1,
  "modelo": "XX-000",
  "marca": "NA",
  "detalles": "NA",
  "imagen": "img/predeterminado.png"
};

$(document).ready(function () {
  let edit = false;
  $('#product-result').hide();
  $('#name-error').hide();
  $('#price-error').hide();
  $('#details-error').hide();
  $('#units-error').hide();
  $('#brand-error').hide();
  $('#model-error').hide();
  $('#image-error').hide();
  $('#name-valid').hide();
  fetchProducts();

  // Búsqueda de los productos
  $('#name').keyup(function (e) {
    let search = $('#name').val();

    // Ocultar el mensaje si el campo de búsqueda está vacío
    if (search === '') {
      $('#name-valid').hide();
      return;
    }

    $.ajax({
      url: './backend/product-search.php',
      type: 'GET',
      data: { search },
      success: function (response) {
        let result = JSON.parse(response);

        $('#name-valid').hide();

        // Aquí usamos equalProducts como una función asíncrona
        equalProducts(search).then(exists => {
          if (exists) {
            $('#name-valid')
              .html('<strong>El artículo ya existe</strong>')
              .css('background-color', 'red') // Cambia el fondo a rojo
              .show();
          } else {
            $('#name-valid')
              .html('<strong>El artículo no existe</strong>')
              .css('background-color', 'green') // Cambia el fondo a rojo
              .show();
          }
        }).catch(error => {
          console.error('Error en la verificación del producto:', error);
        });
      }
    });
  });




  $('#search').keyup(function (e) {
    if ($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: './backend/product-search.php',
        type: 'GET',
        data: { search },
        success: function (response) {
          let products = JSON.parse(response);
          let template = '';
          let templateLista = '';

          products.forEach(product => {
            template += `<li>
              ${product.nombre}
            </li>`;

            templateLista += `
                <tr productId="${product.id}">
                    <td>${product.id}</td>
                    <td>${product.nombre}</td>
                    <td>
                        <ul>
                            <li>Precio: ${product.precio}</li>
                            <li>Unidades: ${product.unidades}</li>
                            <li>Modelo: ${product.modelo}</li>
                            <li>Marca: ${product.marca}</li>
                            <li>Detalles: ${product.detalles}</li>
                        </ul>
                    </td>
                    <td>
                        <button class="product-delete btn btn-danger"> 
                            Delete 
                        </button>
                    </td>
                </tr>`;
          });

          $('#container').html(template);
          $('#products').html(templateLista);
          $('#product-result').show();
        }
      })
    } else {
      fetchProducts();
      $('#product-result').hide();
    }
  })

  // Agregar productos
  $('#product-form').submit(function (e) {
    e.preventDefault(); // Evitar el envío del formulario por defecto

    // Verificar entradas
    const isNombreValido = verificarName();
    const isDetallesValido = verificarDetalles()
    const isImagenValido = verificarImagen();
    const isMarcaValido = verificarMarca();
    const isModeloValido = verificarModelo();
    const isPrecioValido = verificarPrecio();
    const isUnidadesValido = verificarUnidades();

    // Verificar si todos los campos son válidos
    if (!isNombreValido || !isDetallesValido || !isImagenValido ||
      !isMarcaValido || !isModeloValido || !isPrecioValido || !isUnidadesValido) {
      // Aquí podrías mostrar un mensaje de error general si deseas
      return; // Detener el proceso si hay errores
    }

    // Crear el objeto de datos para enviar
    var data = {
      id: $('#productId').val(),
      name: $('#name').val(),
      brand: $('#brand').val(),
      model: $('#model').val(),
      price: $('#price').val(),
      details: $('#details').val(),
      units: $('#units').val(),
      image: $('#image').val(),
    };

    let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

    // Enviar los datos a PHP usando AJAX
    $.ajax({
      url: url,
      type: 'POST', // Método de envío
      data: JSON.stringify(data), // Convertir el objeto a JSON
      contentType: 'application/json', // Tipo de contenido
      success: function (response) {
        let respuesta = JSON.parse(response);
        let template = '';
        template += `
           Status: ${respuesta.status} <br />
           Message: ${respuesta.message} <br />
          `;
        $('#container').html(template);
        $('#product-result').show();
        fetchProducts(); // Llamada a la función para obtener los productos actualizados
      },
      error: function (xhr, status, error) {
        // Manejo de errores en la solicitud AJAX
        $('#container').html(`Error: ${xhr.status} - ${error}`);
        $('#product-result').show();
      }
    });
  });

  //Listar productos 
  function fetchProducts() {
    $.ajax({
      url: './backend/product-list.php',
      type: 'GET',
      success: function (response) {
        let products = JSON.parse(response);

        let template = '';
        products.forEach(product => {
          template += `
                <tr productId="${product.id}">
                    <td>${product.id}</td>
                    <td>
                      <a href="#" class="product-item">${product.nombre}</a>
                    </td>
                    <td>
                        <ul>
                            <li>Precio: ${product.precio}</li>
                            <li>Unidades: ${product.unidades}</li>
                            <li>Modelo: ${product.modelo}</li>
                            <li>Marca: ${product.marca}</li>
                            <li>Detalles: ${product.detalles}</li>
                        </ul>
                    </td>
                    <td>
                        <button class="product-delete btn btn-danger"> 
                            Delete 
                        </button>
                    </td>
                </tr>`;
        });

        $('#products').html(template);
      }
    });
  }

  //Eliminar Elementos
  $(document).on('click', '.product-delete', function () {

    if (confirm('¿Estas seguro que deseas eliminar el elemento?')) {
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr('productId');
      $.get('./backend/product-delete.php', { id }, function (response) {
        fetchProducts();
        let respuesta = JSON.parse(response);
        let template = '';
        template += `
             Status: ${respuesta.status} <br />
             Message: ${respuesta.message} <br />
            `;
        $('#container').html(template);
        $('#product-result').show();
      })

    } else {
      $('#product-result').hide();
    }
  })

  //Modificar
  $(document).on('click', '.product-item', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('productId');
    $.get('./backend/product-single.php', { id }, function (response) {
      const product = JSON.parse(response);

      $('#name').val(product.nombre);
      $('#price').val(product.precio);
      $('#units').val(product.unidades);
      $('#model').val(product.modelo);
      $('#brand').val(product.marca);
      $('#details').val(product.detalles);
      $('#image').val("img/predeterminado.png");

      $('#productId').val(product.id)
      edit = true;
    })
  })
});

