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
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion" id="accordionExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                1. ¿Qué es un bono en este sistema?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Un bono es un instrumento financiero emitido por un usuario (emisor) que
                                                contiene información como el valor nominal, valor comercial, tasa de
                                                interés, frecuencia de pago y otros datos necesarios para calcular los
                                                flujos de caja y la TCEA.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                2. ¿Quiénes pueden crear un bono?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Solo los usuarios con rol Emisor pueden crear nuevos bonos. Los usuarios
                                                con rol Inversor no tienen permisos para crear o modificar bonos.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                3. ¿Qué significan los diferentes estados del bono?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <strong>CREADO:</strong> El bono ha sido creado pero aún no ha sido
                                                emitido ni comprado.<br>
                                                <strong>EMITIDO:</strong> El bono ha sido formalmente emitido y se
                                                registra su fecha de emisión.<br>
                                                <strong>COMPRADO:</strong> El bono ha sido adquirido por un
                                                inversionista y no puede ser modificado.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                    aria-expanded="false" aria-controls="collapseFour">
                                                4. ¿Qué sucede si intento editar un bono ya emitido o comprado?
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Los bonos en estado <strong>EMITIDO</strong> o <strong>COMPRADO</strong>
                                                no pueden ser editados. Al abrir la ventana de edición,
                                                todos los campos estarán deshabilitados para mantener la integridad de
                                                los datos.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="false" aria-controls="collapseFive">
                                                5. ¿Cómo puedo emitir un bono?
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                En la lista de bonos, haz clic en el botón de emitir. El sistema
                                                registrará la fecha de emisión y cambiará
                                                el estado del bono a <strong>EMITIDO</strong> para que pueda ser
                                                adquirido por un
                                                inversionista.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                    aria-expanded="false" aria-controls="collapseSix">
                                                6. ¿Qué es la Tasa de Interés y cómo funciona?
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                La tasa de interés puede ser <strong>EFECTIVA</strong> o
                                                <strong>NOMINAL</strong>.
                                                Si seleccionas NOMINAL, deberás definir un período de capitalización, el
                                                cual se mostrará automáticamente.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                    aria-expanded="false" aria-controls="collapseSeven">
                                                7. ¿Puedo eliminar cualquier bono?
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Solo los bonos en estado <strong>CREADO</strong> pueden ser eliminados.
                                                Los bonos emitidos o comprados no
                                                se pueden eliminar para preservar el historial.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                    aria-expanded="false" aria-controls="collapseEight">
                                                8. ¿Qué es la TCEA y cómo se calcula?
                                            </button>
                                        </h2>
                                        <div id="collapseEight" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                La Tasa de Costo Efectivo Anual (TCEA) refleja el costo real
                                                considerando todos los gastos asociados.
                                                El sistema la calcula automáticamente usando los flujos de caja
                                                generados.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                                    aria-expanded="false" aria-controls="collapseNine">
                                                9. ¿Cómo puedo buscar un bono?
                                            </button>
                                        </h2>
                                        <div id="collapseNine" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Puedes buscar un bono por su código o nombre usando los campos de
                                                búsqueda en la sección de flujos de caja.
                                                El sistema usa autocompletado para garantizar que selecciones un bono
                                                existente.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                                    aria-expanded="false" aria-controls="collapseTen">
                                                10. ¿Qué gastos asociados se pueden registrar para un bono?
                                            </button>
                                        </h2>
                                        <div id="collapseTen" class="accordion-collapse collapse"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                Puedes registrar: <strong>Prima</strong>,
                                                <strong>Estructuración</strong>, <strong>Colocación</strong>,
                                                <strong>Flotación</strong> y <strong>CAVALI</strong>. Estos se toman en
                                                cuenta en los cálculos financieros.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <img src="/public/assets/images/faq-img.png" alt="faq" style="width: 100%; height: auto;">
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
</script>
</body>
</html>
