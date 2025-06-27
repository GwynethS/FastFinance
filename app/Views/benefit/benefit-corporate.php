<?php
$session = \Config\Services::session();
$role = $session->get('role');
?>
<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <style>
        .card:hover{
            box-shadow: rgba(0, 0, 0, 0.25) 4px 4px 8px;
            transform: scale(1.05);
            transition: all 1s ease;
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
                    <?php foreach ($corporate_benefits as $corporate_benefit) { ?>
                        <div class="col-lg-4">
                            <div class="card overflow-hidden bg-transparent" style="border-radius: 20px; height: 400px;"
                                 data-bs-toggle="modal" data-bs-target="#corporateModal<?php echo $corporate_benefit['id']?>">
                                <img src="<?php echo $corporate_benefit['image'] ?>" class="w-100 h-100"
                                     style="object-fit: cover;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php foreach ($corporate_benefits as $corporate_benefit) { ?>
            <div class="modal fade" id="corporateModal<?php echo $corporate_benefit['id']?>" tabindex="-1"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $corporate_benefit['title']?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="<?php echo $corporate_benefit['image'] ?>" class="w-100 h-100 mb-4"
                                 style="object-fit: cover;">
                            <?php echo $corporate_benefit['detail'] ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


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
