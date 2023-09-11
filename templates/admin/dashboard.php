<?php


use App\Core\Config;

$this->setTitle(Config::get('title') . ' | Admin | Dashboard');


?>

<?php $this->start('content') ?>
<div class="row">
    <!-- Card -->
    <div class="col-xl-4 col-md-6 my-1">
        <div class="card bg-primary text-white text-center">
            <div class="card-body">
                <h1 class="m-0 bi bi-person display-1"></h1>
                <h2 class="m-0">Users</h2>
            </div>
            <div class="card-footer">
                <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/users">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <!-- // Card -->
    <!-- Card -->
    <div class="col-xl-4 col-md-6 my-1">
        <div class="card bg-primary text-white text-center">
            <div class="card-body">
                <h1 class="m-0 bi bi-person display-1"></h1>
                <h2 class="m-0">Stocks</h2>
            </div>
            <div class="card-footer">
                <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/stocks">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <!-- // Card -->
    <!-- Card -->
    <div class="col-xl-4 col-md-6 my-1">
        <div class="card bg-primary text-white text-center">
            <div class="card-body">
                <h1 class="m-0 bi bi-telephone display-1"></h1>
                <h2 class="m-0">Inquiries</h2>
            </div>
            <div class="card-footer">
                <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/inquiries">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <!-- // Card -->
    <!-- Card -->
    <div class="col-xl-4 col-md-6 my-1">
        <div class="card bg-primary text-white text-center">
            <div class="card-body">
                <h1 class="m-0 bi bi-question-circle display-1"></h1>
                <h2 class="m-0">Help Center</h2>
            </div>
            <div class="card-footer">
                <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/help-center">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <!-- // Card -->
    <!-- Card -->
    <div class="col-xl-4 col-md-6 my-1">
        <div class="card bg-primary text-white text-center">
            <div class="card-body">
                <h1 class="m-0 bi bi-journal-richtext display-1"></h1>
                <h2 class="m-0">Accounting</h2>
            </div>
            <div class="card-footer">
                <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/book-keeping">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <!-- // Card -->
    <!-- Card -->
    <div class="col-xl-4 col-md-6 my-1">
        <div class="card bg-primary text-white text-center">
            <div class="card-body">
                <h1 class="m-0 bi bi-wallet2 display-1"></h1>
                <h2 class="m-0">Payments</h2>
            </div>
            <div class="card-footer">
                <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/payments">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <!-- // Card -->
</div>
<?php $this->end() ?>