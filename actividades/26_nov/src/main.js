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