<?php
$session = \Config\Services::session();
?>
<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>

    <style>

    </style>
</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <?= $page_title ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-5">
                                        <label for="code" class="form-label">Código del bono</label>
                                        <input type="text" class="form-control" name="code" id="code"
                                               value="<?php if (isset($_GET['code'])) echo $_GET['code']; ?>">
                                    </div>

                                    <div class="col-lg-5">
                                        <label for="name" class="form-label">Nombre del bono</label>
                                        <input type="email" class="form-control" name="name" id="name"
                                               value="<?php if (isset($_GET['name'])) echo $_GET['name']; ?>">
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="d-flex flex-column justify-content-evenly align-items-center gap-2">
                                            <button class="btn btn-gradient-light" style="width: 60%;">Limpiar</button>
                                            <button class="btn btn-gradient-blue" style="width: 60%;">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Código</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col">Tasa</th>
                                            <th scope="col">Frecuencia</th>
                                            <th scope="col">Plazo</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<script src="/public/assets/js/app.js"></script>
</body>
</html>
