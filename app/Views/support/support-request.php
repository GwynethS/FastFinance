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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">¿Aún necesitas ayuda?<br><br>Contáctanos...</h5>
                                <form action="/public/support-request" method="POST" id="supportForm" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Asunto</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                        <div class="invalid-feedback">
                                            Este campo es obligatorio
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="message" class="form-label">Mensaje</label>
                                        <textarea class="form-control" id="message" name="message" rows="6"
                                                  style="resize: none;"
                                                  required
                                                  placeholder="Describe tu problema o consulta..."></textarea>
                                        <div class="invalid-feedback">
                                            Este campo es obligatorio
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-gradient-blue">Enviar solicitud</button>
                                    </div>
                                </form>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="/public/assets/js/app.js"></script>
<script type="text/javascript">
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
</body>
</html>
