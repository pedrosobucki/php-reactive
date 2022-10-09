<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\ResponseInterface;

const SERVER_PORT_8000 = "http://localhost:8000/http-server.php";
const SERVER_PORT_8080 = "http://localhost:8080/http-server.php";

$client = new Client();

$promise1 = $client->getAsync(SERVER_PORT_8000);
$promise2 = $client->getAsync(SERVER_PORT_8080);

try {
    /** @var ResponseInterface[] $responses */
    $responses = Utils::unwrap([
        $promise1, $promise2
    ]);
} catch (Throwable $e) {
    echo $e->getMessage();
}

echo 'Response 1: '. $responses[0]->getBody()->getContents();
echo 'Response 2: '. $responses[1]->getBody()->getContents();