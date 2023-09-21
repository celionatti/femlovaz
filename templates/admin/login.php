<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="text-center">
        <div>
            <img src="<?= get_image("assets/img/logo.jpeg") ?>" alt="" class="rounded-pill" style="width:8rem;">
        </div>
        <h2 class="text-primary fw-bold">Login to access the admin dashboard.</h2>
        <h5>Only authorized users can login into the admin page.</h5>
    </div>
    <button type="button" class="btn btn-dark w-100 m-1 float-end" data-bs-toggle="modal" data-bs-target="#login"><i class="bi bi-box-arrow-in-right"></i> Login</button>
</div>

<!-- Login Modal -->
<div class="modal fade" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Login Access - Dashboard</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at"></i></span>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-shield-lock"></i></span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="login-btn" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?php $this->end() ?>

<?php $this->start("script") ?>
<script>
    $(document).ready(function() {

        // Create New User.
        $("#login-btn").click(function(e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/login",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=login",
                    success: function(response) {
                        console.log(response)
                        // Swal.fire({
                        //     title: 'Login Successfully!',
                        //     icon: 'success'
                        // })
                        // $("#login").modal('hide');
                        // $("#form-data")[0].reset();
                    }
                });
            }
        });
    });
</script>
<?php $this->end() ?>