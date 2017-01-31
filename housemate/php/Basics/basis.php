<html>
<head>
	<title>Hostel booking</title>
</head>
<body>

<center>
<h1>Courtesy of the dataloss recovery tool.</h1>

<p style="color:#3c0;">Hello Admin, This page was made to help you restore the database incase of data loss.</p>
</center>

<?php
	$con=mysqli_connect("localhost","root","mimi");

	if(mysqli_connect_errno()){
		echo"There was an error connectiong to the server.";
	}else{
	//this will create the default database
	$create_querry="CREATE DATABASE HouseMate";
	mysqli_query($con,$create_querry);
	//notify the admin
	echo "The database was created successifully!</br>";
	//next create the tables
			//but then now we need to be in the new database, thus we reset the value of $con to be in the new TransM DB.
			$con=mysqli_connect("localhost","root","mimi","HouseMate");

	//next create the users table
	$create_users="CREATE TABLE Users 
					(
					Email varchar(50) primary key,
					Password varchar(50) not null,
					Name  VarChar(50) not null,
					UType varchar(14) not null,
					PhoneNum integer not null,
					IdNum Integer not null,
					CurrentBooking Integer not null,
					NoOfHouses Integer not null,
					HsID Integer not null,
					ProfPic varchar(100) )
	";
	mysqli_query($con,$create_users);
	//when successful notify admin
	echo "The User's table was created successifully</br>";
	//next we will create the Landlords' waiting list table
	$create_WaitingLst="CREATE TABLE NewLandlords 
					(Email varchar(50) primary key,
					Name  VarChar(25) not null,
					Password varchar(50) not null,
					PhoneNum integer not null,
					UType varchar(14) not null)
	";
	mysqli_query($con,$create_WaitingLst);
	//Then report to the admin when done
	echo "The Waiting List for new landlords table created successifully!</br>";
	//next we will create the Houses table
	$Houses="CREATE TABLE Houses 
					(HouseNum varchar(50) not null,
					NoOfTenants  Integer not null,
					RentAmount FLOAT not null,
					Location varchar(50) not null,
					HouseId Integer primary key,
					pic varchar(100) not null,
					HouseNm varchar(50) not null,
					OwnerId varchar(50) not null
					)
	";
	mysqli_query($con,$Houses);
	//Then report to the admin when done
	echo "The Houses table created successifully!</br>";
	//next we will create the Bookings table
	$Houses="CREATE TABLE ApprBookings 
					(TransactId Integer primary key,
					HouseId Integer not null,
					TenName  VarChar(50) not null,
					TenEmail  VarChar(50) not null,
					LanEmail varchar(50) not null,
					LanName  VarChar(50) not null
					)
	";
	mysqli_query($con,$Houses);
	//Then report to the admin when done
	echo "The Approved transactions table created successifully!</br>";
	//next we will create the Bookings (unapproved) table
	$Houses="CREATE TABLE UnapprBookings 
					(TransactId Integer primary key,
					HouseId Integer not null,
					TenName  VarChar(50) not null,
					TenEmail  VarChar(50) not null,
					LanEmail varchar(50) not null,
					LanName  VarChar(50) not null
					)
	";
	mysqli_query($con,$Houses);
	//Then report to the admin when done
	echo "The Approved transactions table created successifully!</br>";
	echo "<h1>Well done!! </h1> your database is now created and configured correctly. 
	<a href='../../index.html'> back to login</a>";
	mysqli_close($con);

}
?>





</body>
</html>