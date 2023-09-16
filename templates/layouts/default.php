<?php


use App\Core\Config;
use App\Core\Support\FlashMessage;


?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $csrfToken; ?>">
    <link rel="icon" href="<?= assets_path('img/favicon.png') ?>" />
    <link rel="apple-touch-icon" href="<?= assets_path('img/favicon.png') ?>" />
    <title>
        <?= $this->getTitle() ?>
    </title>
    <link type="text/css" rel="stylesheet" href="<?= assets_path('packages/aos/aos.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('bootstrap/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('bootstrap/css/bootstrap-icons.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('packages/boxicons/css/boxicons.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('packages/glightbox/css/glightbox.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('packages/remixicon/remixicon.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('packages/swiper/swiper-bundle.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= assets_path('css/style.css'); ?>">
    <meta name="author" content="<?= Config::get("author"); ?>">
    <?php $this->content('header') ?>
</head>

<body>

    <?= FlashMessage::bootstrap_alert(); ?>
    <?php $this->content('content'); ?>

    <script src="<?= assets_path('js/jquery-3.6.3.min.js'); ?>"></script>
    <script src="<?= assets_path('packages/purecounter/purecounter_vanilla.js'); ?>"></script>
    <script src="<?= assets_path('packages/aos/aos.js'); ?>"></script>
    <script src="<?= assets_path('bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= assets_path('packages/glightbox/js/glightbox.min.js'); ?>"></script>
    <script src="<?= assets_path('packages/isotope-layout/isotope.pkgd.min.js'); ?>"></script>
    <script src="<?= assets_path('packages/swiper/swiper-bundle.min.js'); ?>"></script>

    <script src="<?= assets_path('js/main.js'); ?>"></script>

    <?php $this->content('script') ?>

</body>

</html>