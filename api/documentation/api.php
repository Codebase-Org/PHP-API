<?php
require("../../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/models/']);

header('Content-Type: application/json');
echo $openapi->toJSON();

