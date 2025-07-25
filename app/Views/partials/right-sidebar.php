<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
            <h5 class="m-0 me-2"><?= lang('Files.Settings') ?></h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0"><?= lang('Files.Choose Layouts') ?></h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="/public/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                <label class="form-check-label" for="light-mode-switch"><?= lang('Files.Light Mode') ?></label>
            </div>
    
            <div class="mb-2">
                <img src="/public/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="/public/assets/css/bootstrap-dark.min.css" data-appStyle="/public/assets/css/app-dark.min.css">
                <label class="form-check-label" for="dark-mode-switch"><?= lang('Files.Dark Mode') ?></label>
            </div>
    
            <div class="mb-2">
                <img src="/public/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="/public/assets/css/app-rtl.min.css">
                <label class="form-check-label" for="rtl-mode-switch"><?= lang('Files.RTL Mode') ?></label>
            </div>

            <div class="mb-2">
                <img src="/public/assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                <label class="form-check-label" for="dark-rtl-mode-switch"><?= lang('Files.Dark RTL Mode') ?></label>
            </div>

        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>