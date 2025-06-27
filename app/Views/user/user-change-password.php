<?php
$session = \Config\Services::session();
$role = $session->get('role');
?>
<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
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
                        <form method="post"
                              action="/public/user-change-password">
                            <div class="row mb-4">
                                <label for="password" class="col-form-label col-lg-2">Nueva contraseña</label>
                                <div class="col-lg-10">
                                    <input id="password" name="new_password" type="password" class="form-control"
                                           placeholder="Ingresa la contraseña">
                                    <?php
                                    if (isset($dataform) and $dataform['new_password'] == '') {
                                        echo "<span class='small text-danger d-inline-block'>Ingrese una contraseña</span>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i>
                                        Actualizar contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
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

<script src="/public/assets/js/app.js"></script>
</body>
</html>
