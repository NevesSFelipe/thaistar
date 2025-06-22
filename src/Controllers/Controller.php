<?php

namespace App\Controllers;

class Controller
{
    protected function view(string $viewName, array $data = [])
    {
        $viewPath = __DIR__ . '/../Views/' . $viewName . '.php';

        if (file_exists($viewPath)) {
            extract($data); // Transforma array em variáveis
            require $viewPath;
        } else {
            echo "View '{$viewName}' não encontrada!";
        }
    }
}