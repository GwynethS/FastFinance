<?php $session = \Config\Services::session(); ?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/public" class="logo logo-dark fw-bold fs-1">
                    <span>Fast</span><span class="text-dark">Finance</span>
                </a>

                <a href="/public" class="logo logo-light">
                    <span>Fast</span><span class="text-dark">Finance</span>
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 text-dark">
            <i class='bx bxs-user' style="font-size: 2rem;"></i>
            <div>
                <p class="m-0 fw-bold"><?php echo $session->get('username'); ?></p>
                <p class="m-0"><?php echo $session->get('email'); ?></p>
            </div>
        </div>
    </div>
</header>