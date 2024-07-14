<?php
class Devoluciones extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['tipo']) || $_SESSION['tipo'] == 2) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Devoluciones';
        $data['productos'] = $this->model->getDatos('productos');
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['ventas'] = $this->model->getDatos('ventas');
        $this->views->getView('admin/devoluciones', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getDevoluciones(1);
        for ($i = 0; $i < count($data); $i++) {
            // Formatear la fecha de devolución
        $date = new DateTime($data[$i]['fecha_devolucion']);
        $data[$i]['fecha_devolucion'] = $date->format('d/m/Y');
            $data[$i]['accion'] = '
                <a class="btn btn-info" href="#" onclick="editDevolucion(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i> Editar</a>
                <a class="btn btn-danger" href="#" onclick="eliminarDevolucion(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i> Eliminar</a>';
        }
        echo json_encode($data);
        die();
    }


  /*public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_venta = $_POST['id_venta'];
            $id_producto = $_POST['id_producto'];
            $id_usuario = $_POST['id_usuario'];
            $cantidad = $_POST['cantidad'];
            $motivo = $_POST['motivo'];
            $fecha_devolucion = $_POST['fecha_devolucion'];
            $id = $_POST['id'];

            if (empty($id_venta) || empty($id_producto) || empty($id_usuario) || empty($cantidad) || empty($motivo) || empty($fecha_devolucion)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $data = $this->model->registrarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion);
                    if ($data > 0) {
                        // Obtener el producto actual para actualizar su stock y ventas
                        $result = $this->model->getProducto($id_producto);
                        if ($result) {
                            // Actualizar el stock y las ventas
                            $nuevaCantidad = $result['cantidad'] + $cantidad;
                            $nuevaVenta = $result['ventas'] - $cantidad;
                            $actualizado = $this->model->actualizarStock($nuevaCantidad, $nuevaVenta, $id_producto);

                            if ($actualizado) {
                                // Limpiar el carrito de devoluciones si es necesario
                                $this->cart->clear();
                                $respuesta = array('msg' => 'Devolución registrada y stock actualizado', 'icono' => 'success');
                            } else {
                                $respuesta = array('msg' => 'Error al actualizar el stock', 'icono' => 'error');
                            }
                        } else {
                            $respuesta = array('msg' => 'Error al obtener el producto', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'Error al registrar la devolución', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Devolución modificada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }*/


    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_venta = $_POST['id_venta'];
            $id_producto = $_POST['id_producto'];
            $id_usuario = $_POST['id_usuario'];
            $cantidad = $_POST['cantidad'];
            $motivo = $_POST['motivo'];
            $fecha_devolucion = $_POST['fecha_devolucion'];
            $id = $_POST['id'];

            if (empty($id_venta) || empty($id_producto) || empty($id_usuario) || empty($cantidad) || empty($motivo) || empty($fecha_devolucion)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $data = $this->model->registrarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion);
                    if ($data > 0) {
                         // Actualizar el stock y ventas del producto
                    error_log("Actualizando stock después de registrar devolución");
                    $this->model->actualizarStockD($id_producto, $cantidad);
                    $respuesta = array('msg' => 'Devolución registrada y stock actualizado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    $data = $this->model->modificarDevolucion($id_venta, $id_producto, $id_usuario, $cantidad, $motivo, $fecha_devolucion, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Devolución modificada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }

    public function delete($idDevolucion)
    {
        if (is_numeric($idDevolucion)) {
            $data = $this->model->eliminarDevolucion($idDevolucion);
            if ($data == 1) {
                $respuesta = array('msg' => 'Devolución eliminada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    public function edit($idDevolucion)
    {
        if (is_numeric($idDevolucion)) {
            $data = $this->model->getDevolucion($idDevolucion);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}


?>
