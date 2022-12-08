<?php

namespace app\controllers;

use app\models\Students;
use DateTime;
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
                    "title" => "Students",
                    "students_list" => $students_list,
                    "edit_student" => HOME . "/editstudent",
                    "student_id_for_editing" => HOME . "/editstudent?id=",
                    "delete_student_url" => HOME . "/deletestudent",
                ],
                VAR_LIST
            )
        );
    }

    public function registerstudent(Request $request, Response $response)
    {
        return $this->getTwig()->render(
            $response,
            $this->setView("student-registration"),
            array_merge_recursive(
                [
                    "title" => "Register course",
                    "students_script" => "./js/students.js"
                ],
                VAR_LIST
            )
        );
    }

    public function editstudent(Request $request, Response $response)
    {
        $id = filter_input(INPUT_GET, "id", FILTER_UNSAFE_RAW);

        return $this->getTwig()->render(
            $response,
            $this->setView("edit-student"),
            array_merge(
                [
                    "title" => "Edit Student",
                    "student_data" => $this->students->findBy("id", $id)
                ],
                VAR_LIST
            )
        );
    }

    public function create(Request $request, Response $response, array $args)
    {
        $args = [
            "id" => filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW),
            "name" => filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW),
            "last_name" => filter_input(INPUT_POST, "last_name", FILTER_UNSAFE_RAW),
            "birth_date" => filter_input(INPUT_POST, "birth_date", FILTER_UNSAFE_RAW),
            "phone" => filter_input(INPUT_POST, "phone", FILTER_UNSAFE_RAW),
            "cpf" => filter_input(INPUT_POST, "cpf", FILTER_UNSAFE_RAW),
            "sign_up_date" => date("Y-m-d h:m:s", time())
        ];

        $date = DateTime::createFromFormat('d/m/Y', $args['birth_date']);
        $args['birth_date'] = $date->format('Y-m-d');

        $args['name'] = strtoupper($args['name']);
        $args['last_name'] = strtoupper($args['last_name']);
        $args['birth_date'] = $args['birth_date'];

        $FieldAndValues = [
            "id" => $args['id'],
            "name" => $args['name'],
            "last_name" => $args['last_name'],
            "birth_date" => $args['birth_date'],
            "phone" => $args['phone'],
            "cpf" => $args['cpf'],
            "sign_up_date" => $args['sign_up_date']
        ];

        $creatingStudent = $this->students->create($FieldAndValues);

        if ($creatingStudent) {
            $arr = [
                "status" => true,
                "msg" => "Record created successfully."
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
            "last_name" => filter_input(INPUT_POST, "last_name", FILTER_UNSAFE_RAW),
            "birth_date" => filter_input(INPUT_POST, "birth_date", FILTER_UNSAFE_RAW),
            "phone" => filter_input(INPUT_POST, "phone", FILTER_UNSAFE_RAW),
            "cpf" => filter_input(INPUT_POST, "cpf", FILTER_UNSAFE_RAW),
            "update_date" => date("Y-m-d h:m:s", time())
        ];

        $args['name'] = strtoupper($args['name']);
        $args['last_name'] = strtoupper($args['last_name']);
        $args['birth_date'] = date('Y-m-d', $args['birth_date']);

        $fieldsAndValues = [
            "fields" => [
                "name" => $args['name'],
                "last_name" => $args['last_name'],
                "birth_date" => $args['birth_date'],
                "phone" => $args['phone'],
                "cpf" => $args['cpf'],
                "update_date" => $args['update_date'],
            ],
            "where" => [
                "id" => $args['id']
            ]
        ];

        $updatingStudent = $this->students->update($fieldsAndValues);

        if ($updatingStudent) {
            $arr = [
                "status" => true,
                "msg" => "Record updated successfully."
            ];
            $json = json_encode($arr);
            $response->getBody()->write($json);
            return $response->withStatus(200)->withHeader('Content-type', 'application/json');
            die();
        }

        $arr = [
            "status" => false,
            "msg" => "Failed to update record."
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
        $deletingFromDB = $this->students->delete($field, $value);

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
