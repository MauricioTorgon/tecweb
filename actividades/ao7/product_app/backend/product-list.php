<?php
namespace Backend;
require_once __DIR__ . '/Products.php';
use Products\Products;

$productApp = new Products();// Crear una instancia de la clase Products
$productApp->list(); // Listar los productos
echo $productApp->getData();// Devolver los resultados en formato JSON