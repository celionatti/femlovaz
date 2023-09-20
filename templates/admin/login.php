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

<!-- Add User Modal -->
<div class="modal fade" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">#</span>
                        <input type="text" class="form-control" name="slug" value="<?= Token::generateOTP(6) ?>" aria-label="Slug" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="surname" placeholder="Surname" aria-label="Surname" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-lines-fill"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at"></i></span>
                        <input type="text" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-telephone"></i></span>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" aria-label="Phone" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-shield-lock"></i></span>
                        <input type="text" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-danger w-100" id="insert" value="Add User">
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> -->
        </div>
    </div>
</div>
<!-- Modal -->

<?php $this->end() ?>

<?php $this->start("script") ?>
<script>
    $(document).ready(function() {

        // Create New User.
        $("#login").click(function(e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/login",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=login",
                    success: function(response) {
                        Swal.fire({
                            title: 'User added successfully!',
                            icon: 'success'
                        })
                        $("#addUser").modal('hide');
                        $("#form-data")[0].reset();
                    }
                });
            }
        });
    });
</script>
<?php $this->end() ?>