<?php $session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

    <style>
        .description-trunk {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .card:hover{
            cursor: pointer;
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

                    <div class="col-lg-3">
                        <div class="card"
                             style="background: #BFE3FF; background: linear-gradient(0deg, rgba(191, 227, 255, 1) 0%, rgba(62, 145, 248, 1) 100%);"
                             onclick="window.location.href='/public/bond-list'">
                            <div class="card-body text-light">
                                <h5 class="text-light">Lista de bonos</h5>
                                <div class="text-end">
                                    <i class='bx bxs-coupon' style="font-size: 5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card"
                             style="background: #D9D7F3; background: linear-gradient(0deg, rgba(217, 215, 243, 1) 0%, rgba(130, 137, 235, 1) 100%);"
                             onclick="window.location.href='/public/cash-flow-list'">
                            <div class="card-body text-light">
                                <h5 class="text-light">Flujo de caja</h5>
                                <div class="text-end">
                                    <i class='bx bxs-dollar-circle' style="font-size: 5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

<script type="text/javascript">

</script>
</body>

</html>