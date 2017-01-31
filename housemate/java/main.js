//will be used for validation and verification

//a simple function to hide elements
	function hide(x){
		document.getElementById(x).style.display="none";
	};
//another one to unhide them
	function unhide(x){
		document.getElementById(x).style.display="inline-block";
	};

	//strip unwantedspecial characters
function strip1(e) {
		var Textf=document.getElementById(e);
		var repl= /[^a-z 0-9]/gi;
		Textf.value=Textf.value.replace(repl,"");	
		};
//strip letters and special characters.
function strip2(e) {
		var Textf=document.getElementById(e);
		var repl= /[^0-9]/gi;
		Textf.value=Textf.value.replace(repl,"");	
		};
		//strip letters and special characters in an email.
function strip3(e) {
		var Textf=document.getElementById(e);
		var repl= /[^0-9a-z.@_]/gi;
		Textf.value=Textf.value.replace(repl,"");	
		};
//function to verify email entered
function VerifyE(n,n1){
		var email=document.getElementById(n).value;
		var t=email.indexOf('@');
		var m= email.indexOf('.');
		if(email.length==0){
			document.getElementById(n1).style.color="red";
			document.getElementById(n1).innerHTML="";
		}else if(email.length>0 &&(t==0 || m==0)){
			document.getElementById(n1).style.color="red";
			document.getElementById(n1).innerHTML="poor";
		}else if(email.length>0 && t>0 && m>0){
			document.getElementById(n1).style.color="#6f0";
			document.getElementById(n1).innerHTML="Good!";
		}else{
			document.getElementById(n1).style.color="red";
			document.getElementById(n1).innerHTML="poor..";
		}
		}
//confirm the password is more than 6 characters
function checker(x,x1,x2){
	var passwd=document.getElementById(x).value;
	var pass2=document.getElementById(x1).value;
	if (passwd.length==0) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
	else if (passwd.length <=6) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="poor";
	}else if(passwd.length>6 && pass2.length<6){
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="Good!";
	} else if(passwd.length>6 && pass2.length>6 && (passwd !== pass2)){
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="passwords mismatch";
	}else if(passwd.length>6 && pass2.length>6 && (passwd === pass2)){
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="Great!";
	}else{
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
}
