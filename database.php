<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "registrasi";

$db = mysqli_connect($host, $user, $password, $dbname);

if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

function query($query)
{
    global $db;

    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($db));
    }

    return $result;
}

function fetch_assoc($result)
{
    return mysqli_fetch_assoc($result);
}

function close()
{
    global $db;

    mysqli_close($db);
}
