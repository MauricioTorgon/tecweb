<?php
namespace Backend;
require_once __DIR__ . '/Products.php';
use Products\Products;
$id = $_GET['id']; // Obtener el ID del producto desde la solicitud GET
$productApp = new Products();// Crear una instancia de la clase Products
$productApp->single($id);// Obtener el producto por ID
echo $productApp->getData(); // Devolver la respuesta en formato JSON