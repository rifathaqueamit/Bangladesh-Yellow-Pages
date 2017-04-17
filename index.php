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
<input id="searchtextbox" type="text" style="margin-left: 25px; width: 500px; height: 40px; font-size: 15pt;float: left;"/>
<button class="buttonstyle2" style="height: 40px;font-weight: bolder;" onclick="search()">Find</button>
<p style="clear: left;margin-left: 25px; padding-top: 5px;">Such as KFC in Dhaka, restaurants at Chittagong</p>
</div>

<div class="categoriesbox">
<p style="font-size: 15pt; font-weight: bold; margin-left: 15px;">Top Categories</p>
<hr>

<?php

$result = perform_query($conn, "SELECT * FROM categories");
if ($result->num_rows > 0)
{
	echo '<table class="tablestyle1">'."\n";
	$id = 0;
	$first_tr = 0;

	while ($row = $result->fetch_assoc())
	{
		if ($id % 4 == 0)
		{
			if ($first_tr == 0)
			{
				$first_tr = 1;
			}
			else
			{
				echo "</tr>\n";
			}

			echo '<col width="200px" />'."\n";
			echo "<tr>\n";

			echo '<td class="tableitemstyle1"><a href="search.php?searchtype=category&category='.urlencode($row["name"]). '" style="text-decoration: none; color:black;">'.$row["name"]."<br>".$row["count"]." items</a></td>\n";
		}
		else
		{
			echo '<td class="tableitemstyle1"><a href="search.php?searchtype=category&category='.urlencode($row["name"]). '" style="text-decoration: none; color:black;">'.$row["name"]."<br>".$row["count"]." items</a></td>\n";
		}
		$id++;
	}
	echo "</tr>\n";
	echo "</table>\n";
}

?>

<hr style="clear: left;">
</div>

<div class="categoriesbox">
<p style="font-size: 15pt; font-weight: bold; margin-left: 15px;">Top Localities</p>
<hr>

<?php

$result = perform_query($conn, "SELECT * FROM localities");
if ($result->num_rows > 0)
{
	echo '<table class="tablestyle1">'."\n";
	$id = 0;
	$first_tr = 0;

	while ($row = $result->fetch_assoc())
	{
		if ($id % 3 == 0)
		{
			if ($first_tr == 0)
			{
				$first_tr = 1;
			}
			else
			{
				echo "</tr>\n";
			}

			echo '<col width="200px" />'."\n";
			echo "<tr>\n";

			echo '<td class="tableitemstyle1"><a href="search.php?searchtype=locality&locality='.urlencode($row["name"]). '" style="text-decoration: none; color:black;">'.$row["name"]."<br>".$row["count"]." items</a></td>\n";
		}
		else
		{
			echo '<td class="tableitemstyle1"><a href="search.php?searchtype=locality&locality='.urlencode($row["name"]). '" style="text-decoration: none; color:black;">'.$row["name"]."<br>".$row["count"]." items</a></td>\n";
		}
		$id++;
	}
	echo "</tr>\n";
	echo "</table>\n";
}

?>

<hr>
</div>

<?php
	if ($conn)
	{
		mysqli_close($conn);
	}
?>

</body>
</html>