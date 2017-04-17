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

<div class="categoriesbox" style="padding-left: 20px; padding-top: 10px;">
<?php

$searchtype = $_GET['searchtype'];
if ($searchtype == 'category')
{
	$category_name = $_GET['category'];

	echo "<p style='font-weight:bold;'>Showing category : ".$category_name."</p>\n";
	echo "<hr>\n";

	$result = perform_query($conn, "SELECT * FROM entries WHERE category='".$category_name."'");

	if ($result->num_rows > 0)
	{

	while ($row = $result->fetch_assoc())
	{
		echo "<a style='color:black;' href='details.php?id=".$row['id']."'>".$row['name']."</a>\n";
		echo "<p>\n";
		echo $row['locality']."\n";
		echo "</p>\n";
		echo "<hr>\n";
	}

	}
	else
	{
		echo "<p style='font-weight:bold'>No items found</p>\n";
	}
}
else if ($searchtype == 'locality')
{
	$locality_name = $_GET['locality'];

	echo "<p style='font-weight:bold;'>Showing for locality : ".$locality_name."</p>\n";
	echo "<hr>\n";

	$result = perform_query($conn, "SELECT * FROM entries WHERE locality LIKE '%".$locality_name."%'");

	if ($result->num_rows > 0)
	{
	
	while ($row = $result->fetch_assoc())
	{
		echo "<a style='color:black;' href='details.php?id=".$row['id']."'>".$row['name']."</a>\n";
		echo "<p>\n";
		echo $row['locality']."\n";
		echo "</p>\n";
		echo "<hr>\n";
	}

	}
	else
	{
		echo "<p style='font-weight:bold'>No items found</p>\n";
	}

}
else if ($searchtype == 'term')
{
	$term_name = $_GET['term'];

	echo "<script>\n
	var tbox = document.getElementById('searchtextbox');\n
	tbox.value = '".$term_name."';\n
	</script>";

	$keywords = extractKeyWords($term_name, array('i','a','about','an','and','are','as','at','be','by','com','de','en','for','from','how','in','is','it','la','of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www','area','place'));
	
	echo "<p style='font-weight:bold;'>Showing for term : ".$term_name."</p>\n";
	echo "<hr>\n";

	$result = perform_query($conn, "SELECT * FROM entries WHERE MATCH(name) AGAINST('+".implode("+", $keywords)."') OR MATCH(locality) AGAINST('+".implode("+", $keywords)."')");

	if ($result->num_rows > 0)
	{
	
	while ($row = $result->fetch_assoc())
	{
		echo "<a style='color:black;' href='details.php?id=".$row['id']."'>".$row['name']."</a>\n";
		echo "<p>\n";
		echo $row['locality']."\n";
		echo "</p>\n";
		echo "<hr>\n";
	}

	}
	else
	{
		echo "<p style='font-weight:bold'>No items found</p>\n";
	}
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