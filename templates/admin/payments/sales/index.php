<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <h4 class="mt-2 text-primary">Sales (Payments)</h4>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary btn-sm m-1 float-end" data-bs-toggle="modal" data-bs-target="#addSale"><i class="bi bi-cart-plus"></i> New Sale</button>

        <a href="<?= Config::get("domain") ?>admin/payments/sales?export=excel" class="btn btn-success btn-sm m-1 float-end"><i class="bi bi-table"></i> Export to Excel</a>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" id="showsales">
            <h3 class="text-center text-primary" style="margin-top: 150px;">Loading...</h3>
        </div>
    </div>
</div>

<!-- Add Sales Modal -->
<div class="modal fade" id="addSale">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">New Sales Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <select class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                            <option value="">Select Name/Inventory</option>
                            <?php foreach($stocks as $key => $value): ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash"></i></span>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-percent"></i></span>
                        <input type="number" class="form-control" name="qty" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-wallet2"></i></span>
                        <select class="form-control" name="payment_method" placeholder="Payment Method" aria-label="Payment Method" aria-describedby="addon-wrapping">
                            <option value="">Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="pos">POS</option>
                            <option value="transfer">Transfer</option>
                            <option value="web">WEB</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-journal-text"></i></span>
                        <input type="text" class="form-control" name="note" placeholder="Note" aria-label="Note" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-info-circle"></i></span>
                        <select class="form-control" name="status" placeholder="Status" aria-label="Status" aria-describedby="addon-wrapping">
                            <option value="">Select Status</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="insert" value="Add Sale">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Edit Customer Modal -->
<div class="modal fade" id="editSale">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Sale</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <select class="form-control" name="name" id="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                            <option value="">Select Name/Inventory</option>
                            <?php foreach($stocks as $key => $value): ?>
                                <option value="<?= $value->name ?>"><?= $value->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash"></i></span>
                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-percent"></i></span>
                        <input type="number" class="form-control" name="qty" id="qty" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-wallet2"></i></span>
                        <select class="form-control" name="payment_method" id="payment_method" placeholder="Payment Method" aria-label="Payment Method" aria-describedby="addon-wrapping">
                            <option value="">Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="pos">POS</option>
                            <option value="transfer">Transfer</option>
                            <option value="web">WEB</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-journal-text"></i></span>
                        <input type="text" class="form-control" name="note" id="note" placeholder="Note" aria-label="Note" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-info-circle"></i></span>
                        <select class="form-control" name="status" id="status" placeholder="Status" aria-label="Status" aria-describedby="addon-wrapping">
                            <option value="">Select Status</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="input-group flex-nowrap">
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="update" value="Edit Sale">
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

        showAllSales();

        // Show All Sales.
        function showAllSales() {
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/payments/sales",
                type: "POST",
                data: {
                    action: "view-sales"
                },
                success: function(response) {
                    $("#showsales").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        // Create New Sale.
        $("#insert").click(function(e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/payments/sales/create",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: 'Sale added successfully!',
                            icon: 'success'
                        })
                        $("#addSale").modal('hide');
                        $("#form-data")[0].reset();
                        showAllSales();
                    }
                });
            }
        });

        // Edit User.
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/payments/sales/edit",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = response;
                    $("#id").val(data.id);
                    $("#slug").val(data.slug);
                    $("#name").val(data.name);
                    $("#amount").val(data.amount);
                    $("#qty").val(data.qty);
                    $("#payment_method").val(data.payment_method);
                    $("#note").val(data.note);
                    $("#status").val(data.status);
                }
            });
        });

        // Update Customer.
        $("#update").click(function(e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/payments/sales/edit",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function(response) {
                        Swal.fire({
                            title: 'Sale updated successfully!',
                            icon: 'success'
                        })
                        $("#editSale").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllSales();
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
                        url: "<?= Config::get("domain") ?>admin/payments/sales/trash",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Deleted!',
                                'Sale deleted Successfully.!',
                                'success'
                            )
                            showAllSales();
                        }
                    });
                }
            })
        });

    });
</script>
<?php $this->end() ?>