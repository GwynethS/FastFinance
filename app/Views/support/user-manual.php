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
                    <div class="col-lg-12">
                        <p>Consulta el manual completo para aprender a usar la aplicación de manera sencilla.</p>

                        <div class="d-flex justify-content-center">
                            <iframe src="/public/assets/donwloads/Manual%20de%20usuario.pdf" width="70%" height="600px"
                                    style="border: 1px solid #ccc; border-radius: 8px;">
                                Este navegador no soporta iframes. Puedes <a href="/public/manual/manual-usuario.pdf"
                                                                             target="_blank">descargar el manual
                                    aquí</a>.
                            </iframe>
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
</script>
</body>
</html>
