<?php

$mysql_username = "doadmin";
$mysql_password = "fcmakbh4nfis1942";
$mysql_host = "db-mysql-jd-test-database-do-user-9579838-0.b.db.ondigitalocean.com";
$mysql_database = "defaultdb";
$mysqli_port = 25060;


$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database, $mysqli_port);

$sql = "CREATE TABLE IF NOT EXISTS test_table(
            test_id SERIAL PRIMARY KEY,
            test_text VARCHAR(255),
            test_int INT
)";

$result = mysqli_query($db, $sql);

$error = mysqli_error($db);

if ($error != ""){
    echo "ERROR: $error";
}
else
{
    echo "SUCCESS!";
}

?>