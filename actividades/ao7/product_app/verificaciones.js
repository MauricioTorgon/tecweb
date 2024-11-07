function verificarName() {
    const nombre = document.getElementById('name').value;
  
    // Limpiar mensajes anteriores
    $('#name-error').hide();
  
    if (nombre == '') {
      $('#name-error').html('<strong>Insertar un nombre</strong>').show();
      return false;
    }
  
    if (nombre.length > 100) {
      $('#name-error').html('<strong>El nombre no debe exceder los 100 caracteres</strong>').show();
      return false;
    }
    console.log("Verificacion correcta de nombre")
    return true;
  }
  
  
  function verificarMarca() {
    const marca = document.getElementById('brand').value;
  
    // Limpiar mensajes anteriores
    $('#brand-error').hide();
  
    if (marca == '') {
      $('#brand-error').html('<strong>Insertar una marca</strong>').show();
      return false;
    }
  
    if (marca.length > 100) {
      $('#brand-error').html('<strong>El nombre de la marca no debe exceder los 100 caracteres</strong>').show();
      return false;
    }
    console.log("Verificacion correcta de Marca")
    return true;
  }
  
  
  // Corrección para la función verificarModelo:
  function verificarModelo() {
    const modelo = document.getElementById('model').value;
    const regex = /^[a-zA-Z0-9-]+$/; // Solo letras, números o guiones
    $('#model-error').hide(); // Limpiar mensajes anteriores
  
    if (modelo === '') {
      $('#model-error').html('<strong>Insertar un modelo</strong>').show();
      return false;
    }
    if (modelo.length > 25) {
      $('#model-error').html('<strong>El nombre del modelo no debe exceder los 25 caracteres</strong>').show();
      return false;
    }
    if (!regex.test(modelo)) {
      $('#model-error').html('<strong>El modelo debe contener solo letras, números o guiones</strong>').show();
      return false;
    }
    console.log("Verificacion correcta de modelo")
    return true;
  }
  
  // Verificación asíncrona de nombre
  $('#name').on('blur', function () {
    const nombre = $('#name').val();
    if (nombre === '') return; // No verificar si está vacío
  
    equalProducts(nombre).then(exists => {
      $('#name-error').hide();
      $('#name-valid').hide();
  
      if (exists) {
        $('#name-valid').html('<strong>El artículo ya existe</strong>')
          .css('background-color', 'red').show();
      } else {
        $('#name-valid').html('<strong>El artículo no existe</strong>')
          .css('background-color', 'green').show();
      }
    }).catch(error => {
      console.error('Error en la verificación del producto:', error);
    });
  });
  
  async function equalProducts(producto) {
    try {
      const response = await $.ajax({
        url: './backend/product-list.php',
        type: 'GET'
      });
      const products = JSON.parse(response);
      return products.some(product => producto === product.nombre);
    } catch (error) {
      console.error('Error al obtener productos:', error);
      return false;
    }
  }
  
  
  
  function verificarPrecio() {
    const precioInput = document.getElementById('price').value; // Obtener el valor como string
    const precio = parseFloat(precioInput); // Convertir a número
  
    // Limpiar mensajes anteriores
    $('#price-error').hide();
  
    if (precioInput.trim() === '') {
      $('#price-error').html('<strong>Insertar un precio</strong>').show();
      return false;
    }
  
    if (isNaN(precio) || precio < 99.99) {
      $('#price-error').html('<strong>El precio debe ser un número y no puede ser menor a 99.99</strong>').show();
      return false;
    }
    console.log("Verificacion correcta de precio")
    return true;
  }
  
  
  function verificarDetalles() {
    const detalles = document.getElementById('details').value;
  
    // Limpiar mensajes anteriores
    $('#details-error').hide();
  
    if (detalles == '') {
      $('#details-error').html('<strong>Insertar detalles</strong>').show();
      return false;
    }
  
    if (detalles.length > 250) {
      $('#details-error').html('<strong>Los detalles no deben exceder los 250 caracteres</strong>').show();
      return false;
    }
    console.log("Verificacion correcta de detalles")
    return true;
  }
  
  
  function verificarUnidades() {
    const unidadesInput = document.getElementById('units').value; // Obtener el valor como string
    const unidades = parseInt(unidadesInput, 10); // Convertir a número entero
  
    // Limpiar mensajes anteriores
    $('#units-error').hide();
  
    if (unidadesInput.trim() === '') {
      $('#units-error').html('<strong>Insertar unidades</strong>').show();
      return false;
    }
  
    if (isNaN(unidades) || unidades < 0) {
      $('#units-error').html('<strong>Las unidades deben ser un número entero no negativo</strong>').show();
      return false;
    }
    console.log("Verificacion correcta de unidades")
    return true;
  }
  
  
  
  function verificarImagen() {
    const imagen = document.getElementById('image').value;
  
    // Limpiar mensajes anteriores
    $('#image-error').hide();
  
    if (imagen == '') {
      $('#image-error').html('<strong>Insertar imagen predeterminado</strong>').show();
      return false;
    }
  
    if (!imagen || imagen !== 'img/defecto.png') {
      $('#image-error').html('<strong>Por favor, ingresa la imagen predeterminada.</strong>').show();
      return false;
    }
  
    return true;
  }