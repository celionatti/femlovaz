<?php

use App\Core\Config;



?>

<nav style="background: #83cee0" id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item border mx-2 mb-2 rounded-2">
                <a class="nav-link active" aria-current="page" href="<?= Config::get('domain') ?>admin">
                    <span class="align-text-center bi bi-house"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item border mx-2 mb-2 rounded-2">
                <a class="nav-link" href="<?= Config::get('domain') ?>admin/users">
                    <span class="align-text-center bi bi-people"></span>
                    Users
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-2 text-muted text-uppercase">
            <span>Others</span>
            <a class="link-secondary" aria-label="Add a new report">
                <span class="align-text-center bi bi-plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item border mx-2 mb-2 rounded-2">
                <a class="nav-link" href="<?= Config::get('domain') ?>admin/settings">
                    <span class="align-text-center bi bi-gear-wide-connected"></span>
                    Settings
                </a>
            </li>
            <li class="nav-item border mx-2 my-3 rounded-2">
                <a class="nav-link text-danger" href="<?= Config::get('domain') ?>">
                    <span class="align-text-center bi bi-globe"></span>
                    Visit Site
                </a>
            </li>
        </ul>

        <div class="d-flex align-items-center justify-content-center btn-toolbar mb-2 mb-md-0 mx-2">
            <button type="button" class="btn btn-sm btn-outline-primary w-100 p-2">
                <span class="bi bi-person"></span> <span class="text-capitalize">Femlovaz</span>
            </button>
        </div>

    </div>
</nav>