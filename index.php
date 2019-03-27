<?php
require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/secret/php-tutorial-acb18-2508895cc8d3.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();
$database = $firebase->getDatabase();
