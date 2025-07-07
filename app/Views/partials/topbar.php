<?php $session = \Config\Services::session(); ?>
<header id="page-topbar">
    <div class="navbar-header" style="padding-right: 3rem;">
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
                <p class="m-0 fw-bold"><?= $session->get('username'); ?>
                    <span class="text-primary"><?= '(' . $session->get('role')['name'] . ')'; ?></span>
                </p>
                <p class="m-0"><?= $session->get('email'); ?></p>
            </div>
        </div>
    </div>
</header>