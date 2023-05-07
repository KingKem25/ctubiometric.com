<?php 
session_start();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<header>
<div class="header">
	<div class="logo">
		<a href="index.php" style= "font-family: Poppins"><img src="ctulogo.png" style="margin-left: 100px"></img>Fingerprint Attendance System</a>
	</div>
</div>

<div class="topnav" id="myTopnav" style= "font-family: Poppins">
	<a href="index.php">Users</a>
    <a href="UsersLog.php">Users Log</a>
    <a href="ManageUsers.php">Manage Users</a>
	<a href="Show.php">Show Certificates</a>
	<a style="float:right;" href="certificate.php" target="_self">Create Certificate</a>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
	  <i class="fa fa-bars"></i></a>
</div>
</header>
<script>
	function navFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	}
</script>


	

	
