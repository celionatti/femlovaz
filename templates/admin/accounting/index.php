<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <h4 class="mt-2 text-primary"></h4>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-primary btn-sm m-1 float-end" data-bs-toggle="modal" data-bs-target="#addFlow"><i class="bi bi-plus-circle-dotted"></i> New Flow</button>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" id="showflows">
            <h3 class="text-center text-primary" style="margin-top: 150px;">Loading...</h3>
        </div>
    </div>
</div>

<!-- Add ward Modal -->
<div class="modal fade" id="addFlow">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">New Flow (Credit/Debit)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-data">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash"></i></span>
                        <input type="number" class="form-control" name="amount" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-journal-text"></i></span>
                        <input type="text" class="form-control" name="details" placeholder="Details" aria-label="Details" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <select class="form-control" name="flow_type" placeholder="Flow Type" aria-label="Flow Type" aria-describedby="addon-wrapping">
                            <option value="">Select Flow Type</option>
                            <option value="credit">Credit (Inwards)</option>
                            <option value="debit">Debit (Expenses)</option>
                        </select>
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
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="insert" value="Add Flow">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Edit ward Modal -->
<div class="modal fade" id="editFlow">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Flow (Credit/Debit)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="flow_id" id="flow_id">
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-cash"></i></span>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" aria-label="Amount" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-journal-text"></i></span>
                        <input type="text" class="form-control" name="details" id="details" placeholder="Details" aria-label="Details" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-ticket-detailed"></i></span>
                        <select class="form-control" name="flow_type" id="flow_type" placeholder="Flow Type" aria-label="Flow Type" aria-describedby="addon-wrapping">
                            <option value="">Select Flow Type</option>
                            <option value="credit">Credit (Inwards)</option>
                            <option value="debit">Debit (Expenses)</option>
                        </select>
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
                        <input type="submit" class="btn btn-dark btn-sm w-100" id="update" value="Edit Flow">
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

        showAllTransactions();

        // Show All Sales.
        function showAllTransactions() {
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/book-keeping/all",
                type: "POST",
                data: {
                    action: "view-flows"
                },
                success: function(response) {
                    $("#showflows").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        // Create New Transaction.
        $("#insert").click(function(e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/book-keeping/create",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function(response) {
                        Swal.fire({
                            title: 'Flow added successfully!',
                            icon: 'success'
                        })
                        $("#addFlow").modal('hide');
                        $("#form-data")[0].reset();
                        showAllTransactions();
                    }
                });
            }
        });

        // Edit Flow.
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "<?= Config::get("domain") ?>admin/book-keeping/edit",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = response;
                    $("#id").val(data.id);
                    $("#flow_id").val(data.flow_id);
                    $("#amount").val(data.amount);
                    $("#details").val(data.details);
                    $("#flow_type").val(data.flow_type);
                    $("#status").val(data.status);
                }
            });
        });

        // Update Flow.
        $("#update").click(function(e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "<?= Config::get("domain") ?>admin/book-keeping/edit",
                    type: "POST",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function(response) {
                        Swal.fire({
                            title: 'Flow updated successfully!',
                            icon: 'success'
                        })
                        $("#editFlow").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllTransactions();
                    }
                });
            }
        });

        // Delete Flow
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
                        url: "<?= Config::get("domain") ?>admin/book-keeping/trash",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            tr.css('background-color', '#ff6666');
                            Swal.fire(
                                'Deleted!',
                                'Flow deleted Successfully.!',
                                'success'
                            )
                            showAllTransactions();
                        }
                    });
                }
            })
        });

    });
</script>
<?php $this->end() ?>