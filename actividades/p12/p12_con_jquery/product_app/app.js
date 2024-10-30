// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    precio: 0.0,
    unidades: 1,
    modelo: "XX000",
    marca: "NA",
    detalles: "NA",
    imagen: "img/defecto.png",
  };
  function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
  }
  $(document).ready(function () {
    let edit = false;
    console.log("jQuery is working");
    ListarProductos();
    //Función para buscar productos
    $("#search").keyup(function (e) {
      let search = $("#search").val();
      $.ajax({
        url: "backend/product-search.php",
        type: "POST",
        data: { search },
        success: function (response) {
          console.log(response);
          let productos = JSON.parse(response);
          let template = "";
          productos.forEach((producto) => {
            template += `<li>
                          ${producto.nombre}
                      </li>`;
          });
          if (productos.length > 0) {
            $("#product-result").removeClass("d-none");
          }
          $("#container").html(template);
        },
      });
    });
    //Envio de productos
    $("#product-form").submit(function (e) {
      e.preventDefault();
      let errores = [];
      let id = $("#productId").val();
      let nombre = $("#name").val();
      let productData = JSON.parse($("#description").val());
      let marca = productData.marca;
      let modelo = productData.modelo;
      let precio = productData.precio;
      let detalles = productData.detalles;
      let unidades = productData.unidades;
      let imagen = productData.imagen;
      // Validar nombre
      if (nombre.length === 0 || nombre.length > 100) {
        errores.push(
          "El nombre del producto es obligatorio y debe tener 100 caracteres o menos."
        );
      }
      // Validar precio
      if (isNaN(precio) || precio <= 99.99) {
        errores.push(
          "Obligatoriamente debe asignar un precio y este debe ser mayor a 99.99"
        );
      }
      // Validar unidades
      if (isNaN(unidades) || unidades < 0) {
        errores.push(
          "Obligatoriamente debe asignar la cantidad de unidades y deben ser un número entero positivo."
        );
      }
      // Validar modelo
      let modelPattern = /^[a-zA-Z0-9]+$/;
      if (modelo === "" || !modelPattern.test(modelo) || modelo > 25) {
        errores.push(
          "Obligatoriamente debe asignar el modelo del producto, debe ser alfanumérico y tener 25 caracteres o menos."
        );
      }
      // Validar marca
      if (marca === "") {
        errores.push("Obligatoriamente debe asignar la marca del producto");
      }
      // Validar detalles
      if (detalles.length > 250) {
        errores.push("Los detalles no pueden tener más de 250 caracteres.");
      }
      // Validar imagen
      if (imagen === "") {
        imagen = "img/imgfallo.jpeg";
      }
      // Errores
      if (errores.length > 0) {
        alert(
          "No se realizó la inserción del producto debido a:\n" +
            errores.join("\n")
        );
        return;
      }
      const finalProductData = {
        id: id,
        nombre: nombre,
        marca: marca,
        modelo: modelo,
        precio: precio,
        detalles: detalles,
        unidades: unidades,
        imagen: imagen,
      };
      let url_1 =
        edit === false ? "backend/product-add.php" : "backend/product-edit.php";
      $.ajax({
        url: url_1,
        type: "POST",
        ContentType: "application/json",
        data: JSON.stringify(finalProductData),
        success: function (response) {
          ListarProductos();
          let message = JSON.parse(response);
          let template = "";
          template = `<p>
                      ${message.message}
                  </p>`;
          // Mostrar el contenedor si hay productos
          if (message.message.length > 0) {
            $("#product-result").removeClass("d-none");
          }
          $("#container").html(template);
        },
        error: function (err) {
          console.error("Error al agregar producto:", err);
        },
      });
    });
    //Borrado
    $(document).on("click", ".product-delete", function () {
      if (confirm("¿Estas seguro de querer eliminar el producto?")) {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr("productId");
        $.post("backend/product-delete.php", { id }, function (response) {
          ListarProductos();
          let message = JSON.parse(response);
          let template = "";
          template = `<p>
                      ${message.message}
                  </p>`;
          if (message.message.length > 0) {
            $("#product-result").removeClass("d-none");
          }
          $("#container").html(template);
        });
      }
    });
    // Función para listar productos NO eliminados
function ListarProductos() {
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
                            <td>
                            <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
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
    //Editar producto
    $(document).on("click", ".product-item", function () {
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr("productId");
      $.post("backend/product-single.php", { id }, function (response) {
        const product = JSON.parse(response);
        $("#name").val(product.nombre);
        var updatedJSON = {
          precio: Number(product.precio),
          unidades: Number(product.unidades),
          modelo: product.modelo,
          marca: product.marca,
          detalles: product.detalles || baseJSON.detalles,
          imagen: product.imagen || baseJSON.imagen,
        };
        
        $("#description").val(JSON.stringify(updatedJSON, null, 2));
        $("#productId").val(product.id);
        edit = true;
      });
    });
    
  });