<?php

$mysql_username = "doadmin";
$mysql_password = "fcmakbh4nfis1942";
$mysql_host = "db-mysql-jd-test-database-do-user-9579838-0.b.db.ondigitalocean.com";
$mysql_database = "defaultdb";
$mysqli_port = 25060;


$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database, $mysqli_port);

if (isset($_GET['text']) && isset($_GET["int"]))
{
    $test_text = mysqli_escape_string($db, $_GET['text']);
    $test_int = (int) $_GET['int'];
    

    $sql = "INSERT INTO test_table (test_text, test_int) VALUES ('$test_text', '$test_int')";

    $result = mysqli_query($db, $sql);

    $error = mysqli_error($db);

    if ($error != ""){
        echo "ERROR: $error";
    }
    else
    {
        echo "successfully inserted test_text: $test_text, test_int: $test_int";
    }
}
else
{
    echo "<br>text and id required<br>";
}
/*
$sql = "CREATE TABLE IF NOT EXISTS test_table(
            test_id SERIAL PRIMARY KEY,
            test_text VARCHAR(255),
            test_int INT
)";
*/


?>