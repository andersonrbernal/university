<?php

namespace app\models;

use app\libs\Connection;
use app\libs\Read;

class BaseDB
{
    use Connection, Read;
}