<?php

use Ramsey\Uuid\Uuid;

require("vendor/autoload.php");

$uuid = Uuid::uuid4();

var_dump($uuid);
var_dump(get_class_methods($uuid));