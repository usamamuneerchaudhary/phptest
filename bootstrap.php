<?php

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Setting up DB connection
 */
$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "database" => "phptest",
    "username" => "root",
    "password" => "root"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
