<?php
define('MYSQL_SERVER', 'mdb');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'root');
define('MYSQL_DB', 'apps');
function db_connect()
{
    $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or die("Error: " . mysqli_error($link));
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error: " . mysqli_error($link));
    }
    return $link;
}
