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
                                <div class="">
                                    <a href="user-create" class="btn btn-primary mb-2"><i class="bx bx-plus"></i> Agregar nuevo usuario</a>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped datatablesearch">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Apellidos y nombres</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Teléfono</th>
                                                    <th scope="col">Rol</th>
                                                    <th scope="col">Área</th>
                                                    <th scope="col">Cargo</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=0; foreach($users as $user){ $i++; ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?php echo isset($user['lastname']) ? $user['lastname'] : '-'; ?>, <?php echo isset($user['name']) ? $user['name'] : '-'; ?>
                                                    </td>
                                                    <td><?php echo $user['email']; ?></td>
                                                    <td><?php echo isset($user['phone']) ? $user['phone'] : '-'; ?></td>
                                                    <td><?php echo isset($user['role']['name']) ? $user['role']['name'] : '-'; ?></td>
                                                    <td><?php echo isset($user['department']) ? $user['department'] : '-'; ?></td>
                                                    <td><?php echo isset($user['job']) ? $user['job'] : '-'; ?></td>
                                                    <td>
                                                        <?php if($user['state']==1){ ?>
                                                        <span class="badge bg-success"><i class="bx bx-check"></i> Activo</span>
                                                        <?php } ?>
                                                        <?php if($user['state']==0){ ?>
                                                            <span class="badge bg-danger"><i class="bx bx-error"></i> Inactivo</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="user-edit/<?php echo $user['id']; ?>"><i class="bx bx-edit"></i> Ver/Editar</a>
                                                                <?php if($user['state']==1){ ?>
                                                                    <a class="dropdown-item" onclick="return confirm('¿Desea dar de baja al usuario <?php echo isset($user['name']) ? $user['name'].' '.$user['lastname'] : $user['user']; ?>?');" href="user-delete/<?php echo $user['id']; ?>"><i class="bx bx-error"></i> Dar de baja</a>
                                                                <?php } ?>
                                                                <?php if($user['state']==0){ ?>
                                                                    <a class="dropdown-item" href="user-enable/<?php echo $user['id']; ?>"><i class="bx bx-check"></i> Habilitar</a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row d-none">
                            <div class="col-12">
                                <div class="text-center my-3">
                                    <a href="javascript:void(0);" class="text-success"><i class="bx bx-loader bx-spin font-size-18 align-middle me-2"></i> Load more </a>
                                </div>
                            </div> <!-- end col-->
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
