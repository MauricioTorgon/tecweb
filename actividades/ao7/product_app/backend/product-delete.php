<?php
namespace Backend;

require_once __DIR__ . '/myapi/Products.php';
use Products\Products;
$id = $_GET['id'];// Obtener el ID del producto desde la solicitud GET
$productApp = new Products();// Crear una instancia de la clase Products
$productApp->delete($id);// Llamar al método delete para eliminar el producto
echo $productApp->getData();// Devolver la respuesta en formato JSON