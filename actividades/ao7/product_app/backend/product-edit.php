<?php
namespace Backend;
require_once __DIR__ . '/Products.php';
use Products\Products;
$productApp = new Products();// Crear una instancia de la clase Products
$productData = json_decode(file_get_contents('php://input'));// Crear un objeto de producto desde la entrada JSON
$productApp->edit($productData);// Llamar al método edit para modificar el producto
echo $productApp->getData();// Devolver la respuesta en formato JSON