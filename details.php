<html>
<head>
	<title>Bangladesh Yellow Pages</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<?php 
		require 'connection.php';
		require 'utility.php';
	?>

	<script type="text/javascript">
		function search()
		{
			var tbox = document.getElementById("searchtextbox");
			if (tbox.value != ""){
				window.location = "search.php?searchtype=term&term=" + tbox.value;
			}
		}
	</script>

</head>
<body style="padding-bottom: 500px;">

<div class="header">
<p style="padding-left: 5px; margin-top: 5px; float: left; margin-bottom: 0px;">
Welcome to Bangladesh Yellow Pages
</p>
<button value="LOGIN" class="buttonstyle1">LOGIN</button>
</div>

<div class="titlebox">
<a href="index.php"><img src="byplogo.png" style="width: 115px;float: left;" /></a>
<p style="float: left; margin-left: 20px; margin-top: 45px; font-size: 24pt; font-weight: bold;">Bangladesh Yellow Pages</p>
</div>

<div class="tabbox">
<button class="buttonstyle2" onclick="window.location='index.php'">Home</button>
<button class="buttonstyle2">Category</button>
<button class="buttonstyle2">Add Your Location</button>
<button class="buttonstyle2">Contact</button>
</div>

<div class="searchbox">
<p style="margin-top: 0px; margin-left: 25px; padding-top: 15px; font-weight: bold;">Enter place name or business name to search</p>
<input id="searchtextbox" type="text" style="margin-left: 25px; width: 500px; height: 40px; font-size: 15pt;float: left;" />
<button class="buttonstyle2" style="height: 40px;font-weight: bolder;" onclick="search()">Find</button>
<p style="clear: left;margin-left: 25px; padding-top: 5px;">Such as KFC in Dhaka, restaurants at Chittagong</p>
</div>

<div class="categoriesbox">

<?php

$detail_id = $_GET['id'];
$result = perform_query($conn, "SELECT * FROM entries WHERE id='".$detail_id."' LIMIT 1");

if ($result->num_rows > 0)
{
	$row = $result->fetch_assoc();

	echo "<p style='font-weight:bold;'>".$row['name']."</p>\n";
	echo "<p>Category : ".$row['category']."</p>\n";
	echo "<hr>\n";
	echo "<p style='font-weight:bold'>Description</p>\n";
	echo $row['description'];
	echo "<hr>\n";
	echo "<p style='font-weight:bold'>Place</p>\n";
	echo $row['locality'];
	echo "<hr>\n";
	echo "<p style='font-weight:bold'>Rating</p>\n";
	echo $row['rating'];
}
else
{
	echo "<p style='font-weight:bold'>Id not available</p>\n";
}	

?>

</div>

<?php
	if ($conn)
	{
		mysqli_close($conn);
	}
?>

</body>
</html>