<!doctype html>
<html lang="en">

<head>

    <!--    --><?php /*= $title_meta */ ?>

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
                <div class="card-body" style="padding: 3rem 5rem;">
                    <h3 class="text-center" style="margin-bottom: 2.5rem;">
                        Registro
                    </h3>
                    <form method="post" action="/public/auth-register" class="needs-validation" novalidate>

                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="username" id="username"
                                   placeholder="Ingresar usuario" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Ingresar correo" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role_id" class="form-label">Rol</label>

                            <select name="role_id" id="role_id" class="form-select" required>
                                <option value="">SELECCIONE</option>
                                <option value="2">
                                    EMISOR
                                </option>
                                <option value="3">
                                    INVERSIONISTA
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control" placeholder="Ingresar contraseña"
                                   name="password" aria-label="Password" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="confirm-password">Confirmar contraseña</label>
                            <input id="confirm-password" type="password" class="form-control"
                                   placeholder="Ingresar contraseña nuevamente"
                                   required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio
                            </div>
                        </div>

                        <div class="mb-4 d-grid">
                            <button class="btn btn-gradient-main" type="submit">
                                Registrarse
                            </button>
                        </div>

                        <?php if (isset($error) && $error != '') { ?>
                            <p class="text-danger text-center">
                                <?= $error; ?>
                            </p>
                        <?php } ?>

                        <div>
                            <p class="text-center m-0">
                                ¿Tienes una cuenta? <a href="/public/auth-login" class="fw-medium text-primary">
                                    Inicia sesión </a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('partials/vendor-scripts') ?>

<!-- validation init -->
<script src="assets/js/pages/validation.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        function matchPassword() {
            const password = $('#password').val();
            const confirmPassword = $('#confirm-password').val();
            const confirmInput = $('#confirm-password');
            const feedback = confirmInput.siblings('.invalid-feedback');

            if (password !== confirmPassword) {
                confirmInput[0].setCustomValidity('Las contraseñas no coinciden');
                feedback.text('Las contraseñas no coinciden');
            } else {
                confirmInput[0].setCustomValidity('');
                feedback.text('Este campo es obligatorio');
            }
        }

        $('#password, #confirm-password').on('input', matchPassword);
    });

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
