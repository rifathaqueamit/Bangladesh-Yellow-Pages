<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
	die("Connection failed to mysql");
}
else
{

}

?>
