<html>
<head>
<script type="text/javascript" src="../../java/main.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/layout.css">
<link rel="stylesheet" type="text/css" href="../../css/landlord.css">
	<title>Hostel Booking System</title>

<style type="text/css">
	table{
		background: #6B8E23;
		margin-top: 50px;
		border-radius: 5%;
	}
</style>
</head>
<body>
	<div id="DHead">
		<a href="./index.php"><img src="../../pics/components/logo.jpg" id="logo"></a>
	<div id="menu"></div>
	</div>

<a href="../../index.html">Logout</a>

<?php 
echo "Welcome back ".$_COOKIE["Name"];
//I first include a connection
require "../connection.php";

		$sqlst="SELECT * FROM `NewLandlords`";
		$rs=mysqli_query($conn,$sqlst);
		$rs2=mysqli_query($conn,$sqlst);
	$count=0;
	while(mysqli_fetch_array($rs,MYSQL_BOTH)){
		$count+=1;
	}

//Approve or reject request based on selection
if(isset($_GET['action'])&&isset($_GET['id'])&&isset($_GET['Pass'])&&isset($_GET['LName'])&&isset($_GET['Lphone']))
{
//udpate and reload
	$Pass=$_GET['Pass'];
	$LName=$_GET['LName'];
	$Lphone=$_GET['Lphone'];
	$action=$_GET['action'];
	$id=$_GET['id'];
	$type='Landlord';
	if($action==='approve'){
		//insert the data into legal landlords then we delete the member from the waiting list.
		$sqlst0="INSERT INTO `Users` (`Email`,`Password`,`Name`,`UType`,`PhoneNum`) VALUES ('$id','$Pass', 
		'$LName','$type','$Lphone')";
		$sqlst1="DELETE FROM `NewLandlords` WHERE `Email`='$id'";
		//querries
		//insert then delete from waiting list
		mysqli_query($conn,$sqlst0);		
		mysqli_query($conn,$sqlst1);
		header("location:index.php");
	}
}elseif(isset($_GET['action'])&&isset($_GET['id'])){
	$action=$_GET['action'];
	$id=$_GET['id'];
	//delete
	if ($action==='reject'){
		$query9="DELETE FROM `NewLandlords` WHERE `Email`='$id'";
		mysqli_query($conn,$query9);
		//delete member from waiting list
		/*echo "<script type='text/javascript'>
		var r=confirm('Are you sure you want to reject $id?'),x;
			if(r == true){
				".."
				x='OK. deleted';
			}else{
				x='$id was not deleted.';
			}
			alert(x);
		</script>";	*/
		header("location:index.php");	

	}
}


?>
<div id="newsfeed">


<!--Any funy staff should be in this newsfeed section -->

</div>


<div id="leftp" class="content" id="content1">
<center>
<table cellpadding="7" cellspacing="3">
	<tr><th colspan="6"> Currently <?php echo$count; ?> Landlord(s) awaiting approval </th></tr>
	<tr> <th><input type="checkbox" value="false" name="state0"></th> 
	 <th>Name</th> <th>Email</th> <th>Phone</th> <th>Reject</th> <th>Approve</th> </tr>
	<?php 
		
//I display it in a table
		while($Array0=mysqli_fetch_array($rs2,MYSQL_BOTH)){
			$Pass=$Array0['Password'];
			$LEmail=$Array0['Email'];
			$LName=$Array0['Name'];
			$Lphone=$Array0['PhoneNum'];
			echo "
			<tr> 
				<td><input type='checkbox' value='false' name='state[]'></td>
				<td>$LName</td>  <td>$LEmail</td> <td>$Lphone</td> 
				<td><a href='./index.php?action=reject&&id=$LEmail'> Reject</a></td> 
				<td><a href='./index.php?action=approve&&id=$LEmail&&Pass=$Pass&&LName=$LName&&Lphone=$Lphone'>Approve</a></td> 

			</tr>";
		}

	?>
	
</table>
</center>
</div>

<?php require "../footersign2.php"; ?>
</body>
</html>

