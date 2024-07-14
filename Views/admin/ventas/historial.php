<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h4 class="page-title m-0">Historial ventas</h4>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end page-title-box -->
    </div>
</div>
<!-- end page title -->
<!--contador de paginas--> 
<div id="contador-visitas" style="text-align: right;">
    <p>Visitas a la página de Historial: <span id="visitas"></span></p>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblHistorial">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Productos</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo BASE_URL . 'public/admin/js/page/historial_ventas.js'; ?>"></script>
<script src="<?php echo BASE_URL . 'public/admin/js/page/contador_visitas.js'; ?>"></script>
<script>
        // Clave única para la página de productos
        incrementarVisitas('historial');
    </script>

</body>

</html>