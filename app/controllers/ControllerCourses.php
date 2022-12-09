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
                    "title" => "Cursos",
                    "courses_list" => $courses_list,
                    "course_id_for_editing" => HOME . "/editcourse?id=",
                    "delete_course_url" => "/deletecourse"
                ],
                VAR_LIST
            )
        );
    }

    public function editcourse(Request $request, Response $response)
    {
        $id = filter_input(INPUT_GET, "id", FILTER_UNSAFE_RAW);

        return $this->getTwig()->render(
            $response,
            $this->setView("edit-course"),
            array_merge_recursive(
                [
                    "title" => "Editar curso",
                    "course_data" => $this->courses->findBy("id", $id),
                    "course_script" => "./js/updateCourse.js"
                ],
                VAR_LIST
            )
        );
    }

    public function registercourse(Request $request, Response $response)
    {
        return $this->getTwig()->render(
            $response,
            $this->setView("course-registration"),
            array_merge_recursive(
                [
                    "title" => "Cadastrar curso",
                    "courses_script" => "./js/createCourse.js"
                ],
                VAR_LIST
            )
        );
    }

    public function create(Request $request, Response $response, array $args)
    {
        $args = [
            "name" => filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW),
            "hours" => filter_input(INPUT_POST, "hours", FILTER_UNSAFE_RAW),
            "sign_up_date" => date("Y-m-d h:m:s", time())
        ];

        $createFieldAndValues = [
            "name" => strtoupper($args['name']),
            "hours" => number_format($args['hours']),
            "sign_up_date" => $args['sign_up_date']
        ];

        $creatingCourse = $this->courses->create($createFieldAndValues);

        if ($creatingCourse) {
            $arr = [
                "status" => true,
                "msg" => "Record sucessfully created."
            ];
            $json = json_encode($arr);
            $response->getBody()->write($json);
            return $response->withStatus(200)->withHeader('Content-type', 'application/json');
            die();
        } else {
            $arr = [
                "status" => false,
                "msg" => "Failed to create record."
            ];
            $json = json_encode($arr);
            $response->getBody()->write($json);
            return $response->withStatus(500)->withHeader('Content-type', 'application/json');
            die();
        }
    }

    public function update(Request $request, Response $response, array $args)
    {
        $args = [
            "id" => filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW),
            "name" => filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW),
            "hours" => filter_input(INPUT_POST, "hours", FILTER_UNSAFE_RAW),
            "update_date" => date("Y-m-d h:m:s", time())
        ];

        $name = strtoupper($args['name']);
        $hours = number_format($args['hours']);

        $updateFieldAndValues = [
            "fields" => [
                "name" => $name,
                "hours" => $hours,
                "update_date" => $args['update_date']
            ],
            "where" => [
                "id" => $args['id']
            ]
        ];

        $updating = $this->courses->update($updateFieldAndValues);

        if ($updating) {
            $arr = [
                "status" => true,
                "msg" => "Course saved successfully."
            ];
            $json = json_encode($arr);
            $response->getBody()->write($json);
            return $response->withStatus(200)->withHeader('Content-type', 'application/json');
            die();
        }

        $arr = [
            "status" => false,
            "msg" => "Failed to save course."
        ];
        $json = json_encode($arr);
        $response->getBody()->write($json);
        return $response->withStatus(500)->withHeader('Content-type', 'application/json');
        die();
    }

    public function delete(Request $request, Response $response)
    {
        $field = "id";
        $value = filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW);
        $deletingFromDB = $this->courses->delete($field, $value);

        if ($deletingFromDB) {
            $arr = [
                "status" => true,
                "msg" => "Record sucessfully deleted."
            ];
            $json = json_encode($arr);
            $response->getBody()->write($json);
            return $response->withStatus(200)->withHeader('Content-type', 'application/json');
            die();
        }

        $arr = [
            "status" => false,
            "msg" => "Failed to delete record."
        ];
        $json = json_encode($arr);
        $response->getBody()->write($json);
        return $response->withStatus(500)->withHeader('Content-type', 'application/json');
        die();
    }
}
