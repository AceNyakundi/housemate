
<?php
//this will be adjusted incase the server settings change
$conn=mysqli_connect("localhost","root","mimi","HouseMate");

if( mysqli_connect_errno()){
	echo "There was a fatal error when connecting to the database.";
	echo "If it is your very first time to run the system.<a href='Basics/basis.php'> Click here</a>";
}
//this will counter SQL injection

function uncrack($data){
		$data=trim($data);
		$data= htmlspecialchars($data);
		$data=stripcslashes($data);
		return $data;
	};
	
?>