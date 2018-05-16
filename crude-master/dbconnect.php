<?php
// Trying out the MYSQLI API
// HARDCODE WARNING
$connection = mysqli_connect('localhost', 'crude_user', 'crude_user');
// $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (! $connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
// SAME USERID, PASSWD, DB
$select_db = mysqli_select_db($connection, 'crude_user');
if (! $select_db) {
    die("Database Selection Failed" . mysqli_error($connection));
}