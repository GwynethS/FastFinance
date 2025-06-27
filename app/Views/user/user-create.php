<?php $session = \Config\Services::session(); ?>
<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <link href="/public/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- dropzone css -->
    <link href="/public/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css"/>
    <link href="/public/assets/libs/select2/select2.min.css" rel="stylesheet">
    <?= $this->include('partials/head-css') ?>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Crear nuevo usuario</h4>
                                <form method="post"
                                      action="user-create<?php if (isset($_GET['profile'])) echo '?profile' ?>">
                                    <?php if (isset($error) && $error != '') { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $error; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="row mb-4">
                                        <label for="name" class="col-form-label col-lg-2">Nombres</label>
                                        <div class="col-lg-10">
                                            <input value="<?php if (isset($dataform['name'])) echo $dataform['name'] ?>"
                                                   id="name" name="name" type="text" class="form-control"
                                                   placeholder="Ingresa los nombres">
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['name'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese nombres de la persona</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="lastname" class="col-form-label col-lg-2">Apellidos</label>
                                        <div class="col-lg-10">
                                            <input value="<?php if (isset($dataform['lastname'])) echo $dataform['lastname'] ?>"
                                                   id="lastname" name="lastname" type="text" class="form-control"
                                                   placeholder="Ingresa los apellidos">
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['lastname'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese apellidos de la persona</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="document" class="col-form-label col-lg-2">Documento</label>
                                        <div class="col-lg-10">
                                            <input value="<?php if (isset($dataform['document'])) echo $dataform['document'] ?>"
                                                   id="document" name="document" type="text" class="form-control"
                                                   placeholder="Ingresa el documento de identidad">
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['birthday'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese el documento de identidad</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="birthday" class="col-form-label col-lg-2">Fecha de
                                            nacimiento</label>
                                        <div class="col-lg-10">
                                            <input value="<?php if (isset($dataform['birthday'])) echo $dataform['birthday'] ?>"
                                                   id="birthday" name="birthday" type="date"
                                                   max="<?php echo date('Y-m-d') ?>" class="form-control"
                                                   placeholder="Ingresa el documento de identidad">
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['birthday'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese la fecha de nacimiento</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="phone" class="col-form-label col-lg-2">Celular</label>
                                        <div class="col-lg-10">
                                            <input value="<?php if (isset($dataform['phone'])) echo $dataform['phone'] ?>"
                                                   id="phone" name="phone" type="text" class="form-control"
                                                   placeholder="Ingresa el teléfono">
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['phone'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese número de celular</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="email" class="col-form-label col-lg-2">Correo electrónico</label>
                                        <div class="col-lg-10">
                                            <input value="<?php if (isset($dataform['email'])) echo $dataform['email'] ?>"
                                                   id="email" name="email" type="text" class="form-control"
                                                   placeholder="Ingresa el correo electrónico">
                                            <?php
                                            if (isset($error) && ($error == 'El correo electrónico es incorrecto.')) {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese un correo eletrónico válido</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="role" class="col-form-label col-lg-2">Rol de usuario</label>
                                        <div class="col-lg-10">
                                            <select name="role" class="form-control select2">
                                                <option value="">Seleccione</option>
                                                <?php foreach ($roles as $role) { ?>
                                                    <option <?php if (isset($dataform['role_id']) and $dataform['role_id'] == $role['id']) echo 'selected'; ?>
                                                            value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            if (isset($error) && $error != '' && !is_numeric($dataform['role_id'])) {
                                                echo "<span class='small text-danger d-inline-block'>Seleccione un rol de usuario</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="password" class="col-form-label col-lg-2">Contraseña de
                                            acceso</label>
                                        <div class="col-lg-10">
                                            <input id="password" name="password" type="password" class="form-control"
                                                   placeholder="Ingresa la contraseña">
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['password'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Ingrese una contraseña</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="company" class="col-form-label col-lg-2">Empresa</label>
                                        <div class="col-lg-10">
                                            <select name="company" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option <?php if (isset($dataform['company']) and $dataform['company'] == 'BUSINESS MASTER LOZAMORA') echo 'selected'; ?>
                                                        value="BUSINESS MASTER LOZAMORA">BUSINESS MASTER LOZAMORA
                                                </option>
                                                <option <?php if (isset($dataform['company']) and $dataform['company'] == 'EXPERT LOZAMORA') echo 'selected'; ?>
                                                        value="EXPERT LOZAMORA">EXPERT LOZAMORA
                                                </option>
                                                <option <?php if (isset($dataform['company']) and $dataform['company'] == 'BUSINESS LM GROUP') echo 'selected'; ?>
                                                        value="BUSINESS LM GROUP">BUSINESS LM GROUP
                                                </option>
                                            </select>
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['company'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Seleccione una empresa</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="department" class="col-form-label col-lg-2">Área</label>
                                        <div class="col-lg-10">
                                            <select name="department" class="form-control">
                                                <option value="">Seleccione</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='ADMINISTRACION') echo 'selected'; ?> value="ADMINISTRACION">ADMINISTRACION</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='CONTABILIDAD') echo 'selected'; ?> value="CONTABILIDAD">CONTABILIDAD</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='FINANZAS') echo 'selected'; ?> value="FINANZAS">FINANZAS</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='GERENCIA') echo 'selected'; ?> value="GERENCIA">GERENCIA</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='MARKETING') echo 'selected'; ?> value="MARKETING">MARKETING</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='OPERACIONES') echo 'selected'; ?> value="OPERACIONES">OPERACIONES</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='PERSONAS Y CULTURA') echo 'selected'; ?> value="PERSONAS Y CULTURA">PERSONAS Y CULTURA</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='SISTEMAS') echo 'selected'; ?> value="SISTEMAS">SISTEMAS</option>
                                                <option <?php if(isset($dataform['department']) and $dataform['department']=='VENTAS') echo 'selected'; ?> value="VENTAS">VENTAS</option>
                                            </select>
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['department'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Seleccione un área</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="job" class="col-form-label col-lg-2">Cargo</label>
                                        <div class="col-lg-10">
                                            <select name="job" class="form-control select2">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $jobs = [
                                                    "COORDINADORA DE GESTIÓN COMERCIAL",
                                                    "ASISTENTE DE BACK OFFICE",
                                                    "SUPERVISOR CORPORATIVO SEMI SENIOR",
                                                    "SUPERVISOR DE VENTAS",
                                                    "CONSULTOR SENIOR HUNTER",
                                                    "ASISTENTE DE GERENCIA",
                                                    "CONSULTOR ELITE HUNTER",
                                                    "SUPERVISOR CORPORATIVO",
                                                    "CONSULTOR HUNTER",
                                                    "ASESOR DE VENTAS",
                                                    "ASISTENTE DE OPERACIONES",
                                                    "PERSONAL DE LIMPIEZA",
                                                    "ANALISTA DE BACK OFFICE",
                                                    "JEFE DE VENTAS",
                                                    "GESTOR DE PROYECTOS",
                                                    "JEFE DE OPERACIONES",
                                                    "ANALISTA DE PLANEAMIENTO COMERCIAL",
                                                    "AUXILIAR DE FINANZAS",
                                                    "SUPERVISOR DE ADMINISTRACIÓN Y CONTABILIDAD",
                                                    "JEFA DE PERSONAS Y CULTURA",
                                                    "MOTORIZADO",
                                                    "ASISTENTE DE PERSONAS Y CULTURA",
                                                    "CONTADORA GENERAL",
                                                    "ANALISTA DE CLIMA Y CULTURA",
                                                    "ANALISTA DE SISTEMAS",
                                                    "ASISTENTE DE NÓMINAS Y COMPENSACIONES",
                                                    "SUB DIRECTORA COMERCIAL",
                                                    "ANALISTA CONTABLE",
                                                    "ASISTENTE DE ATRACCIÓN DE TALENTO",
                                                    "EJECUTIVO SENIOR DE VENTAS",
                                                    "EJECUTIVO DE VENTAS",
                                                    "ASISTENTE DE POST VENTA",
                                                    "ASISTENTE DE SEGURIDAD Y SOPORTE TECNOLÓGICO",
                                                    "DESAROLLADORA FULLSTACK JUNIOR",
                                                    "PRACTICANTE DE MARKETING",
                                                    "PRACTICANTE DE CONTABILIDAD",
                                                    "JEFE DE TECNOLOGÍA",
                                                    "GERENTE DE VENTAS",
                                                    "PRACTICANTE DE DESARROLLO WEB",
                                                    "ANALISTA DE ATRACCIÓN DE TALENTO",
                                                    "CAPACITADOR COMERCIAL",
                                                    "PRACTICANTE COMERCIAL",
                                                    "PRACTICANTE DE FINANZAS",
                                                    "PRACTICANTE DE RPA",
                                                    "ANALISTA DE CAPACITACION COMERCIAL",
                                                    "PRACTICANTE DE SOPORTE TÉCNICO",
                                                    "CONSULTOR DE POST VENTA",
                                                    "ANALISTA DE BIENESTAR , CLIMA Y CULTURA",
                                                    "JEFE DE MARKETING"
                                                ];

                                                foreach ($jobs as $job) {
                                                    $selected = (isset($dataform['job']) && $dataform['job'] == $job) ? 'selected' : '';
                                                    echo "<option $selected value=\"$job\">$job</option>\n";
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['job'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Seleccione un cargo</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="user_boss_id" class="col-form-label col-lg-2">Jefatura</label>
                                        <div class="col-lg-10">
                                            <select name="user_boss_id" class="form-control select2">
                                                <option value="">Seleccione</option>
                                                <?php foreach ($bosses as $boss) { ?>
                                                    <option <?php if (isset($dataform['user_boss_id']) and $dataform['user_boss_id'] == $boss['id']) echo 'selected'; ?>
                                                            value=<?php echo $boss['id'] ?>><?php echo $boss['name'] ?> <?php echo $boss['lastname'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            if (isset($error) && $error != '' && $dataform['user_boss_id'] == '') {
                                                echo "<span class='small text-danger d-inline-block'>Seleccione una jefatura</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i>
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<!-- bootstrap datepicker -->
<script src="/public/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- dropzone plugin -->
<script src="/public/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/public/assets/libs/select2/select2.min.js"></script>
<script src="/public/assets/js/app.js"></script>
<script type="text/javascript">
    $('.select2').select2();
</script>

</body>
</html>
