
<!--
This page will display houses in a news-like scroll.
However do not (NEVER) include this file in a page before you require a connection.
It cannot work independently
-->

<div id="newsfeed">
	<h3>House updates</h3>
	<center>
	<marquee scrolldelay="300" onmouseenter="this.setAttribute('scrolldelay',30000);" onmouseleave="this.setAttribute('scrolldelay',300);" direction="up" id="show" style="height:350px;">
	<?php
	$sqlst0="SELECT * FROM Houses";
	$rs0=mysqli_query($conn,$sqlst0);

		while($row=mysqli_fetch_array($rs0)){
			$picha=$row["pic"];
			$jina=$row["HouseNm"];
			$pesa=$row["RentAmount"];
			$loc=$row["Location"];
			$HsId=$row["HouseId"];
			$noOfTenants=$row["NoOfTenants"];
			$Ownid=$row["OwnerId"];
			//determine owner name
			$sqlst4="SELECT * FROM Users where Email='".$Ownid."'";
			$rs4=mysqli_query($conn,$sqlst4);
			$Array4=mysqli_fetch_array($rs4);//now I got the name
			$LanName=$Array4["Name"];
			echo "<div id='mini'>
				<br>$LanName added a house.<br>
				<a href='#$HsId'><img src='../../pics/houses/$picha'></a></br>
				<a href='#$HsId'>$jina </a></br>Rent: Sh. $pesa </br>
				Location: $loc
			</div>";
		};
?>
	</marquee>
	</center>
	</div>