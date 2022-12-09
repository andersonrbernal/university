<?php

namespace app\controllers;

use app\controllers\Base;
use app\models\Students;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerHome extends Base
{

    public function home(Request $request, Response $response)
    {
        return $this->getTwig()->render(
            $response,
            $this->setView("home"),
            array_merge(
                [
                    "title" => "Página Inicial"
                ], VAR_LIST
            )
        );
    }
}