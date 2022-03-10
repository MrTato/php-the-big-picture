<?php
require __DIR__ . '/../vendor/autoload.php';

$global_start = microtime(true);

$client = new GuzzleHttp\Client();
request_endpoint($client, 'https://jsonplaceholder.typicode.com/todos/1');
request_endpoint($client, 'https://jsonplaceholder.typicode.com/todos/2');
request_endpoint($client, 'https://jsonplaceholder.typicode.com/todos/3');

$global_end = microtime(true);

echo "Full page loaded in: " . round($global_end - $global_start) . " seconds";

function request_endpoint($client, $url) {
    echo "Requesting URL: $url...</br>";
    $start = microtime(true);
    $response = $client->request('GET', $url);
    $end = microtime(true);

    echo $response->getBody();
    echo "</br>Request completed in: " . round($end - $start, 2) . "seconds</br></br>";
}