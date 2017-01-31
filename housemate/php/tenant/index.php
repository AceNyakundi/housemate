<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="../../java/main.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/layout.css">
<link rel="stylesheet" type="text/css" href="../../css/tenant.css">
	<title>Hostel Booking System</title>
</head>
<body>
	<div id="DHead">
		<a href="#"><img src="../../pics/components/logo.jpg" id="logo"></a>
		<?php echo "</br>Welcome on board Howdy ".$_COOKIE["Name"]."";
		$tName=$_COOKIE["Name"];
		$tMail=$_COOKIE["Mail"];
		require "../connection.php";
		$sqlst="SELECT * FROM Houses";
		$rs=mysqli_query($conn,$sqlst);
		$rs2=mysqli_query($conn,$sqlst);

//check if user has reqested to book a house. if isset returns true then book the house & update the database

		if(isset($_GET['action'])&&isset($_GET['hsid'])&&isset($_GET['lanID'])&&isset($_GET['LanName'])){
			//then the tenant reqested for a house. just udpate and reload the page.
			//here I collect the data 

			$Aid=uncrack($_GET['hsid']);
			$OwnerID=uncrack($_GET['lanID']);
			$LanName=uncrack($_GET['LanName']);
			$action=uncrack($_GET['action']);

			//this is true if he clicked the "request house" link
			if ($action==='request') {
				#run a querry to update

				//check if user has already submitted request
				$sq0="SELECT TenEmail,HouseId FROM UnapprBookings WHERE TenEmail='".$tMail."' AND HouseId='".$Aid."'";
				$aa=mysqli_query($conn,$sq0);
				$Arr=mysqli_fetch_array($aa);

				/*this if statement below evaluates true only if tenant has already made a house booking request similar to present request
				 request */
				if (count($arr)!=0){
					echo "<script type=\"text/javascript\"> 
				alert('You have already submitted this request. Just wait for a notification from $LanName soon.'); </script>";
				header("location:index.php");
		}else{
				$sqlstreq="INSERT INTO `UnapprBookings` (`HouseId`,`TenName`,`TenEmail`,`LanEmail`,`LanName`) values('$Aid','$tName','$tMail','$OwnerID','$LanName')";

		if (mysqli_query($conn,$sqlstreq)){
			//reload page 
			header("location:index.php");

		echo"<script type=\"text/javascript\"> 
				alert('Congratulation $tName! your booking request was successiful. We will notify Landlord $LanName about it.'); </script>";
		
			}else{
				die("System fell to submit your reuqest");
			}
			
	}
	}
}



		?><br>|<a href="../../index.html">Logout</a>|| <a href="#" onclick="unhide('search');">Search</a>
	<div id="menu"></div>
	</div>
	<?php
		require "news.php";
	?>

	<div id="leftp" class="content" id="content1">
	<div id="search">
	<a name="search"></a>
	<form method="post" action="./search.php">
	Search House by:</br>
	Name or Location:</br>
	</br> <input name="nameSearch" placeholder="I want house (name)..." type="text"></br>
	Cost (max):</br>
	</br> <input name="costSearch" id="num" placeholder="I am willing to pay at most..." onkeyup="strip2('num');" type="text"></br>
     
	</br><input name="Search" type="submit" value="Search" onclick="hide('search');">
	</form>


	</div>
	</div>
	<div id="reserver">
	<h3>View Houses List</h3>
	<?php

			while($row=mysqli_fetch_array($rs2)){
			$picha=$row["pic"];
			$jina=$row["HouseNm"];
			$pesa=$row["RentAmount"];
			$loc=$row["Location"];
			$noOfTenants=$row["NoOfTenants"];
			$HsId=$row["HouseId"];
			$OwnerID=$row["OwnerId"];
			//determine the owner's name
			$sqlst4="SELECT * FROM Users where Email='".$OwnerID."'";
			$rs4=mysqli_query($conn,$sqlst4);
			$Array4=mysqli_fetch_array($rs4);//now I got the name
			$LanName=$Array4["Name"];
			//to determine the transaction Id, I will first count the current number of unapproved bookings then increment it by 1.
			$sqlst3="SELECT * FROM UnapprBookings";
			$rs3=mysqli_query($conn,$sqlst3); 
			$Array3=mysqli_fetch_array($rs3);
			$count=1;
			while(mysqli_fetch_array($rs3)){
				$count+=1;
			}
			$transId=$count+1;//return the Transaction Id.

			
			echo "<div class='main1'>
			<br>
				<a name='$HsId'><img src='../../pics/houses/$picha'></a></br>
				$jina </br>
				Rent: Sh. $pesa </br>
				Location: $loc <br/>
				Currently $noOfTenants  vaccant rooms remaining<br>
			</div>";
		echo "<a href='./index.php?action=request&&hsid=$HsId&&lanID=$OwnerID&&LanName=$LanName' class='common'>request this house... </a><br>";
		};

		
	//mysql_close($conn);

	?>
	</div>
	<?php require "../footersign2.php"; ?>
	</body>
	</html>