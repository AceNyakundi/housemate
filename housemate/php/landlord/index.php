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
	</div>
<?php echo "Welcome back ".$_COOKIE["Name"];
require "../connection.php";

if (mysqli_connect_errno()) {
  echo "There was a problem connecting to the server. ";
}else{

$LId=$_COOKIE["Mail"];
$sqlst="SELECT * FROM Houses where OwnerId='".$LId."'";
$sqlst2="SELECT * FROM UnapprBookings where LanEmail='".$LId."'";

$rs=mysqli_query($conn,$sqlst);
$resultset=mysqli_query($conn,$sqlst2);
//count houses
$n=0;
while(mysqli_fetch_array($rs)){
	$n+=1;
}
echo "</br>You currently have <a href='#'> ".$n."</a> house(s) ";
//count number of current house booking requests
$num=0;
while(mysqli_fetch_array($resultset)){
	$num++;
}
echo "and <a href='requests.php'>".$num."</a> house booking request(s).";
}

?>
<br>
<a href="../../index.html">Logout</a>

</br></br></br>


<div id="leftp" class="content">
  <div id="newU">



	<form method="post" action="Newhouse.php" enctype="multipart/form-data" class="frm">
			<h1 id="fhead">Fill in the details below to add a new House</h1>
		Select Image: <input type="file" value="Select photo..." name="pic" class="subm">
		</br></br>	
		
			House Name: <input name="Hname" type="text" class="txt" id="nm" onkeyup="strip1('nm');"><span>*</span></br>
			House Number: <input name="Hnum" type="text" class="txt" id="num" onkeyup="strip2('num')";><span>*</span></br>
			Number of tenants: <input name="TNum" type="text" class="txt" id="num1" onkeyup="strip2('num1')"><span>*</span></br>
			Location: <input name="Loc" type="text" class="txt" id="loc" onkeyup="strip1('loc')"><span>*</span></br>
			Rent Amont: <input name="Amount" type="text" class="txt"id="num3" onkeyup="strip2('num3')"><span>*</span></br>
			<input type="submit" value="Add House" class="subm">		

	</form>

</div>
</div>
<?php require "../footersign2.php"; ?>
</body>
</html>
