// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 100.0,
    "unidades": 1,
    "modelo": "abc",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/defecto.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TEXTO A BUSCAR (POR NOMBRE, MARCA O DETALLES)
    var search = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/readModificado.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);
            
            // SE OBTIENE EL ARRAY DE PRODUCTOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);

            // SE VERIFICA SI HAY PRODUCTOS ENCONTRADOS
            if (productos.length > 0) {
                let template = '';
                
                // RECORRER EL ARRAY DE PRODUCTOS Y CREAR UNA FILA PARA CADA UNO
                productos.forEach(function(producto) {
                    let descripcion = '';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';
                    
                    // PLANTILLA DE LA FILA A INSERTAR EN LA TABLA
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // INSERTAR LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            } else {
                // SI NO HAY PRODUCTOS COINCIDENTES, MOSTRAR UN MENSAJE
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos</td></tr>';
            }
        }
    };
    // ENVÍO DE LA CADENA A BUSCAR COMO PARÁMETRO POST
    client.send("search=" + encodeURIComponent(search));
}


// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"/*
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON,null,2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    
    let nombre = finalJSON["nombre"];
    let modelo = finalJSON["modelo"];
    let precio = finalJSON["precio"];
    let detalles = finalJSON["detalles"];
    let unidades = finalJSON["unidades"];
    let imagen = finalJSON["imagen"];

    // Validación del nombre (requerido y máximo 100 caracteres)
    if (nombre === "" || nombre.length > 100) {
        alert("El nombre del producto es requerido y debe tener 100 caracteres o menos.");
        event.preventDefault();
        return;
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

    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            if(client.responseText != "\r\n"){
                alert(client.responseText);
            }
        }
    };
    client.send(productoJsonString);
    console.log(client.responseText);
    console.log(finalJSON["unidades"]);
}


// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}


function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}