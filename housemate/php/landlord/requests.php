<html>
<head>
<script type="text/javascript" src="../../java/main.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/layout.css">
<link rel="stylesheet" type="text/css" href="../../css/landlord.css">
	<title>Hostel Booking System</title>
</head>
<body>
	<div id="DHead">
		<a href="#"><img src="../../pics/components/logo.jpg" id="logo"></a>
	<div id="menu"></div>
	<a href="index.php">Home</a>
	</div>

	<?php 
	require "../connection.php";

	$LId=$_COOKIE["Mail"];
	$sqlst2="SELECT * FROM UnapprBookings where LanEmail='".$LId."'";
	$resultset=mysqli_query($conn,$sqlst2);

	while($row=mysqli_fetch_array($resultset)){
		//collect specific data
			//$picha=$row["pic"];
			$LanID=$_COOKIE["Mail"];
			$LanName=$_COOKIE["Name"];
			$Tenant=$row["TenName"];
			$TenantID=$row["TenEmail"];
			$HsId=$row["HouseId"];
			$ID=$row["TransactId"];
		//Get the house details of the specific house
		$sql="SELECT * FROM Houses where HouseId=$HsId";
		$array=mysqli_fetch_array(mysqli_query($conn,$sql));
		$picha=$array["pic"];
		$hsnm=$array["HouseNm"];
			
			echo "<div id='mini'>
				<h1>$hsnm</h1>
				<img src='../../pics/houses/$picha'>
				<table>
				<tr> 
					<td>Transaction Id $ID</td> <td> Tenant: $Tenant</td>
				</tr>
				<tr><td><a href='#'> Approve </a></td> </tr>
			</div>";
	}

echo "</table>";

	?>


<?php require "../footersign2.php"; ?>
</body>
</html>