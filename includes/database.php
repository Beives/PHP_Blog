<?php
$db['host'] = "localhost";
$db['user'] = "root";
$db['password'] = "";
$db['database'] = "php_blog";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$conn = mysqli_connect(HOST,USER,PASSWORD,DATABASE);