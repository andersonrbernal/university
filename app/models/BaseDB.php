<?php

namespace app\models;

use app\libs\Connection;
use app\libs\Create;
use app\libs\Read;
use app\libs\Update;
use app\libs\Delete;

class BaseDB
{
    use Connection, Create, Read, Update, Delete;
}