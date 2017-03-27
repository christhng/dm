<link rel="stylesheet" href="w3.css">

<!DOCTYPE html>
<html>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover{background-color:#f5f5f5}
</style>

<title>Find My Bus Results</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="findmybus.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>Find My Bus</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="findmybus.html" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a> 
    <a href="findmybus.html#svcinfo" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Service Information</a> 
    <a href="findmybus.html#tripinfo" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Trip Information</a> 
    <a href="findmybus.html#searchbystop" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Search by Stop</a> 
    <a href="findmybus.html#driveravail" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Driver Availability</a> 
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Company Name</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
  <div class="w3-container" style="margin-top:80px" id="svcinfo">
    <h1 class="w3-jumbo"><b>Find My Bus: Reporting System</b></h1>
    <h1 class="w3-xxxlarge w3-text-red"><b>Driver Availability</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  
  <!-- Service Information -->
  <div class="w3-row-padding">
</p>
<?php

$conn = mysqli_connect('localhost','root','','findmybus');

if (!$conn) { 
   print "Error occured while connecting".mysqli_connect_error($conn);
}  

$query = "select staffID as 'Staff ID', nric as 'NRIC', drivername as 'Driver Name', licensenumber as 'License Number'
  from driver 
  where staffID not in 
  	(select staffID
  	from driver_offdays
  	where offday = ?) 
  order by drivername, staffid";
              
$stmt = mysqli_prepare($conn, $query);
$DayofWeek = $_POST['DayofWeek'];  
mysqli_stmt_bind_param($stmt, 'i', $DayofWeek);
                      
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $staffID_r, $nric_r, $drivername_r, $licensenumber_r); 

if 
	($DayofWeek ==1)
	{
	$Day = "Monday";
	}
	else if
	($DayofWeek ==2)
	{
		$Day = "Tuesday";
	}
	else if 
	($DayofWeek ==3)
	{
		$Day = "Wednesday";
	}
	else if		
	($DayofWeek ==4)
	{
		$Day = "Thursday";
	}
	else if
	($DayofWeek ==5)
	{
		$Day = "Friday";
	}
	else if	
	($DayofWeek ==6)
	{
		$Day = "Saturday";
	}
	else if
	($DayofWeek ==7)
	{
		$Day = "Sunday";
	}
print "<p>";
print "Your current search is based on: ";
print "<b>";
print "$Day";
print "</b>";
print ".";
print "</p>";
  
       
print "<table>";
  print "<th>";
    print "Staff ID";
  print "</th>";

  print "<th>";
    print "NRIC";
  print"</th>";

  print "<th>";
    print "Driver Name";
  print"</th>";

  print "<th>";
    print "License Number";
  print"</th>";

while (mysqli_stmt_fetch($stmt)) {
	print "<tr>";
		print"<td>";
	    print "$staffID_r";
		print "</td>";              
		print "<td>";
		  print "$nric_r";
		print"</td>";
		print"<td>";
		  print "$drivername_r";
		print"</td>";
		print"<td>";
		  print "$licensenumber_r";
		print"</td>";
  print"</tr>";        
}

print"</table>";
  
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
  </div>


<!-- End page content -->
</div>


<!--Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">By Team: G1T02</p></div>
<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>






