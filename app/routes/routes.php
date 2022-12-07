<?php

namespace app\routes;

use app\controllers\ControllerHome;
use app\controllers\ControllerStudents;
use app\controllers\ControllerCourses;
use app\controllers\Registration;

$app->get('/', ControllerHome::class . ":home");

$app->get('/registration', Registration::class . ":registration");

$app->get('/students', ControllerStudents::class . ":students");
$app->get('/registerstudent', ControllerStudents::class . ":registerstudent");
$app->get('/editstudent', ControllerStudents::class . ':editstudent');
$app->post('/deletestudent', ControllerStudents::class . ':delete');

$app->get('/courses', ControllerCourses::class . ":courses");
$app->get('/registercourse', ControllerCourses::class . ":registercourse");
$app->get('/editcourse', ControllerCourses::class . ':editcourse');
$app->post('/deletecourse', ControllerCourses::class . ':delete');