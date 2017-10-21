<?php

require_once "vendor/autoload.php";

use Env\Env;


$env = new Env();
echo $env->getEnv('DB_STRING');