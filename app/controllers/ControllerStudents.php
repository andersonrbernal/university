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
                    "title" => "Students",
                    "students_list" => $students_list,
                    "edit_student" => HOME. "/editstudent",
                    "student_id_for_editing" => HOME . "/editstudent?id=",
                    "delete_student_url" => HOME . "/deletestudent"
                ], VAR_LIST
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
                    "title" => "Register course"                    
                ], VAR_LIST
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
                ], VAR_LIST
            )
        );
    }

    public function create(Request $request, Response $response, array $args)
    {
        $id = filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW);
        $name = filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW);
        $last_name = filter_input(INPUT_POST, "last_name", FILTER_UNSAFE_RAW);
        $birth_date = filter_input(INPUT_POST, "birth_date", FILTER_UNSAFE_RAW);
        $phone = filter_input(INPUT_POST, "phone", FILTER_UNSAFE_RAW);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_UNSAFE_RAW);
        $sign_up_date = date("Y-m-d h:m:s", time());

        $fieldAndValues = [
            "id" => $id,
            "name" => strtoupper($name),
            "last_name" => strtoupper($last_name),
            "birth_date" => strtoupper($birth_date),
            "phone" => $phone,
            "cpf" => $cpf,
            "sign_up_date" => $sign_up_date
        ];

        return $this->students->create($fieldAndValues);
    }

    public function update(array $updateFieldsAndValues)
    {
        $id = filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW);
        $name = filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW);
        $last_name = filter_input(INPUT_POST, "last_name", FILTER_UNSAFE_RAW);
        $birth_date = filter_input(INPUT_POST, "birth_date", FILTER_UNSAFE_RAW);
        $phone = filter_input(INPUT_POST, "phone", FILTER_UNSAFE_RAW);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_UNSAFE_RAW);
        $update_date = date("Y-m-d h:m:s", time());

        $updateFieldsAndValues = [
            "fields" => [
                "name" => strtoupper($name),
                "last_name" => strtoupper($last_name),
                "birth_date" => date("Y-m-d", $birth_date),
                "phone" => $phone,
                "cpf" => $cpf,
                "update_date" => $update_date
            ],
            "where" => [
                "id" => $id
            ]
        ];
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
