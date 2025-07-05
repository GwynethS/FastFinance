<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

    <style>
        .bg-container {
            height: 100vh;
            width: 100%;
            background: #E6EFFF;
            background: linear-gradient(180deg, rgba(230, 239, 255, 1) 0%, rgba(157, 190, 255, 1) 100%);
        }
    </style>

</head>

<body>
<div class="bg-container">
    <div class="row justify-content-center align-items-center h-100 m-0">
        <div class="col-lg-4 col-md-8">
            <div class="card m-0">
                <div class="card-body" style="padding: 5rem 5rem;">
                    <h3 class="text-center" style="margin-bottom: 4rem;">
                        Iniciar sesión
                    </h3>
                    <form method="POST" action="/public/auth-login" class="needs-validation" novalidate>

                        <div class="mb-4">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="username" id="username"
                                   placeholder="Ingresar usuario" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Ingresar contraseña"
                                   name="password" aria-label="Password" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-4 d-grid">
                            <button class="btn btn-gradient-main" type="submit">
                                Ingresar
                            </button>
                        </div>

                        <?php if (isset($error) && $error != '') { ?>
                            <p class="text-danger text-center">
                                <?= $error; ?>
                            </p>
                        <?php } ?>

                        <div>
                            <p class="text-center m-0">
                                ¿No tienes una cuenta? <a href="/public/auth-register" class="fw-medium text-primary">
                                    Regístrate </a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<?= $this->include('partials/vendor-scripts') ?>

<!-- App js -->
<script src="assets/js/app.js"></script>

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