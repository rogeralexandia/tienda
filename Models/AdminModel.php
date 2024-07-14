<?php
class AdminModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND estado = 1";
        return $this->select($sql);
    }

    public function getPedidos($proceso, $year)
    {
        $sql = "SELECT SUM(total) AS total FROM ventas WHERE EXTRACT(YEAR FROM fecha) = $year AND proceso = $proceso AND tipo = 1";
        return $this->select($sql);
    }

    public function getPedidosGrafico($year)
    {
        $sql = "SELECT SUM(total) AS total FROM ventas WHERE YEAR(fecha) = $year AND tipo = 1";
        return $this->select($sql);
    }

    public function topProductos()
    {
        $sql = "SELECT nombre, ventas FROM productos ORDER BY ventas DESC LIMIT 5";
        return $this->selectAll($sql);
    }

    public function comprasMes($desde, $hasta)
{
    $sql = "SELECT 
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 1 THEN total ELSE 0 END) AS ene,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 2 THEN total ELSE 0 END) AS feb,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 3 THEN total ELSE 0 END) AS mar,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 4 THEN total ELSE 0 END) AS abr,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 5 THEN total ELSE 0 END) AS may,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 6 THEN total ELSE 0 END) AS jun,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 7 THEN total ELSE 0 END) AS jul,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 8 THEN total ELSE 0 END) AS ago,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 9 THEN total ELSE 0 END) AS sep,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 10 THEN total ELSE 0 END) AS oct,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 11 THEN total ELSE 0 END) AS nov,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 12 THEN total ELSE 0 END) AS dic
            FROM ventas 
            WHERE fecha BETWEEN :desde AND :hasta 
                AND tipo = 1 
                AND estado = 1";
    
    $params = array(':desde' => $desde, ':hasta' => $hasta);
    return $this->select($sql, $params);
}

public function ventasMes($desde, $hasta)
{
    $sql = "SELECT 
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 1 THEN total ELSE 0 END) AS ene,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 2 THEN total ELSE 0 END) AS feb,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 3 THEN total ELSE 0 END) AS mar,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 4 THEN total ELSE 0 END) AS abr,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 5 THEN total ELSE 0 END) AS may,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 6 THEN total ELSE 0 END) AS jun,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 7 THEN total ELSE 0 END) AS jul,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 8 THEN total ELSE 0 END) AS ago,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 9 THEN total ELSE 0 END) AS sep,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 10 THEN total ELSE 0 END) AS oct,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 11 THEN total ELSE 0 END) AS nov,
                SUM(CASE WHEN EXTRACT(MONTH FROM fecha) = 12 THEN total ELSE 0 END) AS dic
            FROM ventas 
            WHERE fecha BETWEEN :desde AND :hasta 
                AND tipo = 2 
                AND estado = 1";
    
    $params = array(':desde' => $desde, ':hasta' => $hasta);
    return $this->select($sql, $params);
}

    
}
 
?>