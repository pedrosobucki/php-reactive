<?php

    $fileStreams = [
        fopen('files/file0.txt', 'rb'),
        fopen('files/file1.txt', 'rb'),
        fopen('files/file2.txt', 'rb'),
        fopen('files/file3.txt', 'rb'),
        fopen('files/file4.txt', 'rb')
    ];

    foreach ($fileStreams as $stream) {
        stream_set_blocking($stream, false);
    }

    while (!empty($fileStreams)) {

        $copiedStreams = $fileStreams;
        $readyStreamsCount = stream_select($copiedStreams,
            $write,
            $except,
            0,
            200000
        );

        if ($readyStreamsCount === 0) {
            continue;
        }

        foreach ($copiedStreams as $key => $stream) {
            echo fgets($stream) . PHP_EOL;
            unset($fileStreams[$key]);
        }

    }

    echo "Finished reading all files!" . PHP_EOL;

