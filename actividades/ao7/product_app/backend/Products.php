<?php
namespace Products;

require_once __DIR__ ."/database.php";
use Database\DataBase;

class Products extends DataBase {
    private $response = [];

    public function __construct() {
        parent::__construct();
    }

    // Métodos como add, delete, edit, etc
    public function add($product) {
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                VALUES ('{$product->name}', '{$product->brand}', '{$product->model}', 
                        {$product->price}, '{$product->details}', {$product->units}, '{$product->image}')";
    
        if ($this->conexion->query($sql)) {
            $this->response = [
                'status' => 'success',
                'message' => 'Producto agregado',
                'product_id' => $this->conexion->insert_id  // Include the new product's ID
            ];
        } else {
            $this->response = [
                'status' => 'error',
                'message' => 'No se pudo agregar el producto: ' . mysqli_error($this->conexion)
            ];
        }
    
        return $this->response;
    }


    // Método para eliminar un producto por ID
    public function delete($id) {
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto eliminado'];
        } else {
            $this->response = ['status' => 'error', 'message' => 'No se pudo eliminar el producto: ' . mysqli_error($this->conexion)];
        }
        return $this->response; // Asegúrate de devolver la respuesta
    }
    

    // Método para editar un producto
    public function edit($product) {
        $sql = "UPDATE productos SET nombre = '{$product->name}', marca = '{$product->brand}', 
                modelo = '{$product->model}', precio = {$product->price}, detalles = '{$product->details}', 
                unidades = {$product->units} WHERE id = {$product->id}";

        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto modificado'];
        } else {
            $this->response = ['status' => 'error', 'message' => 'No se pudo modificar el producto: ' . mysqli_error($this->conexion)];
        }
    }

    // Método para listar todos los productos
    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->response = ['status' => 'error', 'message' => 'No se encontraron productos'];
        }
    }

    // Método para buscar productos por ID, nombre, marca o detalles
    public function search($searchTerm) {
        $sql = "SELECT * FROM productos WHERE (id = '{$searchTerm}' OR nombre LIKE '%{$searchTerm}%' 
                OR marca LIKE '%{$searchTerm}%' OR detalles LIKE '%{$searchTerm}%') AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->response = ['status' => 'error', 'message' => 'No se encontraron productos'];
        }
    }

    // Método para obtener un solo producto por ID
    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_assoc();
        } else {
            $this->response = ['status' => 'error', 'message' => 'Producto no encontrado'];
        }
    }

    // Método para obtener un solo producto por nombre
    public function singleByName($name) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%' AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_assoc();
        } else {
            $this->response = ['status' => 'error', 'message' => 'Producto no encontrado'];
        }
    }

    // Método para obtener la respuesta como un JSON
    public function getData() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}