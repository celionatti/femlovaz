<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <h4 class="mt-2 text-primary">Subscriptions (Payments)</h4>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary btn-sm m-1 float-end" data-bs-toggle="modal" data-bs-target="#addSubscription"><i class="bi bi-plus-circle-dotted"></i> New Subscription</button>

        <a href="<?= Config::get("domain") ?>admin/payments/subscriptions?export=excel" class="btn btn-success btn-sm m-1 float-end"><i class="bi bi-table"></i> Export to Excel</a>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" id="showsubscriptions">
            <h3 class="text-center text-primary" style="margin-top: 150px;">Loading...</h3>
        </div>
    </div>
</div>

<!-- Add Subscription Modal -->
<div class="modal fade" id="addSubscription">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">New Subscription Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-123"></i></span>
                        <input type="text" class="form-control" name="transaction_id" placeholder="Transaction ID" aria-label="Transaction ID" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash"></i></span>
                        <input type="number" class="form-control" name="amount" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cassette"></i></span>
                        <input type="text" class="form-control" name="iuc_number" placeholder="IUC Number" aria-label="IUC Number" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <select class="form-control" name="decoder_type" placeholder="Decoder Type" aria-label="Decoder Type" aria-describedby="addon-wrapping">
                            <option value="">Select Decoder Type</option>
                            <?php foreach ($decoderOpts as $key => $value) : ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
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
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="insert" value="Add Subscription">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Edit Subscription Modal -->
<div class="modal fade" id="editSubscription">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Subscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-123"></i></span>
                        <input type="text" class="form-control" name="transaction_id" id="transaction_id" placeholder="Transaction ID" aria-label="Transaction ID" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash"></i></span>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cassette"></i></span>
                        <input type="text" class="form-control" name="iuc_number" id="iuc_number" placeholder="IUC Number" aria-label="IUC Number" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <select class="form-control" name="decoder_type" id="decoder_type" placeholder="Decoder Type" aria-label="Decoder Type" aria-describedby="addon-wrapping">
                            <option value="">Select Decoder Type</option>
                            <?php foreach ($decoderOpts as $key => $value) : ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
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
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="update" value="Edit Subscription">
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

        showAllSubscriptions();

        // Show All Sales.
        function showAllSubscriptions() {
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/payments/subscriptions",
                type: "POST",
                data: {
                    action: "view-subscriptions"
                },
                success: function(response) {
                    $("#showsubscriptions").html(response);
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
                    url: "<?= Config::get("domain") ?>admin/payments/subscriptions/create",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Subscription added successfully!',
                            icon: 'success'
                        })
                        $("#addSubscriptions").modal('hide');
                        $("#form-data")[0].reset();
                        showAllSubscriptions();
                    }
                });
            }
        });

        // Edit User.
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/payments/subscriptions/edit",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = response;
                    $("#id").val(data.id);
                    $("#transaction_id").val(data.transaction_id);
                    $("#amount").val(data.amount);
                    $("#name").val(data.name);
                    $("#iuc_number").val(data.iuc_number);
                    $("#payment_method").val(data.payment_method);
                    $("#decoder_type").val(data.decoder_type);
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
                    url: "<?= Config::get("domain") ?>admin/payments/subscriptions/edit",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function(response) {
                        Swal.fire({
                            title: 'Subscription updated successfully!',
                            icon: 'success'
                        })
                        $("#editSubscription").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllSubscriptions();
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
                        url: "<?= Config::get("domain") ?>admin/payments/subscriptions/trash",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Deleted!',
                                'Subscription deleted Successfully.!',
                                'success'
                            )
                            showAllSubscriptions();
                        }
                    });
                }
            })
        });

    });
</script>
<?php $this->end() ?>