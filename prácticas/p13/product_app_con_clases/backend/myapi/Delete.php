<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase;
require_once __DIR__ . '/DataBase.php';

class Delete extends DataBase {
    private $data;

    public function __construct($db, $user='root', $pass='12345678a') {
        $this->data = array();
        parent::__construct($db, $user, $pass);
    }

    public function delete($id) {
        // Inicialización de respuesta por defecto
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );

        // Validación de ID y escapa para evitar inyecciones SQL
        if (isset($id) && is_numeric($id)) {
            $id = $this->conexion->real_escape_string($id);

            // Query de actualización para marcar el producto como eliminado
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";

            if ($this->conexion->query($sql)) {
                // Verificar si la operación afectó alguna fila
                if ($this->conexion->affected_rows > 0) {
                    $this->data['status'] = "success";
                    $this->data['message'] = "Producto eliminado";
                } else {
                    $this->data['message'] = "No se encontró ningún producto con el ID proporcionado";
                }
            } else {
                $this->data['message'] = "ERROR: No se ejecutó la consulta. " . $this->conexion->error;
            }

            // Cierra la conexión
            $this->conexion->close();
        } else {
            $this->data['message'] = "ID no válido o no proporcionado";
        }
    }

    public function getData() {
        // Conversión de array a JSON con formato legible
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
?>
