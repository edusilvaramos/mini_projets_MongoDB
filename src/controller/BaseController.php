<?php

namespace App\Controller;

use App\Connection\Connection;

abstract class BaseController
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    protected function render(string $view, array $params = []): void
    {
        $root = dirname(__DIR__, 2);

        $viewFile = $root . '/view/templates/layout/' . $view . '.php';

        if (!is_file($viewFile)) {
            throw new \RuntimeException("View not found: $viewFile");
        }

        
        ob_start();
        include $viewFile;
        $content = ob_get_clean(); 



        include $root . '/view/templates/base.php';
    }

    protected function redirect(string $route, array $query = []): void
    {
        $q = $query ? '&' . http_build_query($query) : '';
        header('Location: index.php?' . $route . $q);
        exit;
    }
}
