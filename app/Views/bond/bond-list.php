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

                <div class="d-flex justify-content-between align-items-center">
                    <?= $page_title ?>
                    <button class="btn btn-submit mb-2" data-bs-toggle="modal" data-bs-target="#createBondModal">
                        <i class="bx bx-plus"></i> Agregar bono
                    </button>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/public/bond-list" method="get">
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
                                            <th scope="col" class="text-center">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (isset($bonds)) {
                                            $i = 0;
                                            foreach ($bonds as $bond) {
                                                $i++; ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $i; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['code']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['name']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['code']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['code']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['code']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['code']; ?></td>
                                                    <td style="vertical-align: middle;"
                                                        class="d-flex justify-content-center gap-3">
                                                        <a href="" class="btn btn-icon"
                                                           style="background-color: #FDF2D6;">
                                                            <i class='bx bx-edit fw-bold' style="font-size: 16px;"></i>
                                                        </a>
                                                        <a href="" class="btn btn-icon"
                                                           style="background-color: #FDDFCF;">
                                                            <i class='bx bx-trash-alt fw-bold'
                                                               style="font-size: 16px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="createBondModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Agregar un bono</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="/public/bond-create" method="post">
                                <div class="modal-body">

                                    <fieldset>
                                        <legend>Datos del bono</legend>

                                        <div class="row align-items-baseline">
                                            <!--NOMBRE DEL BONO-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="name" class="form-label">Nombre del bono</label>
                                                <input type="text" class="form-control" name="name" id="name" required>
                                            </div>
                                            <!--MONEDA-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="coin" class="form-label">Moneda</label>

                                                <select name="coin" id="coin" class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="SOLES" <?php if (isset($userSettings) and $userSettings['coin'] == 'SOLES') echo 'selected'; ?>>
                                                        SOLES
                                                    </option>
                                                    <option value="DÓLARES" <?php if (isset($userSettings) and $userSettings['coin'] == 'DÓLARES') echo 'selected'; ?>>
                                                        DÓLARES
                                                    </option>
                                                </select>
                                            </div>
                                            <!--VALOR NOMINAL-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="face_value" class="form-label">Valor nominal</label>
                                                <input type="text" class="form-control" name="face_value"
                                                       id="face_value" required>
                                            </div>
                                            <!--VALOR COMERCIAL-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="market_value" class="form-label">Valor comercial</label>
                                                <input type="text" class="form-control" name="market_value"
                                                       id="market_value" required>
                                            </div>
                                            <!--TIPO DE TASA DE INTERÉS-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="interest_rate_type" class="form-label">
                                                    Tipo de tasa de interés
                                                </label>

                                                <select name="interest_rate_type" id="interest_rate_type"
                                                        class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="EFECTIVA" <?php if (isset($userSettings) and $userSettings['interest_rate_type'] == 'EFECTIVA') echo 'selected'; ?>>
                                                        EFECTIVA
                                                    </option>
                                                    <option value="NOMINAL" <?php if (isset($userSettings) and $userSettings['interest_rate_type'] == 'NOMINAL') echo 'selected'; ?>>
                                                        NOMINAL
                                                    </option>
                                                </select>
                                            </div>
                                            <!--PERÍODO DE CAPITALIZACIÓN-->
                                            <div class="col-lg-3 mb-3" id="capitalization-period-container">
                                                <label for="capitalization_period" class="form-label">
                                                    Período de capitalización
                                                </label>
                                                <select name="capitalization_period" id="capitalization_period"
                                                        class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="1" selected>DIARIA</option>
                                                    <option value="15">QUINCENAL</option>
                                                    <option value="30">MENSUAL</option>
                                                    <option value="60">BIMESTRAL</option>
                                                    <option value="90">TRIMESTRAL</option>
                                                    <option value="120">CUATRIMESTRAL</option>
                                                    <option value="180">SEMESTRAL</option>
                                                    <option value="360">ANUAL</option>
                                                </select>
                                            </div>
                                            <!--TASA DE INTERÉS-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="interest_rate" class="form-label">Tasa de interés
                                                    (%)</label>
                                                <input type="text" class="form-control" name="interest_rate"
                                                       id="interest_rate" required>
                                            </div>
                                            <!--TASA ANUAL DE DESCUENTO (COK)-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="cok" class="form-label">Tasa anual de descuento (COK)
                                                    (%)</label>
                                                <input type="text" class="form-control" name="cok" id="cok" required>
                                            </div>
                                            <!--N° DE AÑOS-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="term_years" class="form-label">N° de años</label>
                                                <input type="number" class="form-control" name="term_years"
                                                       id="term_years" required>
                                            </div>
                                            <!--FRECUENCIA DE PAGO-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="payment_frequency" class="form-label">
                                                    Frecuencia de pago
                                                </label>
                                                <select name="payment_frequency" id="payment_frequency"
                                                        class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="1">DIARIA</option>
                                                    <option value="15">QUINCENAL</option>
                                                    <option value="30">MENSUAL</option>
                                                    <option value="60">BIMESTRAL</option>
                                                    <option value="90">TRIMESTRAL</option>
                                                    <option value="120">CUATRIMESTRAL</option>
                                                    <option value="180">SEMESTRAL</option>
                                                    <option value="360" selected>ANUAL</option>
                                                </select>
                                            </div>
                                            <!--DÍAS X AÑO-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="year_days" class="form-label">
                                                    Días x año
                                                </label>
                                                <select name="year_days" id="year_days"
                                                        class="form-select">
                                                    <option value="">SELECCIONE</option>
                                                    <option value="360" selected>360</option>
                                                    <option value="365">365</option>
                                                </select>
                                            </div>
                                            <!--PERÍODOS CON GRACIA TOTAL-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="total_grace" class="form-label">Períodos con gracia
                                                    total</label>
                                                <input type="number" class="form-control" name="total_grace"
                                                       id="total_grace" required>
                                            </div>
                                            <!--PEÍODOS CON GRACIA PARCIAL-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="partial_grace" class="form-label">Períodos con gracia
                                                    parcial</label>
                                                <input type="number" class="form-control" name="partial_grace"
                                                       id="partial_grace" required>
                                            </div>
                                            <!--FECHA DE EMISIÓN-->
                                            <div class="col-lg-3 mb-3">
                                                <label for="issue_date" class="form-label">
                                                    Fecha de emisión
                                                </label>
                                                <input type="date" class="form-control" name="issue_date"
                                                       id="issue_date" required>
                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset class="mt-5">
                                        <legend>Gastos asociados</legend>

                                        <div class="row align-items-baseline">
                                            <!--PRIMA-->
                                            <div class="col-lg-2 mb-3">
                                                <label for="premium" class="form-label">Prima (%)</label>
                                                <input type="text" class="form-control" name="premium" id="premium">
                                            </div>
                                            <!--ESTRUCTURACIÓN-->
                                            <div class="col-lg-2 mb-3">
                                                <label for="structuring_fee" class="form-label">Estructuración
                                                    (%)</label>
                                                <input type="text" class="form-control" name="structuring_fee"
                                                       id="structuring_fee">
                                            </div>
                                            <!--COLOCACIÓN-->
                                            <div class="col-lg-2 mb-3">
                                                <label for="placement_fee" class="form-label">Colocación (%)</label>
                                                <input type="text" class="form-control" name="placement_fee"
                                                       id="placement_fee">
                                            </div>
                                            <!--FLOTACIÓN-->
                                            <div class="col-lg-2 mb-3">
                                                <label for="floatation_fee" class="form-label">Flotación (%)</label>
                                                <input type="text" class="form-control" name="floatation_fee"
                                                       id="floatation_fee">
                                            </div>
                                            <!--CAVALI-->
                                            <div class="col-lg-2 mb-3">
                                                <label for="cavali_fee" class="form-label">CAVALI (%)</label>
                                                <input type="text" class="form-control" name="cavali_fee"
                                                       id="cavali_fee">
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-gradient-light">
                                        Limpiar
                                    </button>
                                    <button type="submit" class="btn btn-gradient-blue">
                                        Guardar
                                    </button>
                                </div>
                            </form>
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
<script type="text/javascript">
    $(document).ready(function () {
        show_hide_capitalization()

        $('#interest_rate_type').on('change', show_hide_capitalization)
    })

    function show_hide_capitalization() {
        const val = $('#interest_rate_type').val();

        if (val === 'NOMINAL') {
            $('#capitalization-period-container').show();
            $('#capitalization_period').attr('required', true);
        } else {
            $('#capitalization-period-container').hide();
            $('#capitalization_period').attr('required', false).val('');
        }
    }
</script>
</body>
</html>
