class app {
  constructor() {
    this.edit = false;
    this.setupEventListeners();
    this.fetchProducts();
    $('#product-result').hide();
    this.hideErrors();
  }

  

  setupEventListeners() {
    $('#name').on('keyup', () => this.searchByName());
    $('#search').on('keyup', () => this.searchProducts());
    $('#product-form').on('submit', (e) => this.submitForm(e));
    
    // Agregar evento blur para validación en tiempo real
    $('#name').on('blur', () => this.validateField('#name', '#name-error', 100, 'Insertar un nombre'));
    $('#brand').on('blur', () => this.validateField('#brand', '#brand-error', 100, 'Insertar una marca'));
    $('#model').on('blur', () => this.validateField('#model', '#model-error', 25, 'Insertar un modelo'));
    $('#price').on('blur', () => this.validatePrice());
    $('#details').on('blur', () => this.validateField('#details', '#details-error', 250, 'Insertar detalles'));
    $('#units').on('blur', () => this.validateUnits());
    $('#image').on('blur', () => this.validateImage());
    
    $(document).on('click', '.product-delete', (e) => this.deleteProduct(e));
    $(document).on('click', '.product-item', (e) => this.loadProductForEdit(e));
  }
  

  hideErrors() {
    $('#name-error, #price-error, #details-error, #units-error, #brand-error, #model-error, #image-error, #name-valid').hide();
  }

  async searchByName() {
    const search = $('#name').val();

    if (search === '') {
      $('#name-valid').hide();
      return;
    }

    try {
      const response = await $.ajax({
        url: './backend/product-search.php',
        type: 'GET',
        data: { search }
      });

      const exists = await this.doesProductExist(search);
      $('#name-valid')
        .html(exists ? '<strong>El artículo ya existe</strong>' : '<strong>El artículo no existe</strong>')
        .css('background-color', exists ? 'red' : 'green')
        .show();
    } catch (error) {
      console.error('Error en la búsqueda de producto:', error);
    }
  }

  async doesProductExist(productName) {
    try {
      const response = await $.ajax({
        url: './backend/product-list.php',
        type: 'GET'
      });

      const products = JSON.parse(response);
      return products.some(product => productName === product.nombre);
    } catch (error) {
      console.error('Error al verificar la existencia del producto:', error);
      return false;
    }
  }

  async searchProducts() {
    const search = $('#search').val();
  
    if (search) {
      try {
        const response = await $.ajax({
          url: './backend/product-search.php',
          type: 'GET',
          data: { search }
        });
  
        const products = JSON.parse(response);
  
        let productList = '';
        products.forEach(product => {
          productList += `<li>${product.nombre}</li>`;
        });
  
        $('#product-result').html(`<ul>${productList}</ul>`).show();
  
      } catch (error) {
        console.error('Error en la búsqueda de productos:', error);
      }
    } else {
      $('#product-result').hide();
    }
  }
  

  async fetchProducts() {
    try {
      const response = await $.ajax({
        url: './backend/product-list.php',
        type: 'GET'
      });

      this.displayProducts(JSON.parse(response));
      
    } catch (error) {
      console.error('Error al obtener productos:', error);
    }
  }

  displayProducts(products) {
    let template = '';
    products.forEach(product => {
      template += `
        <tr productId="${product.id}">
          <td>${product.id}</td>
          <td><a href="#" class="product-item">${product.nombre}</a></td>
          <td>
            <ul>
              <li>Precio: ${product.precio}</li>
              <li>Unidades: ${product.unidades}</li>
              <li>Modelo: ${product.modelo}</li>
              <li>Marca: ${product.marca}</li>
              <li>Detalles: ${product.detalles}</li>
            </ul>
          </td>
          <td><button class="product-delete btn btn-danger">Delete</button></td>
        </tr>`;
    });
    $('#products').html(template);
  }

  submitForm(e) {
    e.preventDefault();
    
    if (!this.validateForm()) return;

    const productData = {
      id: $('#productId').val(),
      name: $('#name').val(),
      brand: $('#brand').val(),
      model: $('#model').val(),
      price: $('#price').val(),
      details: $('#details').val(),
      units: $('#units').val(),
      image: $('#image').val(),
    };

    const url = this.edit ? './backend/product-edit.php' : './backend/product-add.php';
    this.saveProduct(url, productData);
  }

  async saveProduct(url, data) {
      const response = await $.ajax({
        url: url,
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json'
      });
      
      const result = JSON.parse(response);
      
      
      $('#container').html(`Status: ${result.status}<br />Message: ${result.message}`);
      $('#product-result').show();
      this.fetchProducts();
    
  }

  async deleteProduct(e) {
    if (confirm('¿Estás seguro que deseas eliminar el producto?')) {
      const element = $(e.target).closest('tr');
      const id = element.attr('productId');
      
      try {
        const response = await $.ajax({
          url: './backend/product-delete.php',
          type: 'GET',
          data: { id }
        });

        const result = JSON.parse(response);
        $('#container').html(`Status: ${result.status}<br />Message: ${result.message}`);
        $('#product-result').show();
        this.fetchProducts();
      } catch (error) {
        console.error('Error al eliminar producto:', error);
      }
    }
  }

  async loadProductForEdit(e) {
    const element = $(e.target).closest('tr');
    const id = element.attr('productId');

    try {
      const response = await $.ajax({
        url: './backend/product-single.php',
        type: 'GET',
        data: { id }
      });

      const product = JSON.parse(response);
      $('#name').val(product.nombre);
      $('#price').val(product.precio);
      $('#units').val(product.unidades);
      $('#model').val(product.modelo);
      $('#brand').val(product.marca);
      $('#details').val(product.detalles);
      $('#image').val("img/defecto.png");
      $('#productId').val(product.id);
      this.edit = true;
    } catch (error) {
      console.error('Error al cargar producto para edición:', error);
    }
  }

  validateForm() {
    return (
      this.validateField('#name', '#name-error', 100, 'Insertar un nombre') &&
      this.validateField('#brand', '#brand-error', 100, 'Insertar una marca') &&
      this.validateField('#model', '#model-error', 25, 'Insertar un modelo') &&
      this.validatePrice() &&
      this.validateField('#details', '#details-error', 250, 'Insertar detalles') &&
      this.validateUnits() &&
      this.validateImage()
    );
  }

  validateField(selector, errorSelector, maxLength, errorMessage) {
    const value = $(selector).val();
    $(errorSelector).hide();

    if (!value) {
      $(errorSelector).text(errorMessage).show();
      return false;
    }

    if (value.length > maxLength) {
      $(errorSelector).text(`No debe exceder ${maxLength} caracteres`).show();
      return false;
    }

    return true;
  }

  validatePrice() {
    const priceInput = $('#price').val();
    const price = parseFloat(priceInput);
    $('#price-error').hide();

    if (!priceInput || isNaN(price) || price < 99.99) {
      $('#price-error').text('El precio debe ser un número y no puede ser menor a 99.99').show();
      return false;
    }

    return true;
  }

  validateUnits() {
    const unitsInput = $('#units').val();
    const units = parseInt(unitsInput, 10);
    $('#units-error').hide();

    if (!unitsInput || isNaN(units) || units < 0) {
      $('#units-error').text('Las unidades deben ser un número entero no negativo').show();
      return false;
    }

    return true;
  }

  validateImage() {
    const image = $('#image').val();
    $('#image-error').hide();

    if (!image || image !== 'img/defecto.png') {
      $('#image-error').text('Por favor, ingresa la imagen predeterminada.').show();
      return false;
    }

    return true;
  }
}

// Inicializar app
$(document).ready(() => {
  new app();
});