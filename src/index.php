<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/db.php';
require __DIR__ . '/courses.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('query_log');
$log->pushHandler(new StreamHandler('logs/query.log', logger::DEBUG));

$db = new DB($log);
$courses = new Courses($db);

$result = $courses->create_course('High Performance PHP', 'Jonathan Klein', '03/29/2016');
$result = $courses->create_course('Composer: Getting Started', 'Jonathan Klein', '09/16/2016');
$result = $courses->create_course('PHP: The Big Picture', 'Jonathan Klein', '09/14/2020');


$courses->show_courses();
