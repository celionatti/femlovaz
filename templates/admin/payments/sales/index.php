<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <h4 class="mt-2 text-primary">Customers</h4>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary btn-sm m-1 float-end" data-bs-toggle="modal" data-bs-target="#addCustomer"><i class="bi bi-person-add"></i> New Customer</button>

        <a href="<?= Config::get("domain") ?>admin/customers?export=excel" class="btn btn-success btn-sm m-1 float-end"><i class="bi bi-table"></i> Export to Excel</a>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" id="showcustomers">
            <h3 class="text-center text-primary" style="margin-top: 150px;">Loading...</h3>
        </div>
    </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomer">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-lines-fill"></i></span>
                        <input type="text" class="form-control" name="othername" placeholder="Othername" aria-label="Othername" aria-describedby="addon-wrapping">
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
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" name="address" placeholder="Address" aria-label="Address" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cassette"></i></span>
                        <select class="form-control" name="decoder_type" placeholder="Decoder Type" aria-label="Decoder Type" aria-describedby="addon-wrapping">
                            <option value="">Decoder Type</option>
                            <option value="gotv">Gotv</option>
                            <option value="dstv">Dstv</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-123"></i></span>
                        <input type="text" class="form-control" name="iuc_number" placeholder="IUC Number" aria-label="IUC Number" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="insert" value="Add Customer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomer">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="slug" id="slug">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-lines-fill"></i></span>
                        <input type="text" class="form-control" name="othername" id="othername" placeholder="Othername" aria-label="Othername" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at"></i></span>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-telephone"></i></span>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" aria-label="Phone" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" aria-label="Address" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cassette"></i></span>
                        <select class="form-control" name="decoder_type" id="decoder_type" placeholder="Decoder Type" aria-label="Decoder Type" aria-describedby="addon-wrapping">
                            <option value="">Decoder Type</option>
                            <option value="gotv">Gotv</option>
                            <option value="dstv">Dstv</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-123"></i></span>
                        <input type="text" class="form-control" name="iuc_number" id="iuc_number" placeholder="IUC Number" aria-label="IUC Number" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="update" value="Edit Customer">
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

        showAllCustomers();

        // Show All Customers.
        function showAllCustomers() {
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/customers",
                type: "POST",
                data: {
                    action: "view-customers"
                },
                success: function(response) {
                    // console.log(response)
                    $("#showcustomers").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        // Create New Customer.
        $("#insert").click(function(e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/customers/create",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function(response) {
                        Swal.fire({
                            title: 'Customer added successfully!',
                            icon: 'success'
                        })
                        $("#addCustomer").modal('hide');
                        $("#form-data")[0].reset();
                        showAllCustomers();
                    }
                });
            }
        });

        // Edit User.
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/customers/edit",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = response;
                    $("#id").val(data.id);
                    $("#slug").val(data.slug);
                    $("#name").val(data.name);
                    $("#othername").val(data.othername);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                    $("#address").val(data.address);
                    $("#decoder_type").val(data.decoder_type);
                    $("#iuc_number").val(data.iuc_number);
                }
            });
        });

        // Update Customer.
        $("#update").click(function(e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/customers/edit",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function(response) {
                        Swal.fire({
                            title: 'Customer updated successfully!',
                            icon: 'success'
                        })
                        $("#editCustomer").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllCustomers();
                    }
                });
            }
        });

        // Delete Customer
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
                        url: "<?= Config::get("domain") ?>admin/customers/trash",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Deleted!',
                                'Customer deleted Successfully.!',
                                'success'
                            )
                            showAllCustomers();
                        }
                    });
                }
            })
        });

        // View Customer details.
        $("body").on("click", ".infoBtn", function(e) {
            e.preventDefault();
            info_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/customers/details",
                type: "POST",
                data: {
                    info_id: info_id
                },
                success: function(response) {
                    data = response;
                    Swal.fire({
                        title: '<strong>Customer Info : ID(' + data.id + ')</strong>',
                        icon: 'info',
                        html: '<div class="border border-3 border-primary px-2 py-1"><b>Name : </b>' + data.name + '<br><b>Other Name : </b>' + data.othername + '<br><b>E-Mail : </b>' + data.email + '<br><b>Phone : </b>' + data.phone + '<br><b>Address : </b>' + data.address + '<br><b>Decoder Type : </b>' + data.decoder_type + '<br><b>IUC Number : </b>' + data.iuc_number + '<br><b>Created Date : </b>' + data.created_at + '</div>',
                        showCancelButton: true
                    })
                }
            });
        });
    });
</script>
<?php $this->end() ?>