<?php

namespace app\controllers;

use app\models\Students;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerStudents extends Base
{
    private $students;

    public function __construct()
    {
        $this->students = new Students();
    }

    public function students(Request $request, Response $response)
    {
        $students_list = $this->students->find();

        return $this->getTwig()->render(
            $response,
            $this->setView("students"),
            array_merge_recursive(
                [
                    "title" => "Students List",
                    "students_list" => $students_list
                ], VAR_LIST
            )
        );
    }
}
