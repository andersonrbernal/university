<?php

namespace app\helpers;
// ROOT
define("ROOT", dirname(__FILE__, 2));
// HOME
define("HOME", "http://localhost");
// EXT_VIEWS
define("EXT_VIEWS", ".html");
// DIR_VIEWS
define("DIR_VIEWS", ROOT . "/views");
// BRAZILIAN PORTUGUESE
define("LANG_PT_BR", "pt-BR");
// ENGLISH 
define("LANG_EN", "en");
// LIST OF VARIABLES FOR TWIG TEMPLATES
define("VAR_LIST", [
    "home" => HOME,
    "students" => HOME . "/students",
    "courses" => HOME . "/courses",
    "registration" => HOME . "/registration",
    "lang" => LANG_PT_BR
]);