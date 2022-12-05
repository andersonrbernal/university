<?php

namespace app\controllers;

use app\controllers\Base;
use app\models\Courses;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerCourses extends Base
{
    private $courses;

    public function __construct()
    {
        $this->courses = new Courses(); 
    }

    public function courses(Request $request, Response $response)
    {
        $courses_list = $this->courses->find();

        return $this->getTwig()->render(
            $response,
            $this->setView("courses"),
            array_merge_recursive(
                [
                    "title" => "Courses",
                    "courses_list" => $courses_list
                ], VAR_LIST
            )
        );
    }
}