
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="../java/main.js"></script>
<link rel="stylesheet" type="text/css" href="../css/layout.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>Hostel Booking System</title>
</head>
<body>
	<div id="DHead">
		<a href="#"><img src="../pics/components/logo.jpg" id="logo"></a>
	<div id="menu"></div>
	</div>
<?php
	//I will first kill existing cookies if they do exist.
		require"Cookiekill.php"; 

//Here I first establish a link to a database.
require "connection.php";

//collect the given data from the login formheader("location:index.php");
$Email=uncrack($_POST["email"]);
$passwd=uncrack($_POST["pass"]);

$outcome="";
//Check for connection error
if(mysqli_connect_errno()){
	echo "Sorry, we are having trouble to connect to the server database....";
}else{
	#$sqlst is a place holder for the long sql statement
	$sqlst="SELECT Name,Email,UType,Password FROM Users WHERE Email='".$Email."' AND Password='".$passwd."'";

	$outcome=mysqli_query($conn,$sqlst);
	$array=mysqli_fetch_array($outcome);

	if(count($array)!=0){
		
		//Setting cookies to identify the logged in person on the session which last for 7hours
		setcookie("Name",$array['Name'],time()+86400*29,"/","",0);
		setcookie("UType",$array['UType'],time()+86400*29,"/","",0);
		setcookie("Mail",$array['Email'],time()+86400*29,"/","",0);
		//This step below will verify the type of User to the System and redirect them to their appropriate Home pages
			echo"<h1> Hello ".$array["Name"]."!";
		if($array['UType']=="Landlord" ){
			echo"<h3><a href='landlord/index.php'>proceed to Landlord home-Page ?</a></h3>";
			//require "landlord/index.php";
		}elseif($array['UType']=="Tenant"){
			echo"<h3><a href='tenant/index.php'>proceed to your home-Page ?</a></h3>";
			//require "tenant/index.php";
		}elseif($array['UType']=="Admin"){
				echo " Nice to see you again!</br><a href='Admin/index.php'>proceed to Admin home...</a> ";
		}else{
			echo "However, Sorry ".$array['Name'].", there seem to be an issue with your account type.</br> 
			you lack access rights with your ticket. Please contact the System Admin about this.";
		}
	}else{
	echo "<h1> Sorry the User details input are invalid</h1></br></br> <a href='../index.html'> Go back...</a>";	
	}
		
	}
mysqli_close($conn);
#echo "Email was: ".$_POST["email"]." and your Password was: ".$_POST["pass"]; 
require "footersign.php";
?>
</body>
</html>
