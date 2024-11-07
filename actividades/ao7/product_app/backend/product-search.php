<?php
namespace Backend;
require_once __DIR__ . '/Products.php';
use Products\Products;
$searchTerm = $_GET['search']; // Obtener el término de búsqueda desde la solicitud GET
$productApp = new Products(); // Crear una instancia de la clase Products
$productApp->search($searchTerm); // Realizar la búsqueda
echo $productApp->getData(); // Devolver la respuesta en formato JSON