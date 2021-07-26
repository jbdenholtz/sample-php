<?php
require __DIR__ . '/vendor/autoload.php';


echo "<h1>HELLO WORLD</>";

echo "<div style='font-size: 16px;'>";

echo "<br><a href='php_info.php' target='_blank'>PHP INFO</a><br>";


$mysql_username = "doadmin";
$mysql_password = "fcmakbh4nfis1942";
$mysql_host = "db-mysql-jd-test-database-do-user-9579838-0.b.db.ondigitalocean.com";
$mysql_database = "defaultdb";


$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database);


//$db = mysqli_connect("test", "test", "test", "test");

echo "<br><br>MYSQLI CONNECT - Using DO database<br>";

print_r($db);

$last_error = error_get_last();
echo "<br>MYSQLI ERROR:<br>";
print_r($last_error);

//-----------------------------------------------------------------------------    

echo "<br><br>STRIPE:<br>";
$stripe = new \Stripe\StripeClient('123');
print_r($stripe);

echo "<br><br>Email:<br>";
$email = new \SendGrid\Mail\Mail();
print_r($email);

echo "<br><br>MONGO EXTENSION LOADED:";
echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";


echo "<br><br>MONGO MANAGER:<br>";
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");    
print_r($manager);

echo "<br><br>MONGO QUERY:<br>";
$query = new MongoDB\Driver\Query(array('age' => 30));    
print_r($query);



echo "<br><br>MONGO CLIENT:<br>";
$client = new MongoDB\Client("mongodb://localhost:27017");    
print_r($client);







echo "</div>";

?>