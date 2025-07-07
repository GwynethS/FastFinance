<?php
$session = \Config\Services::session();
$coinSymbol = isset($bond) ? ($bond['coin'] == 'SOLES' ? 'S/. ' : '$') : '';
$role = $session->get('role')['alias'];
?>
<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>

    <style>
        .pointer-none {
            pointer-events: none;
        }
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
                                <form action="/public/cash-flow-list" method="get">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <label for="code" class="form-label">Código del bono</label>
                                            <input type="text" class="form-control" name="code" id="code"
                                                   value="<?php if (isset($_GET['code'])) echo $_GET['code']; ?>">
                                        </div>

                                        <div class="col-lg-5">
                                            <label for="name" class="form-label">Nombre del bono</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   value="<?php if (isset($_GET['name'])) echo $_GET['name']; ?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="d-flex flex-column justify-content-evenly align-items-center gap-2">
                                                <button class="btn btn-gradient-light" style="width: 60%;" type="reset">
                                                    Limpiar
                                                </button>
                                                <button class="btn btn-gradient-blue" style="width: 60%;" type="submit">
                                                    Buscar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (isset($results)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="duration" class="form-label">Duración</label>
                                            <input type="text" class="form-control pointer-none" name="duration"
                                                   id="duration"
                                                   value="<?= number_format($results['duration'], 4); ?>">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="modified-duration" class="form-label">Duración
                                                modificada</label>
                                            <input type="text" class="form-control pointer-none"
                                                   name="modified-duration"
                                                   id="modified-duration"
                                                   value="<?= number_format($results['modified_duration'], 4); ?>">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="convexity" class="form-label">Convexidad</label>
                                            <input type="text" class="form-control pointer-none" name="convexity"
                                                   id="convexity"
                                                   value="<?= number_format($results['convexity'], 4); ?>">
                                        </div>
                                        <?php if (in_array($role, ['admin', 'issuer'])) { ?>
                                            <div class="col-lg-4 mb-3">
                                                <label for="issuer-tcea" class="form-label">TCEA Emisor</label>
                                                <input type="text" class="form-control pointer-none" name="issuer-tcea"
                                                       id="issuer-tcea"
                                                       value="<?= number_format($results['issuer_tcea'], 4); ?>">
                                            </div>
                                        <?php } ?>
                                        <?php if (in_array($role, ['admin', 'investor'])) { ?>
                                            <div class="col-lg-4 mb-3">
                                                <label for="investor-trea" class="form-label">TREA Inversor</label>
                                                <input type="text" class="form-control pointer-none"
                                                       name="investor-trea"
                                                       id="investor-trea"
                                                       value="<?= number_format($results['investor_trea'], 4) ?>">
                                            </div>
                                        <?php } ?>
                                        <div class="col-lg-4 mb-3">
                                            <label for="bond-price" class="form-label">Precio del bono</label>
                                            <input type="text" class="form-control pointer-none" name="bond-price"
                                                   id="bond-price"
                                                   value="<?= number_format($results['bond_price'], 2); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (isset($cashFlow)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="vertical-align: middle">
                                                    N°
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Fecha programada
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Plazo de gracia
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Saldo inicial
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Interés
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Cuota
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Amortización
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Saldo final
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Prima
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Flujo del emisor
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Flujo del inversor
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Flujo actual
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Flujo actual x plazo
                                                </th>
                                                <th class="text-center" style="vertical-align: middle">
                                                    Factor p/convexidad
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($cashFlow as $row) { ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= $row['period'] ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= $row['date'] ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= $row['grace'] ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['initial_balance']) ? $coinSymbol . number_format($row['initial_balance'], 2) : $row['initial_balance']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['interest']) ? $coinSymbol . number_format($row['interest'], 2) : $row['interest']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['quote']) ? $coinSymbol . number_format($row['quote'], 2) : $row['quote']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['amortization']) ? $coinSymbol . number_format($row['amortization'], 2) : $row['amortization']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['final_balance']) ? $coinSymbol . number_format($row['final_balance'], 2) : $row['final_balance']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['premium']) ? $coinSymbol . number_format($row['premium'], 2) : $row['premium']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['issuer_flow']) ? $coinSymbol . number_format($row['issuer_flow'], 2) : $row['issuer_flow']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['investor_flow']) ? $coinSymbol . number_format($row['investor_flow'], 2) : $row['investor_flow']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['present_value']) ? $coinSymbol . number_format($row['present_value'], 2) : $row['present_value']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['weighted_present_value']) ? $coinSymbol . number_format($row['weighted_present_value'], 2) : $row['weighted_present_value']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="text-center text-nowrap">
                                                        <?= is_numeric($row['convexity_factor']) ? $coinSymbol . number_format($row['convexity_factor'], 2) : $row['convexity_factor']; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<script src="/public/assets/js/app.js"></script>
</body>
</html>
