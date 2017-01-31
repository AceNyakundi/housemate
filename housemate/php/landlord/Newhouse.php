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

<?php 
//connect to database 
require "../connection.php";

if (mysqli_connect_errno()) {
  echo "We experienced an rror connecting to the database ";
}else{
//to determine the current number of houses held by the landlord
$LId=$_COOKIE["Mail"];
//count houses
$sqlst="SELECT * FROM Houses"; $count=0;
	$rst=mysqli_query($conn,$sqlst);
	while(mysqli_fetch_array($rst)){
		$count++;
	}

 //for uploading files 
$LId=$_COOKIE["Mail"];
	
		$picName=$_FILES['pic']['name'];
			$type =$_FILES['pic']['type'];
			$picSize =$_FILES['pic']['size'];
			$extention=strtolower(substr($picName,strpos($picName,".")+1));
			//determine the temporary location 
			$tmpLoc=$_FILES['pic']['tmp_name'];
		//pics/<?php $newNm>
			if(isset($picName)){
				//check if the selected file name is not null
				if(!empty($picName)){
					//next validate the image type
					if ($type=="image/gif" || $type=="image/jpeg" || $type=="image/jpg" || $type=="image/png") {
						//Next I will validate the image size to appx 3mb
						if ($picSize <= 3000000) {
						$newNm=substr($LId,0,strpos($LId,"@"))."_".$count.".".$extention;
						$loc="../../pics/houses/";
						if(move_uploaded_file($tmpLoc, $loc.$newNm)){
							//disciplay the image.
							echo "<img src='../../pics/houses/$newNm' style='margin:50px;height:200;width:200;border-radius:5%;border:3px solid #f60;'>";
						}else{echo "Error uploading your file.. ";}
				}
				else{echo "The system only allows image files up to 3mb";}
			}
			else{echo "The Selected file format is not accepted";}
			} else{
					echo "You have not yet chosen a photo";
				}
			}
		
//collect data from Page

	$Hsnum=uncrack($_POST["Hnum"]);
	$Hsname=uncrack($_POST["Hname"]);
	$NoOfTenants=uncrack($_POST["TNum"]);
	$location=uncrack($_POST["Loc"]);
	$Rent=uncrack($_POST["Amount"]);
	$pcnm=$newNm;
	$date=date('y-m-d');
	//determine the current number of registered houses to know the new house Id
	
	//now set house Id.
	$houseID=$count;
	//now I update the database
	$sqlst="INSERT INTO Houses (HouseNum,NoOfTenants,RentAmount,Location,HouseId,pic,Housenm,OwnerId,`Date`)
				VALUES('$Hsnum','$NoOfTenants','$Rent','$location','$houseID','$pcnm','$Hsname','$LId','$date')";
	if(!mysqli_query($conn,$sqlst)){
			die("<h3>The System fell to register the new House.
				</br> If this problem persists, please contact the system Administrators.
				</br></br></span><a href='index.php'> Go Back...</a></h3>");
		}else{
		echo "<h1><p>Congratulation ".$_COOKIE["Name"]."!</br></h1>
		You have successifuly registered the new House <a href='#hs'>$Hsname.</a> under index $houseID
		</br> <a href='index.php'>Back to home-page..</a>

		<div name='hs'> 
		<a name='hs'><h1> The new house Details</span></h1></a>
		House Name : <span>$Hsname</span></br>
		House Number : <span>$Hsnum</span></br>
		Number of Tenants : <span>$NoOfTenants</span></br>
		House Location : <span>$location</span></br>
		On Date : <span>$date</span></br>
		House Index : <span>$houseID</span></br>
		</div>

		</p>";
	}

//mysqli_query($conn,$sqlst);
mysqli_close($conn);
}
require "../footersign2.php"
?>
</body>
</html>