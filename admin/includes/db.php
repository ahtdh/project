<?php
date_default_timezone_set('Asia/Tehran');

$link = mysqli_connect("localhost", "root", "", "parsiblog");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

mysqli_set_charset($link, 'UTF8');