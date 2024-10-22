<?php
    include_once __DIR__.'/database.php';
    
    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );
    if(!empty($producto)) {
        
        $jsonOBJ = json_decode($producto);
        
        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
        $result = $conexion->query($sql);
    if ($result->num_rows === 0) {
      // Si no hay duplicados, inserta el nuevo producto
    $sql_insert = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', 0, {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}')";
    if($conexion->query($sql_insert)) {
          $data['status'] =  "success";
          $data['message'] =  "Producto agregado";
      } else {
         $data['message'] = "ERROR: No se ejecuto $sql_insert. " . mysqli_error($conexion);
       }
    } else {
       $data['message'] = "Ya existe un producto con ese nombre";
    }
        $result->free();
        // Cierra conexion
        $conexion->close();
    }
    
    echo json_encode($data, JSON_PRETTY_PRINT);
?>