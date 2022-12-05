<?php

namespace app\routes;

use app\controllers\ControllerHome;
use app\controllers\ControllerStudents;
use app\controllers\ControllerCourses;
use app\controllers\Registration;

$app->get('/', ControllerHome::class . ":home");

$app->get('/registration', Registration::class . ":registration");

$app->get('/students', ControllerStudents::class . ":students");

$app->get('/courses', ControllerCourses::class . ":courses");