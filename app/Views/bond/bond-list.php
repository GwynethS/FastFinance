<?php
$session = \Config\Services::session();
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

                <div class="d-flex justify-content-between align-items-center">
                    <?= $page_title ?>
                    <?php if (in_array($role, ['admin', 'issuer'])) { ?>
                        <button class="btn btn-submit mb-2" data-bs-toggle="modal" data-bs-target="#createBondModal">
                            <i class="bx bx-plus"></i> Agregar bono
                        </button>
                    <?php } ?>
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
                                            <th scope="col" class="text-center">Valor nominal</th>
                                            <th scope="col" class="text-center">Valor comercial</th>
                                            <th scope="col" class="text-center">Tasa de interés</th>
                                            <th scope="col" class="text-center">N° de años</th>
                                            <th scope="col" class="text-center">Frecuencia de pago</th>
                                            <th scope="col" class="text-center">Estado</th>
                                            <th scope="col" class="text-center">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (isset($bonds)) {
                                            $i = 0;
                                            foreach ($bonds as $bond) {
                                                $i++;
                                                $coinSymbol = isset($bond) ? ($bond['coin'] == 'SOLES' ? 'S/. ' : '$') : '';
                                                $interestRateText = strtoupper($bond['interest_rate_type']) . ' ' . $bond['interest_rate'] . '%';
                                                if (strtoupper($bond['interest_rate_type']) === 'NOMINAL') {
                                                    switch ($bond['capitalization_period']) {
                                                        case 1:
                                                            $interestRateText .= ' c.d';
                                                            break;
                                                        case 15:
                                                            $interestRateText .= ' c.q';
                                                            break;
                                                        case 30:
                                                            $interestRateText .= ' c.m';
                                                            break;
                                                        case 60:
                                                            $interestRateText .= ' c.b';
                                                            break;
                                                        case 90:
                                                            $interestRateText .= ' c.t';
                                                            break;
                                                        case 120:
                                                            $interestRateText .= ' c.c';
                                                            break;
                                                        case 180:
                                                            $interestRateText .= ' c.s';
                                                            break;
                                                        case 360:
                                                            $interestRateText .= ' c.a';
                                                            break;
                                                    }
                                                }
                                                $paymentFrequencyText = '';
                                                switch ($bond['payment_frequency']) {
                                                    case 1:
                                                        $paymentFrequencyText = 'DIARIA';
                                                        break;
                                                    case 15:
                                                        $paymentFrequencyText = 'QUINCENAL';;
                                                        break;
                                                    case 30:
                                                        $paymentFrequencyText = 'MENSUAL';
                                                        break;
                                                    case 60:
                                                        $paymentFrequencyText = 'BIMESTRAL';
                                                        break;
                                                    case 90:
                                                        $paymentFrequencyText = 'TRIMESTRAL';
                                                        break;
                                                    case 120:
                                                        $paymentFrequencyText = 'CUATRIMESTRAL';
                                                        break;
                                                    case 180:
                                                        $paymentFrequencyText = 'SEMESTRAL';
                                                        break;
                                                    case 360:
                                                        $paymentFrequencyText = 'ANUAL';
                                                        break;
                                                }
                                                ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $i; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['code']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $bond['name']; ?></td>
                                                    <td style="vertical-align: middle;" class="text-center">
                                                        <?= $coinSymbol . number_format($bond['face_value'], 2); ?>
                                                    </td>
                                                    <td style="vertical-align: middle;" class="text-center">
                                                        <?= $coinSymbol . number_format($bond['market_value'], 2); ?>
                                                    </td>
                                                    <td style="vertical-align: middle;" class="text-center">
                                                        <?= $interestRateText; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;" class="text-center">
                                                        <?= $bond['term_years']; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;" class="text-center">
                                                        <?= $paymentFrequencyText; ?>
                                                    </td>
                                                    <td style="vertical-align: middle;" class="text-center">

                                                        <?php switch ($bond['state']) {
                                                            case '1':
                                                                echo '<span class="badge bg-light">CREADO</span>';
                                                                break;
                                                            case '2':
                                                                echo '<span class="badge bg-secondary">EMITIDO</span>';
                                                                if (!empty($bond['issue_date'])) {
                                                                    echo '<br><small>' . date('d/m/Y', strtotime($bond['issue_date'])) . '</small>';
                                                                }
                                                                break;
                                                            case '3':
                                                                echo '<span class="badge bg-primary">COMPRADO</span>';
                                                                break;
                                                        } ?>

                                                    </td>
                                                    <td style="vertical-align: middle;"
                                                        class="d-flex justify-content-center gap-3 align-items-center">
                                                        <?php if ($bond['state'] == 1 and in_array($role, ['admin', 'issuer'])) { ?>
                                                            <a href="javascript:void(0);"
                                                               class="btn btn-icon btn-upload-bond"
                                                               data-id="<?= $bond['id']; ?>"
                                                               style="background-color: #eafdd6;">
                                                                <i class='bx bx-upload fw-bold'
                                                                   style="font-size: 16px;"></i>
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                               class="btn btn-icon btn-edit-bond"
                                                               data-id="<?= $bond['id']; ?>"
                                                               style="background-color: #FDF2D6;">
                                                                <i class='bx bx-edit fw-bold'
                                                                   style="font-size: 16px;"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                               class="btn btn-icon btn-delete-bond"
                                                               data-id="<?= $bond['id']; ?>"
                                                               style="background-color: #FDDFCF;">
                                                                <i class='bx bx-trash-alt fw-bold'
                                                                   style="font-size: 16px;"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <?php if (($bond['state'] == 2 and in_array($role, ['admin', 'issuer'])) or $bond['state'] == 3) { ?>
                                                            <a href="javascript:void(0);"
                                                               class="btn btn-gradient-blue btn-edit-bond"
                                                               data-id="<?= $bond['id']; ?>">
                                                                <i class='bx bx-show fw-bold'
                                                                   style="font-size: 16px;"></i>
                                                            </a>
                                                            <a href="/public/cash-flow-list?code=<?= $bond['code']; ?>"
                                                               class="btn btn-gradient-light">
                                                                Flujo de caja
                                                            </a>
                                                        <?php } ?>
                                                        <?php if (($bond['state'] == 2 and in_array($role, ['admin', 'investor']))) { ?>
                                                            <a href="javascript:void(0);"
                                                               class="btn btn-gradient-blue btn-edit-bond"
                                                               data-id="<?= $bond['id']; ?>">
                                                                <i class='bx bx-show fw-bold'
                                                                   style="font-size: 16px;"></i>
                                                            </a>
                                                            <a href="/public/bond-purchase/<?= $bond['id']; ?>"
                                                               class="btn btn-gradient-light">
                                                                Comprar bono
                                                            </a>
                                                        <?php } ?>
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

                <div class="modal fade" id="editBondModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Editar bono</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>

                            <form action="/public/bond-edit" method="POST">
                                <div class="modal-body pointer-container">

                                    <input type="hidden" name="bond_id" id="edit_bond_id">

                                    <fieldset>
                                        <legend>Datos del bono</legend>

                                        <div class="row align-items-baseline">
                                            <!-- CÓDIGO -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_code" class="form-label">Código del bono</label>
                                                <input type="text" class="form-control" id="edit_code" readonly>
                                            </div>

                                            <!-- NOMBRE -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_name" class="form-label">Nombre del bono</label>
                                                <input type="text" class="form-control" name="name" id="edit_name"
                                                       required>
                                            </div>

                                            <!-- MONEDA -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_coin" class="form-label">Moneda</label>
                                                <select name="coin" id="edit_coin" class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="SOLES">SOLES</option>
                                                    <option value="DÓLARES">DÓLARES</option>
                                                </select>
                                            </div>

                                            <!-- VALOR NOMINAL -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_face_value" class="form-label">Valor nominal</label>
                                                <input type="text" class="form-control" name="face_value"
                                                       id="edit_face_value" required>
                                            </div>

                                            <!-- VALOR COMERCIAL -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_market_value" class="form-label">Valor
                                                    comercial</label>
                                                <input type="text" class="form-control" name="market_value"
                                                       id="edit_market_value" required>
                                            </div>

                                            <!-- TIPO DE TASA -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_interest_rate_type" class="form-label">Tipo de tasa de
                                                    interés</label>
                                                <select name="interest_rate_type" id="edit_interest_rate_type"
                                                        class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="EFECTIVA">EFECTIVA</option>
                                                    <option value="NOMINAL">NOMINAL</option>
                                                </select>
                                            </div>

                                            <!-- PERÍODO DE CAPITALIZACIÓN -->
                                            <div class="col-lg-3 mb-3" id="edit_capitalization_period_container">
                                                <label for="edit_capitalization_period" class="form-label">Período de
                                                    capitalización</label>
                                                <select name="capitalization_period" id="edit_capitalization_period"
                                                        class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="1">DIARIA</option>
                                                    <option value="15">QUINCENAL</option>
                                                    <option value="30">MENSUAL</option>
                                                    <option value="60">BIMESTRAL</option>
                                                    <option value="90">TRIMESTRAL</option>
                                                    <option value="120">CUATRIMESTRAL</option>
                                                    <option value="180">SEMESTRAL</option>
                                                    <option value="360">ANUAL</option>
                                                </select>
                                            </div>

                                            <!-- TASA DE INTERÉS -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_interest_rate" class="form-label">Tasa de interés
                                                    (%)</label>
                                                <input type="text" class="form-control" name="interest_rate"
                                                       id="edit_interest_rate" required>
                                            </div>

                                            <!-- COK -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_cok" class="form-label">Tasa anual de descuento (COK)
                                                    (%)</label>
                                                <input type="text" class="form-control" name="cok" id="edit_cok"
                                                       required>
                                            </div>

                                            <!-- N° DE AÑOS -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_term_years" class="form-label">N° de años</label>
                                                <input type="number" class="form-control" name="term_years"
                                                       id="edit_term_years" required>
                                            </div>

                                            <!-- FRECUENCIA DE PAGO -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_payment_frequency" class="form-label">Frecuencia de
                                                    pago</label>
                                                <select name="payment_frequency" id="edit_payment_frequency"
                                                        class="form-select" required>
                                                    <option value="">SELECCIONE</option>
                                                    <option value="1">DIARIA</option>
                                                    <option value="15">QUINCENAL</option>
                                                    <option value="30">MENSUAL</option>
                                                    <option value="60">BIMESTRAL</option>
                                                    <option value="90">TRIMESTRAL</option>
                                                    <option value="120">CUATRIMESTRAL</option>
                                                    <option value="180">SEMESTRAL</option>
                                                    <option value="360">ANUAL</option>
                                                </select>
                                            </div>

                                            <!-- DÍAS POR AÑO -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_year_days" class="form-label">Días x año</label>
                                                <select name="year_days" id="edit_year_days" class="form-select">
                                                    <option value="360">360</option>
                                                    <option value="365">365</option>
                                                </select>
                                            </div>

                                            <!-- GRACIAS -->
                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_total_grace" class="form-label">Períodos con gracia
                                                    total</label>
                                                <input type="number" class="form-control" name="total_grace"
                                                       id="edit_total_grace" required>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_partial_grace" class="form-label">Períodos con gracia
                                                    parcial</label>
                                                <input type="number" class="form-control" name="partial_grace"
                                                       id="edit_partial_grace" required>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <label for="edit_issue_date" class="form-label">Fecha de emisión</label>
                                                <input type="date" class="form-control" name="issue_date"
                                                       id="edit_issue_date" required>
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset class="mt-5">
                                        <legend>Gastos asociados</legend>

                                        <div class="row align-items-baseline">
                                            <div class="col-lg-2 mb-3">
                                                <label for="edit_premium" class="form-label">Prima (%)</label>
                                                <input type="text" class="form-control" name="premium"
                                                       id="edit_premium">
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <label for="edit_structuring_fee" class="form-label">Estructuración
                                                    (%)</label>
                                                <input type="text" class="form-control" name="structuring_fee"
                                                       id="edit_structuring_fee">
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <label for="edit_placement_fee" class="form-label">Colocación
                                                    (%)</label>
                                                <input type="text" class="form-control" name="placement_fee"
                                                       id="edit_placement_fee">
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <label for="edit_floatation_fee" class="form-label">Flotación
                                                    (%)</label>
                                                <input type="text" class="form-control" name="floatation_fee"
                                                       id="edit_floatation_fee">
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <label for="edit_cavali_fee" class="form-label">CAVALI (%)</label>
                                                <input type="text" class="form-control" name="cavali_fee"
                                                       id="edit_cavali_fee">
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>

                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-gradient-light">Limpiar</button>
                                    <button type="submit" class="btn btn-gradient-blue btn-save-edit">Guardar</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/public/assets/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        show_hide_capitalization()

        $('#interest_rate_type').on('change', show_hide_capitalization)

        $('#edit_interest_rate_type').on('change', show_hide_edit_capitalization);

        $('.btn-upload-bond').on('click', function () {
            const bondId = $(this).data('id');

            Swal.fire({
                icon: 'warning',
                title: '¿Está seguro de que desea emitir este bono?',
                text: 'No podrá revertir esta acción',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'btn btn-gradient-blue',
                    cancelButton: 'btn btn-gradient-light'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/public/bond-issue',
                        method: 'POST',
                        data: {bond_id: bondId},
                        success: function (response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                Swal.fire({
                                    title: "Operación fallida",
                                    text: response['message'],
                                    icon: "error",
                                    confirmButtonText: (response['code'] && response['code'] === 'AUTH_ERROR') ? 'Iniciar sesión' : 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-gradient-blue',
                                    }
                                }).then(() => {
                                    if (response['code'] === 'AUTH_ERROR') {
                                        window.location.href = "/public/auth-login";
                                    }
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                title: "Se produjo un error inesperado",
                                text: (e.responseJSON && e.responseJSON.message) || "No hay detalles adicionales disponibles",
                                icon: "error",
                                confirmButtonColor: "#313131",
                            });
                        }
                    });
                }
            });
        });

        $('.btn-edit-bond').click(function () {
            const bondId = $(this).data('id');

            $.ajax({
                url: '/public/bond-get-by-id',
                type: 'GET',
                data: {id: bondId},
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        const bond = response.data;

                        $('#edit_bond_id').val(bond.id);
                        $('#edit_code').val(bond.code);
                        $('#edit_name').val(bond.name);
                        $('#edit_coin').val(bond.coin);
                        $('#edit_face_value').val(bond.face_value);
                        $('#edit_market_value').val(bond.market_value);
                        $('#edit_interest_rate_type').val(bond.interest_rate_type);
                        $('#edit_capitalization_period').val(bond.capitalization_period);
                        $('#edit_interest_rate').val(bond.interest_rate);
                        $('#edit_cok').val(bond.cok);
                        $('#edit_term_years').val(bond.term_years);
                        $('#edit_payment_frequency').val(bond.payment_frequency);
                        $('#edit_year_days').val(bond.year_days);
                        $('#edit_total_grace').val(bond.total_grace);
                        $('#edit_partial_grace').val(bond.partial_grace);
                        $('#edit_issue_date').val(bond.issue_date);

                        // Gastos
                        $('#edit_premium').val(bond.premium);
                        $('#edit_structuring_fee').val(bond.structuring_fee);
                        $('#edit_placement_fee').val(bond.placement_fee);
                        $('#edit_floatation_fee').val(bond.floatation_fee);
                        $('#edit_cavali_fee').val(bond.cavali_fee);

                        show_hide_edit_capitalization();

                        if (bond.state == 2 || bond.state == 3) {
                            $('.pointer-container').addClass('pointer-none');
                            $('#editBondModal .modal-footer').hide();
                        } else {
                            $('.pointer-container').removeClass('pointer-none');
                            $('#editBondModal .modal-footer').show();
                        }

                        $('#editBondModal').modal('show');
                    } else {
                        Swal.fire({
                            title: "Operación fallida",
                            text: response['message'],
                            icon: "error",
                            confirmButtonText: (response['code'] && response['code'] === 'AUTH_ERROR') ? 'Iniciar sesión' : 'OK',
                            customClass: {
                                confirmButton: 'btn btn-gradient-blue',
                            }
                        }).then(() => {
                            if (response['code'] === 'AUTH_ERROR') {
                                window.location.href = "/public/auth-login";
                            }
                        });
                    }
                },
                error: function (e) {
                    Swal.fire({
                        title: "Se produjo un error inesperado",
                        text: (e.responseJSON && e.responseJSON.message) || "No hay detalles adicionales disponibles",
                        icon: "error",
                        customClass: {
                            confirmButton: 'btn btn-gradient-blue',
                        }
                    });
                }
            });
        });

        $('.btn-delete-bond').on('click', function () {
            const bondId = $(this).data('id');

            Swal.fire({
                icon: 'warning',
                title: '¿Está seguro de que desea eliminar este bono?',
                text: 'No podrá revertir esta acción',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'btn btn-gradient-blue',
                    cancelButton: 'btn btn-gradient-light'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/public/bond-delete',
                        method: 'POST',
                        data: {bond_id: bondId},
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Bono eliminado correctamente',
                                    timer: 1500,
                                    customClass: {
                                        confirmButton: 'btn btn-gradient-blue',
                                    }
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Operación fallida",
                                    text: response['message'],
                                    icon: "error",
                                    confirmButtonText: (response['code'] && response['code'] === 'AUTH_ERROR') ? 'Iniciar sesión' : 'OK',
                                    customClass: {
                                        confirmButton: 'btn btn-gradient-blue',
                                    }
                                }).then(() => {
                                    if (response['code'] === 'AUTH_ERROR') {
                                        window.location.href = "/public/auth-login";
                                    }
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                title: "Se produjo un error inesperado",
                                text: (e.responseJSON && e.responseJSON.message) || "No hay detalles adicionales disponibles",
                                icon: "error",
                                confirmButtonColor: "#313131",
                            });
                        }
                    });
                }
            });
        });
    });

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

    function show_hide_edit_capitalization() {
        const val = $('#edit_interest_rate_type').val();

        if (val === 'NOMINAL') {
            $('#edit_capitalization_period_container').show();
            $('#edit_capitalization_period').attr('required', true);
        } else {
            $('#edit_capitalization_period_container').hide();
            $('#edit_capitalization_period').attr('required', false).val('');
        }
    }
</script>
</body>
</html>
