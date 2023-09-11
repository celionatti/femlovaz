<?php

use App\Core\Config;
use App\Core\Support\Helpers\Token;

?>

<?php $this->start("content") ?>
<div class="row">
    <div class="col-lg-6">
        <!-- <h4 class="mt-2 text-primary">Payments</h4> -->
    </div>
    <div class="col-lg-6">
        <a href="<?= Config::get("domain") ?>admin/payments/sales" class="btn btn-primary btn-sm m-1 float-end"><i class="bi bi-cart4"></i> Sales</a>

        <a href="<?= Config::get("domain") ?>admin/payments/subscriptions" class="btn btn-success btn-sm m-1 float-end"><i class="bi bi-cloud-upload"></i> Subscriptions</a>
    </div>
</div>
<hr class="my-1">
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <!-- Card -->
            <div class="col-xl-6 col-md-6 my-1">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <h1 class="m-0 display-1">
                            <img src="<?= get_image("assets/img/naira.svg") ?>" width="40" alt="" class="img-fluid">
                            50,000
                        </h1>
                        <h2 class="m-0">Total Sales</h2>
                    </div>
                    <div class="card-footer">
                        <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/payments/sales">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <!-- // Card -->
            <!-- Card -->
            <div class="col-xl-6 col-md-6 my-1">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <h1 class="m-0 display-1">
                            <img src="<?= get_image("assets/img/naira.svg") ?>" width="40" alt="" class="img-fluid">
                            50,000
                        </h1>
                        <h2 class="m-0">Total Subscriptions</h2>
                    </div>
                    <div class="card-footer">
                        <a class="small text-white stretched-link" href="<?= Config::get('domain') ?>admin/payments/subscriptions">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <!-- // Card -->
        </div>
    </div>
</div>

<?php $this->end() ?>

<?php $this->start("script") ?>

<?php $this->end() ?>