<?php
class DevolucionesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDatos($table)
    {
        $sql = "SELECT * FROM $table WHERE estado = 1";
        return $this->selectAll($sql);
    }

    public function getDevoluciones($estado)
    {
        $sql = "SELECT d.*, p.nombre as producto, u.nombre as usuario FROM devoluciones d
                INNER JOIN productos p ON d.id_producto = p.id
                INNER JOIN usuarios u ON d.id_usuario = u.id
                WHERE d.estado = $estado";
        return $this->selectAll($sql);
    }

    /*public function registrarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion)
    {
        $sql = "INSERT INTO devoluciones (id_venta, id_producto, id_usuario, cantidad, motivo, fecha_devolucion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $array = array($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion);
        $result = $this->insertar($sql, $array);
        if ($result) {
            // Actualizar el stock del producto
            $this->actualizarStock($id_producto, $cantidad);
        }
    
        return $result;
    }*/
    public function registrarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion)
    {
        $sql = "INSERT INTO devoluciones (id_venta, id_producto, id_usuario, cantidad, motivo, fecha_devolucion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $array = array($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion);
        return $this->insertar($sql, $array);
    }
    /*public function registrarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion)
    {
        $sql = "INSERT INTO devoluciones (id_venta, id_producto, id_usuario, cantidad, motivo, fecha_devolucion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $array = array($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion);
        $result = $this->insertar($sql, $array);
        
        if ($result) {
            // Obtener el producto actual para actualizar su stock y ventas
            $producto = $this->getProducto($id_producto);
            if ($producto) {
                // Calcular los nuevos valores de stock y ventas
                $nuevaCantidad = $producto['cantidad'] + $cantidad;
                $nuevaVenta = $producto['ventas'] - $cantidad;
                // Actualizar el stock del producto
                return $this->actualizarStock($nuevaCantidad, $nuevaVenta, $id_producto);
            }
        }
        return false;
    }*/



    public function modificarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion, $id)
    {
        $sql = "UPDATE devoluciones SET id_venta = ?, id_producto = ?, id_usuario = ?, cantidad = ?, motivo = ?, fecha_devolucion = ? WHERE id = ?";
        $array = array($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion, $id);
        return $this->save($sql, $array);
    }

    public function eliminarDevolucion($idDevolucion)
    {
        $sql = "DELETE FROM devoluciones WHERE id = ?";
        $array = array($idDevolucion);
        return $this->save($sql, $array);
    }

    public function getDevolucion($idDevolucion)
    {
        $sql = "SELECT * FROM devoluciones WHERE id = ?";
        $array = array($idDevolucion);
        return $this->select($sql, $array);
    }
    public function actualizarStockD($id_producto, $cantidad)
    {
        // Actualizar la cantidad incrementando y las ventas decrementando
        $sql = "UPDATE productos SET cantidad = cantidad + ?/*, ventas = ventas - ?*/
        WHERE id = ?";
        $array = array($cantidad, $id_producto);
        return $this->save($sql, $array);
    }


}

?>
