<?php
namespace Backend;
require_once __DIR__ . '/Products.php';
use Products\Products;
$name = $_GET['name'];// Obtener el nombre del producto desde la solicitud GET
$productApp = new Products();// Crear una instancia de la clase Products
$productApp->singleByName($name);
echo $productApp->getData();// Devolver la respuesta en formato JSON