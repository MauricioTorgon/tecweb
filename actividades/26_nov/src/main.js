function getDatos(){
    var nombre = window.prompt("Nombre: ", " ");
    var edad = prompt("Edad: ", " ");
    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: ' + nombre + '</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: ' + edad + '</h3>';
};

function helloWorld(){
    document.write("Hola mundo");
};

function variablesV(){
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.92;
    var casado = false;

    document.write( nombre );
    document.write( '<br>' );
    document.write( edad );
    document.write( '<br>' );
    document.write( altura );
    document.write( '<br>' );
    document.write( casado );
};

function entradaTeclado(){
    var nombre;
    var edad;
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');
    document.write('Hola ');
    document.write(nombre);
    document.write(' así que tienes ');
    document.write(edad);
    document.write(' años');
}

function suma(){
    var valor1; 
    var valor2;
    valor1 = prompt('Introducir primer número:', '');
    valor2 = prompt('Introducir segundo número:', '');
    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);
    document.write('La suma es ');
    document.write(suma);
    document.write('<br>');
    document.write('El producto es ');
    document.write(producto);

};

function ifsentence(){
    var nombre;
    var nota;
    nombre = prompt('Ingresa tu nombre:', '');
    nota = prompt('Ingresa tu nota:', '');
    if (nota >= 4) {
        document.write(nombre + ' está aprobado con un ' + nota);
    }
};

function ifElseSentence(){
    var num1, num2;
    num1 = prompt('Ingresa el primer número:', '');
    num2 = prompt('Ingresa el segundo número:', '');
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    if (num1 > num2) {
        document.write('el mayor es ' + num1);
    } else {
        document.write('el mayor es ' + num2);
    }
};

function calificacion(){
    var nota1, nota2, nota3;

    nota1 = prompt('Ingresa 1ra. nota:', '');
    nota2 = prompt('Ingresa 2da. nota:', '');
    nota3 = prompt('Ingresa 3ra. nota:', '');

    // Convertimos los 3 string en enteros
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var pro;
    pro = (nota1 + nota2 + nota3) / 3;

    if (pro >= 7) {
        document.write('aprobado');
    } else {
        if (pro >= 4) {
            document.write('regular');
        } else {
            document.write('reprobado');
        }
    }

}

function sw(){
    var valor;
    valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '');
    // Convertimos a entero
    valor = parseInt(valor);
    switch (valor) {
        case 1:
            document.write('uno');
            break;

        case 2:
            document.write('dos');
            break;

        case 3:
            document.write('tres');
            break;

        case 4:
            document.write('cuatro');
            break;

        case 5:
            document.write('cinco');
            break;

        default:
            document.write('debe ingresar un valor comprendido entre 1 y 5.');
    }

}

function color(){
    var col; 
    col = prompt('Ingresa el color con que quieres pintar el fondo de la ventana (rojo, verde, azul)', '');
    switch (col) {
        case 'rojo': 
            document.bgColor = '#ff0000';
            break;

        case 'verde': 
            document.bgColor = '#00ff00';
            break;

        case 'azul': 
            document.bgColor = '#0000ff';
            break;
    }   
}

function whileV(){
    var x;
    x = 1;
    while (x <= 100) {
        document.write(x);
        document.write('<br>');
        x = x + 1;
    }
};

function acm(){
    var x = 1;
    var suma = 0;
    var valor;

    while (x <= 5) {
        valor = prompt('Ingresa el valor:', '');
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }

    document.write("La suma de los valores es " + suma + "<br>");

}

function dig(){
    var valor;
    do {
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);
        document.write('El valor ' + valor + ' tiene ');
        if (valor < 10) {
            document.write('Tiene 1 dígito');
        } else if (valor < 100) {
            document.write('Tiene 2 dígitos');
        } else if (valor < 1000) {
            document.write('Tiene 3 dígitos');
        } else {
            document.write('Fuera de rango');
        }
        document.write('<br>');
    } while (valor != 0);
}

function forS(){
    var f;
    for (f = 1; f <= 10; f++) {
        document.write(f + " ");
    }
};

function corr(){
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
};


function mostrarMensaje() {
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
};

function corrV2(){    
    mostrarMensaje();
    mostrarMensaje();
    mostrarMensaje();    
};

function mostrarRango(x1, x2) {
    var inicio;
    for (inicio = x1; inicio <= x2; inicio++) {
        document.write(inicio + ' ');
    }
}

function rang(){
    var valor1, valor2;
    valor1 = prompt('Ingresa el valor inferior:', '');
    valor1 = parseInt(valor1);
    valor2 = prompt('Ingresa el valor superior:', '');
    valor2 = parseInt(valor2);
    mostrarRango(valor1, valor2);    
}