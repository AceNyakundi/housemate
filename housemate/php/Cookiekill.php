<?php 

//This is the shortest script to destroy cookie when logging out

		setcookie("Name","",time()-86400*30,"/","",0);
		setcookie("UType","",time()-86400*30,"/","",0);
		setcookie("Mail","",time()-86400*30,"/","",0);


?>