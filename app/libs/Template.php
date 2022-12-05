<?php

namespace app\libs;

use Slim\Views\Twig;
use Exception;

trait Template
{
    public function getTwig()
    {
        try {
            return Twig::create(DIR_VIEWS);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function setView(string $file)
    {
        return $file . EXT_VIEWS;
    }
}