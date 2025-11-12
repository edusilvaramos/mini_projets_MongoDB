<?php

namespace App\Controller;

abstract class BaseController
{
    protected function render(string $view, array $params = []): void
    {
        $root = dirname(__DIR__, 2);
        $viewFile = $root . '/view/templates/' . $view . '.php';

        $header = $root . '/view/templates/layout/header.php';
        if (!is_file($header) && is_file($root . '/header.php')) $header = $root . '/header.php';

        $footer = $root . '/view/templates/layout/footer.php';
        if (!is_file($footer) && is_file($root . '/footer.php')) $footer = $root . '/footer.php';

        extract($params, EXTR_SKIP);
        if (is_file($header)) include $header;
        include $viewFile;
        if (is_file($footer)) include $footer;
    }

    protected function redirect(string $route, array $query = []): void
    {
        $q = $query ? '&' . http_build_query($query) : '';
        header('Location: index.php?' . $route . $q);
        exit;
    }
}
