<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="../java/main.js"></script>
<link rel="stylesheet" type="text/css" href="../css/layout.css">

	<title>Hostel Booking System</title>
</head>
<body>
	<div id="DHead">
		<a href="#"><img src="../pics/components/logo.jpg" id="logo"></a>
	<div id="menu"></div>
	</div>

<?php
//first I will require a connection
	require "connection.php";
//collect data from Form
	$Name=uncrack($_POST["name"]);
	$Email=uncrack($_POST["email"]);
	$PhnNum=uncrack($_POST["phn"]);
	$pass=uncrack($_POST["pass"]);
	$pass1=uncrack($_POST["pass1"]);
	$type="Landlord";

//then I check for connection error 
	if (mysqli_connect_error()) {
		echo "Sorry, there was a connection error to the Database";
	}else{
#$sqlst is a place holder for the long sql statement
	$sqlst="SELECT * FROM Users WHERE Email='".$Email."'";
	$sqlst1="SELECT * FROM NewLandlords WHERE Email='".$Email."'";

	$testA=mysqli_query($conn,$sqlst);
	$testB=mysqli_query($conn,$sqlst1);

	$Test_Array=mysqli_fetch_array($testA);
	$Array2=mysqli_fetch_array($testB);

	//If the Array returns a value, then it means the user exists
	if(count($Test_Array)==0 || count($Array2)==0){
//let us first confirm that the user entered data into the form
		if (strlen($Name)==0 || strlen($Email)==0 || strlen($PhnNum)==0 || strlen($pass1)==0 || strlen($pass)==0) {
			//it could mean that the user neglected some field.

			echo "<span><h3>It seems that You proberbly missed to enter some required fields.</br></br></span>
	 		<a href='../index.html'> Go Back to correct...</a></h3>";
		}
		else{
			//the user entered all fields.
			//now confirm that the passwords match and that they are greater than 6 letters.
		if($pass==$pass1 && strlen($pass1)>6){
			//password match. thus register the user
		$sqlstm="INSERT INTO NewLandlords (Name,PhoneNum,Email,Password,UType) 
		VALUES('$Name','$PhnNum','$Email','$pass1','$type')";
		if(!mysqli_query($conn,$sqlstm)){
			die("<h3>system noted a few difficulties during registration</br> It could mean that your details already exist.
				</br> If this problem persist, please contact the system Administrators.
				</br></br></span><a href='../index.html'> Go Back...</a></h3>");
		}else{

		echo "<p>Thanks alot $Name for registering with us. your Account awaiting approval.</br>
		</br> <a href='../index.html'>Back to Login..</a>
		</p>";}
	}else{
		echo "<span><h3>The passwords do not match or they are less
		 than the required password size of 7 charachters</br></br></span>
	 		<a href='../index.html'> Go Back to correct...</a></h3>";
	}
	}}else{
			echo "<span><h3>It seems that the User already exists. or Awaits Approval by our Administrators</br></br></span>
	 		<a href='../index.html'> Go Back...</a></h3>";
	}

}
mysqli_close($conn);
?> 
<?php require "footersign.php";?>
</body>
</html>