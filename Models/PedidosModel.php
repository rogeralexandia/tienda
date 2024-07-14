<?php
class PedidosModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getPedidos($tipo)
    {
        $sql = "SELECT * FROM ventas WHERE tipo = $tipo";
        return $this->selectAll($sql);
    }
    public function actualizarEstado($proceso, $idPedido)
    {
        $sql = "UPDATE ventas SET proceso=? WHERE id = ?";
        $array = array($proceso, $idPedido);
        return $this->save($sql, $array);
    }
    public function getDetalle($id_venta)
    {
        $sql = "SELECT * FROM detalle_ventas WHERE id_venta = $id_venta";
        return $this->selectAll($sql);
    }
    
}

/*class PedidosModel extends Query {
 
    public function __construct() {
        parent::__construct();
    }

    public function getPedidos($tipo) {
        $sql = "SELECT * FROM ventas WHERE tipo = ?";
        $params = array($tipo);
        return $this->selectAll($sql, $params);
    }

    public function actualizarEstado($proceso, $idPedido) {
        $sql = "UPDATE ventas SET proceso = ? WHERE id = ?";
        $params = array($proceso, $idPedido);
        return $this->save($sql, $params);
    }

    public function getDetalle($id_venta) {
        $sql = "SELECT * FROM detalle_ventas WHERE id_venta = ?";
        $params = array($id_venta);
        return $this->selectAll($sql, $params);
    }
}*/


 
?>