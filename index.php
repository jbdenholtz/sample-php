<?php
require __DIR__ . '/vendor/autoload.php';


echo "<h1>HELLO WORLD</>";

echo "<div style='font-size: 16px;'>";

echo "<br><a href='php_info.php' target='_blank'>PHP INFO</a><br>";

echo "<br>ENV VARS<br>";
print_r(getenv());


$mysql_username = "doadmin";
$mysql_password = "fcmakbh4nfis1942";
$mysql_host = "db-mysql-jd-test-database-do-user-9579838-0.b.db.ondigitalocean.com";
$mysql_database = "defaultdb";
$mysqli_port = 25060;


$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database, $mysqli_port);

echo "<br><br>MYSQLI CONNECT - Using DO database<br>";

print_r($db);

$sql = "SELECT * FROM test_table";

$result = mysqli_query($db, $sql);        

$error = mysqli_error($db);

echo "<br><br>MYSQL TEST SELECT<br>";

if ($error != "")
{
	echo "ERROR: $error";
}
else
{
	$test_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

	for ($i = 0; $i<count($test_data); $i++)
	{
		echo "<br>";
		print_r($test_data[$i]);
		echo "<br>";
	}	
}




//$db = mysqli_connect("test", "test", "test", "test");



//$last_error = error_get_last();
//echo "<br>MYSQLI ERROR:<br>";
//print_r($last_error);

//-----------------------------------------------------------------------------    

echo "<br><br>STRIPE:<br>";
$stripe = new \Stripe\StripeClient('123');
print_r($stripe);

echo "<br><br>Email:<br>";
$email = new \SendGrid\Mail\Mail();
print_r($email);

$mongo_username = "doadmin";
$mongo_password = "278j5Ns41Gmoc6z0";
$mongo_host = "mongodb+srv://db-mongodb-jd-test-database-5c36efbd.mongo.ondigitalocean.com";
$mongo_port = 27017;
$mongo_database = "admin";


echo "<br><br>MONGO MANAGER:<br>";
//$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");    
$manager = new MongoDB\Driver\Manager($mongo_host);
print_r($manager);

echo "<br><br>MONGO QUERY:<br>";
$query = new MongoDB\Driver\Query(array('age' => 30));    
print_r($query);

echo "</div>";

?>