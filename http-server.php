<?php

$waitTime = rand(1, 5);
sleep($waitTime);

echo "Server response took $waitTime seconds!" . PHP_EOL;