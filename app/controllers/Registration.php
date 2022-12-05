<?php

namespace app\controllers;

use app\controllers\Base;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Registration extends Base
{
    public function registration(Request $request, Response $response)
    {
        return $this->getTwig()->render(
            $response,
            $this->setView("registration"),
            array_merge(
                [
                    "title" => "Registration"
                ], VAR_LIST
            )
        );
    }
}