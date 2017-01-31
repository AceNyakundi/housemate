<html>
<head>
<script type="text/javascript" src="../../java/main.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/layout.css">
<link rel="stylesheet" type="text/css" href="../../css/tenant.css">
<style type="text/css">
	td>img{
		height:150px;
		width: 200px;
		border-radius: 5%;
	}
</style>
	<title>Hostel Booking System</title>
</head>
<body>
	<div id="DHead">
		<a href="index.php"><img src="../../pics/components/logo.jpg" id="logo"></a>
		<?php 
		echo "</br>Welcome on board Howdy ".$_COOKIE["Name"]." <br>|<a href='index.php'>home</a>";
		$tName=$_COOKIE["Name"];
		$tMail=$_COOKIE["Mail"];
		require "../connection.php";

		//collect data
		$sname=uncrack($_POST["nameSearch"]);
		$scost=uncrack($_POST["costSearch"]);
		?>||
		<a href="../../index.html">Logout</a>
		</div>

	<div id="menu"></div>
	</div>
	<?php
		require "news.php";
	?>
	<div id="leftp" class="content" id="content1">
	<?php 
		if (strlen($sname)!=0 || strlen($scost)!=0) {
			//user entered some data
			$sql0="SELECT * FROM `Houses` WHERE (`HouseNm` LIKE '%".$sname."%') OR (`Location` LIKE '%".$sname."%')";
			$query0=mysqli_query($conn,$sql0);
			$query1=mysqli_query($conn,$sql0);

			$array=mysqli_fetch_array($query0);

			if (count($array)==0) {
				//no such house exists in the database
				echo "There was no results found for this search on $sname.<br> <a href='./index.php'>Search again...</a>";
			}else{
				//we found some data. display it in a table
				echo "<div id='mini'>
				<table>
	<tr>
		<th colspan='8'> search results found</th>
	</tr>
	<tr>
		<th>Image</th><th>House Name</th><th>Location</th><th>Available rooms</th><th>Rent</th><th>Check out</th>
	</tr>";
	$count=0;
			
		while ($array2=mysqli_fetch_array($query1)) {
			$hname=$array2['HouseNm'];
			$loc=$array2['Location'];
			$rooms=$array2['NoOfTenants'];
			$rent=$array2['RentAmount'];
			$pic=$array2['pic'];
			$count+=1;
			echo "<tr>
				<td><img src='../../pics/houses/$pic'></td>
				<td>$hname</td>
				<td>$loc</td>
				<td>$rooms</td>
				<td>rent</td>
				<td><a href='#'> Request room</a></td>
			</tr>";
		}
	
		echo"</table></div></br> $count search results found that contain \"$sname\"";

	
			}
		}else{
			// The user entered nothing. Just return to home page
			header("location:index.php");
					
		}

		
	?>

	</div>


	<?php require "../footersign2.php"; ?>

</body>
</html>