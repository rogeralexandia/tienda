<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h4 class="page-title m-0">Devoluciones</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contador de visitas-->
<div id="contador-visitas" style="text-align: right;">
            <p>Visitas a la página de Devoluciones: <span id="visitas"></span></p>
        </div>


<button class="btn btn-primary mb-2" type="button" id="nuevo_registro">Nueva Devolución</button>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover display nowrap align-middle" style="width: 100%;" id="tblDevoluciones">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Venta</th>
                        <th>Producto</th>
                        <th>Usuario</th>
                        <th>Cantidad</th>
                        <th>Motivo</th>
                        <th>Fecha Devolución</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="nuevoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmRegistro" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id">
                        <div class="col-md-12 mb-3">
                            <label for="">Venta <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <select id="id_venta" class="form-control" name="id_venta">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['ventas'] as $venta) { ?>
                                        <option value="<?php echo $venta['id']; ?>"><?php echo $venta['id']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Producto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <select id="id_producto" class="form-control" name="id_producto">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['productos'] as $producto) { ?>
                                        <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Usuario <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <select id="id_usuario" class="form-control" name="id_usuario">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['usuarios'] as $usuario) { ?>
                                        <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Cantidad <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Motivo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                <textarea id="motivo" name="motivo" class="form-control" rows="3" placeholder="Motivo"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Fecha de Devolución <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input id="fecha_devolucion" class="form-control" type="date" name="fecha_devolucion">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo BASE_URL . 'public/admin/js/page/devoluciones.js'; ?>"></script>
<script src="<?php echo BASE_URL . 'public/admin/js/page/contador_visitas.js'; ?>"></script>
<script>
        // Clave única para la página de productos
        incrementarVisitas('devoluciones');
    </script>

</body>
</html>
