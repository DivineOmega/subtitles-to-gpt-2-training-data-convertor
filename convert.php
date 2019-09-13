<?php

$lines = [];

$files = glob(__DIR__.'/*.srt');

foreach ($files as $file) {
    $fileLines = file($file);
    $lines[] = '<|startoftext|>';
    foreach ($fileLines as $fileLine) {
        $fileLine = trim($fileLine);
        if (stripos($fileLine, ' --> ') !== false) {
            continue;
        }
        if (is_numeric($fileLine)) {
            continue;
        }
        if (!$fileLine) {
            continue;
        }
        $lines[] = $fileLine;
    }
    $lines[] = '<|endoftext|>';
}

$output = '';

foreach($lines as $line) {
    $output .= $line;
    $output .= PHP_EOL;
}

file_put_contents(__DIR__.'/training_data.txt', $output);
