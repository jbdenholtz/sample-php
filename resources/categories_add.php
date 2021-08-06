<?php
//include('../env_root.php');
//include($GLOBALS['root_dir'] .'/resources/global_includes.php');


$mysql_username = "mustacheo";
$mysql_password = "yw7k331yrxhrxbb7";
$mysql_host = "brasstaxes-expenses-do-user-9579838-0.b.db.ondigitalocean.com";
$mysql_database = "brasstaxes-expenses";
$mysqli_port = 25060;

$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database, $mysqli_port);
$GLOBALS['db'] = $db;

$file = fopen('data_files/brasstaxes_expense_categories.csv', "r");
$data = fgetcsv($file, 1000, ",");


$sql = "INSERT INTO expenses_bt_category_ids (irs_category_id, irs_category_name) VALUES ('-1', Uncategorized)";
while (($data = fgetcsv($file)) !== FALSE) 
{
    //echo "<br>";
    //var_dump($data);
    $id = (int) $data[0];
    if ($id < 100 && $id > 0)
    {            
        $name = mysqli_escape_string($GLOBALS['db'], $data[1]);        
        $sql .= ", ('$id', '$name')";
    }
}
echo "<br>$sql";

fclose($file);

$file = fopen('data_files/brasstaxes_expense_tracker_categories.csv', "r");
$sql = "INSERT INTO expenses_plaid_categories (plaid_category_id, top_level_plaid_category_name, plaid_category_name, irs_category_id, irs_category_name, flags, notes) VALUES ";

$data_array = [];

while (($data = fgetcsv($file)) !== FALSE) 
{
    array_push($data_array, $data);
}

for ($i=1; $i<count($data_array); $i++)
{
    $plaid_category_id = (int) $data_array[$i][0];
    $top_level_plaid_category_name = mysqli_escape_string($GLOBALS['db'], $data_array[$i][1]);
    $plaid_category_name = mysqli_escape_string($GLOBALS['db'],$data_array[$i][2]);
    $irs_category_id = (int) $data_array[$i][3];
    $irs_category_name = mysqli_escape_string($GLOBALS['db'], $data_array[$i][4]);
    $flags = mysqli_escape_string($GLOBALS['db'], $data_array[$i][5]);
    $notes= mysqli_escape_string($GLOBALS['db'], $data_array[$i][6]);
    $sql .= "('$plaid_category_id', '$top_level_plaid_category_name', '$plaid_category_name', '$irs_category_id', '$irs_category_name', '$flags', '$notes')";

    if($i < count($data_array) -1 ){
        $sql .= ", ";
    }
}
echo "<br><br>$sql";


?>