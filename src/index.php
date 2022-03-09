<?php

require __DIR__ . '/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('query_log');
$log->pushHandler(new StreamHandler('logs/query.log', logger::DEBUG));

$myPDO = new PDO('sqlite:/home/bayardo/Documents/Databases/Module4.db');

$result = write_query($myPDO, "DELETE FROM courses", $log);

$result = write_query($myPDO, "insert into courses (name, author, create_date) values ('High Performance PHP', 'Jonathan Klein', '03/29/2016')", $log);
$result = write_query($myPDO, "insert into courses (name, author, create_date) values ('Composer: Getting Started', 'Jonathan Klein', '09/16/2016')", $log);
$result = write_query($myPDO, "insert into courses (name, author, create_date) values ('PHP: The Big Picture', 'Jonathan Klein', '09/14/2020')", $log);


$courses = read_query($myPDO, "select * from courses", $log);

foreach ($courses as $course) {
    print($course['name'] . '<br>');
}

function read_query($db_handle, $query, $logger)
{
    $result = $db_handle->query($query);
    $logger->info('Read query executed', ['query' => $query]);
    return $result;
}

function write_query($db_handle, $query, $logger)
{
    $result = $db_handle->query($query);
    $logger->notice('Write query executed', ['query' => $query]);
    return $result;
}
