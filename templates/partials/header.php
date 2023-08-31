<?php

use App\Core\Config;
use App\models\Topics;
use App\models\Settings;
use App\Core\Application;


$currentUser = Application::$app->currentUser;

$navTopics = Topics::navTopics();

$settings = Settings::fetchSettings();


?>

<div class="container">
    <header class="blog-header lh-1 py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="link-secondary">
                    <?= date("l, d F Y") ?>
                </a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="<?= Config::get('domain') ?>">
                <?php if($settings['logo'] ?? ''): ?>
                <img src="<?= get_image($settings['logo']) ?>" class="" style="width: 4rem;" alt="">
                <?php else: ?>
                    <h2>
                        <?= htmlspecialchars_decode($settings['title'] ?? $this->getTitle()); ?>
                    </h2>
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <button type="button" class="btn text-secondary ms-4" data-bs-toggle="modal"
                    data-bs-target="#searchModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img"
                        viewBox="0 0 24 24">
                        <title>Search</title>
                        <circle cx="10.5" cy="10.5" r="7.5" />
                        <path d="M21 21l-5.2-5.2" />
                    </svg>
                </button>
                <?php if ($currentUser): ?>
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="bi bi-person"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <h6 class="dropdown-header bg-primary text-white text-capitalize text-center">
                                    <?= $currentUser->displayName() ?>
                                </h6>
                            </li>
                            <li><a class="dropdown-item p-2" href="<?= Config::get('domain') ?>account">Profile</a></li>
                            <li><a class="dropdown-item p-2" href="<?= Config::get('domain') ?>quiz/confirm">Quiz</a></li>
                            <?php if ($currentUser->acl !== "user"): ?>
                                <li><a class="dropdown-item p-2" href="<?= Config::get('domain') ?>admin"
                                        target="_blank">Dashboard</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="<?= Config::get('domain') ?>logout" method="post">
                                    <button type="submit" class="dropdown-item bg-danger text-white p-2">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a class="btn btn-sm btn-outline-secondary" href="<?= Config::get('domain') ?>login">Login</a>
                <?php endif; ?>
            </div>
        </div>
        <!-- Search Modal -->
        <div class="modal fade mx-auto" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
                    <div class="modal-header border-0">
                        <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center">
                        <form action="/search" method="get" class="input-group" style="max-width: 600px;">
                            <input type="text" name="q" class="form-control bg-transparent border-light p-3 text-white"
                                placeholder="Type search keyword" />
                            <button class="btn btn-light px-4" type="submit">
                                <span class="bi bi-search"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="The Buzz Navbar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarBuzz">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= UrlIs('/') ? 'active' : '' ?>" aria-current="page"
                            href="<?= Config::get('domain') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= UrlIs('/news') ? 'active' : '' ?>"
                            href="<?= Config::get('domain') ?>news">News</a>
                    </li>
                    <?php if($settings['podcasts'] === 'active'): ?>
                        <li class="nav-item">
                        <a class="nav-link <?= UrlIs('/podcasts') ? 'active' : '' ?>"
                            href="<?= Config::get('domain') ?>podcasts">Podcasts</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?= UrlIs('/contact') ? 'active' : '' ?>"
                            href="<?= Config::get('domain') ?>contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if ($navTopics): ?>

        <div class="nav-scroller py-1 mb-2 border-bottom border-muted">
            <nav class="nav d-flex justify-content-between">
                <?php foreach ($navTopics as $nav): ?>
                    <a class="p-2 link-secondary fw-semibold <?= query_string("slug", $nav->slug) ? 'active' : '' ?>"
                        href="<?= Config::get("domain") ?>tags?slug=<?= $nav->slug ?>&tag_name=<?= $nav->topic ?>">
                        <?= $nav->topic ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>

    <?php endif; ?>
</div>