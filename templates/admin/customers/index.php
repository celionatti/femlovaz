<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <h4 class="mt-2 text-primary">All Customers</h4>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary m-1 float-end" data-bs-toggle="modal" data-bs-target="#addCustomer"><i class="bi bi-person-add"></i> Add New Customer</button>

        <a href="<?= Config::get("domain") ?>admin/customers?export=excel" class="btn btn-success m-1 float-end"><i class="bi bi-table"></i> Export to Excel</a>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" id="showusers">
            <h3 class="text-center text-primary" style="margin-top: 150px;">Loading...</h3>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUser">
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUser">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="slug" id="slug">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping">#</span>
                        <input type="text" class="form-control" name="slug" id="slug" aria-label="Slug" aria-describedby="addon-wrapping" disabled>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="surname" id="surname" aria-label="Surname" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-lines-fill"></i></span>
                        <input type="text" class="form-control" name="name" id="name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at"></i></span>
                        <input type="text" class="form-control" name="email" id="email" aria-label="Email" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-telephone"></i></span>
                        <input type="text" class="form-control" name="phone" id="phone" aria-label="Phone" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-warning w-100" name="update" id="update" value="Update User">
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

        showAllUsers();

        // Show All users.
        function showAllUsers() {
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/users",
                type: "POST",
                data: {
                    action: "view-users"
                },
                success: function(response) {
                    // console.log(response)
                    $("#showusers").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        // Create New User.
        $("#insert").click(function(e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/users/create",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function(response) {
                        Swal.fire({
                            title: 'User added successfully!',
                            icon: 'success'
                        })
                        $("#addUser").modal('hide');
                        $("#form-data")[0].reset();
                        showAllUsers();
                    }
                });
            }
        });

        // Edit User.
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/users/edit",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = response;
                    $("#id").val(data.id);
                    $("#slug").val(data.slug);
                    $("#surname").val(data.surname);
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                }
            });
        });

        // Update User.
        $("#update").click(function(e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/users/edit",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function(response) {
                        Swal.fire({
                            title: 'User updated successfully!',
                            icon: 'success'
                        })
                        $("#editUser").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllUsers();
                    }
                });
            }
        });

        // Delete User
        $("body").on("click", ".delBtn", function(e) {
            e.preventDefault();
            let tr = $(this).closest("tr");
            del_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= Config::get("domain") ?>admin/users/trash",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Deleted!',
                                'User deleted Successfully.!',
                                'success'
                            )
                            showAllUsers();
                        }
                    });
                }
            })
        });

        // View User details.
        $("body").on("click", ".infoBtn", function(e) {
            e.preventDefault();
            info_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/users/details",
                type: "POST",
                data: {
                    info_id: info_id
                },
                success: function(response) {
                    data = response;
                    Swal.fire({
                        title: '<strong>User Info : ID(' + data.id + ')</strong>',
                        icon: 'info',
                        html: '<b>Surname : </b>' + data.surname + '<br><b>Name : </b>' + data.surname + '<br><b>E-Mail : </b>' + data.email + '<br><b>Phone : </b>' + data.phone,
                        showCancelButton: true
                    })
                }
            });
        });
    });
</script>
<?php $this->end() ?>