<?php

namespace App\Core\Support;

use App\Core\Application;


class FlashMessage
{
    public static function bootstrap_alert()
    {
        if (Application::$app->session->getFlash('success')) {
            return self::bootstrap_success(Application::$app->session->getFlash('success'));
        }

        if (Application::$app->session->getFlash('error')) {
            return self::bootstrap_error(Application::$app->session->getFlash('error'));
        }

        if (Application::$app->session->getFlash('info')) {
            return self::bootstrap_info(Application::$app->session->getFlash('info'));
        }

        if (Application::$app->session->getFlash('warning')) {
            return self::bootstrap_warning(Application::$app->session->getFlash('warning'));
        }

        return '';
    }

    private static function bootstrap_success($msg)
    {
        echo "
            <div class='alert alert-success alert-dismissible fade show mt-3 mx-2 shadow-lg text-uppercase text-center' role='alert' id='alert-message' style='z-index: 99999;'>
                <div>{$msg}</div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }

    private static function bootstrap_error($msg)
    {
        echo "
            <div class='alert alert-danger alert-dismissible fade show mt-3 mx-2 shadow-lg text-uppercase text-center' role='alert' style='z-index: 99999;'>
                <div>{$msg}</div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }

    private static function bootstrap_info($msg)
    {
        echo "
            <div class='alert alert-info alert-dismissible fade show mt-3 mx-2 shadow-lg text-uppercase text-center' role='alert' style='z-index: 99999;'>
                <div>{$msg}</div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }

    private static function bootstrap_warning($msg)
    {
        echo "
            <div class='alert alert-warning alert-dismissible fade show mt-3 mx-2 shadow-lg text-uppercase text-center' role='alert' style='z-index: 99999;'>
                <div>{$msg}</div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }
}