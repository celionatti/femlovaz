<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <h4 class="mt-2 text-primary">Stocks</h4>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary btn-sm m-1 float-end" data-bs-toggle="modal" data-bs-target="#addStock"><i class="bi bi-person-add"></i> New Stock</button>

        <a href="<?= Config::get("domain") ?>admin/stocks?export=excel" class="btn btn-success btn-sm m-1 float-end"><i class="bi bi-table"></i> Export to Excel</a>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" id="showstocks">
            <h3 class="text-center text-primary" style="margin-top: 150px;">Loading...</h3>
        </div>
    </div>
</div>

<!-- Add Stock Modal -->
<div class="modal fade" id="addStock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Stock</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash-coin"></i></span>
                        <input type="number" class="form-control" name="price" placeholder="Price" aria-label="Price" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-percent"></i></span>
                        <input type="number" class="form-control" name="qty" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-info-circle"></i></span>
                        <select class="form-control" name="status" placeholder="Status" aria-label="Status" aria-describedby="addon-wrapping">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="insert" value="Add Stock">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Edit Stock Modal -->
<div class="modal fade" id="editStock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Stock</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="slug" id="slug">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash-coin"></i></span>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Price" aria-label="Price" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-percent"></i></span>
                        <input type="number" class="form-control" name="qty" id="qty" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-info-circle"></i></span>
                        <select class="form-control" name="status" id="status" placeholder="Status" aria-label="Status" aria-describedby="addon-wrapping">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="update" value="Edit Stock">
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

        showAllStocks();

        // Show All Customers.
        function showAllStocks() {
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/stocks",
                type: "POST",
                data: {
                    action: "view-stocks"
                },
                success: function(response) {
                    // console.log(response)
                    $("#showstocks").html(response);
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
                    url: "<?= Config::get("domain") ?>admin/stocks/create",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function(response) {
                        Swal.fire({
                            title: 'Stock added successfully!',
                            icon: 'success'
                        })
                        $("#addStock").modal('hide');
                        $("#form-data")[0].reset();
                        showAllStocks();
                    }
                });
            }
        });

        // Edit User.
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/stocks/edit",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = response;
                    $("#id").val(data.id);
                    $("#slug").val(data.slug);
                    $("#name").val(data.name);
                    $("#price").val(data.price);
                    $("#qty").val(data.qty);
                    $("#status").val(data.status);
                }
            });
        });

        // Update Stock.
        $("#update").click(function(e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/stocks/edit",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function(response) {
                        Swal.fire({
                            title: 'Stock updated successfully!',
                            icon: 'success'
                        })
                        $("#editStock").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllStocks();
                    }
                });
            }
        });

        // Delete Stock
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
                        url: "<?= Config::get("domain") ?>admin/stocks/trash",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Deleted!',
                                'Stock deleted Successfully.!',
                                'success'
                            )
                            showAllStocks();
                        }
                    });
                }
            })
        });

    });
</script>
<?php $this->end() ?>