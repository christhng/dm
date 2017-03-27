<link rel="stylesheet" href="findmybus.css">

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
    <h1 class="w3-xxxlarge w3-text-red"><b>Trip Information</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  
  <!-- Service Information -->
  <div class="w3-row-padding">
</p>
<?php

$conn = mysqli_connect('localhost','root','','findmybus');

if (!$conn)
{  exit( 'Could not connect:'  
           .mysqli_connect_error($conn) ); 	
}


$query = "select tripdate, triptime, routenumber, drivername, busplate, if(cancelled='0','','Cancelled') as 'Status'
from trip, driver
where staffid=driver and servicenumber = ? and tripdate = ? and triptime between ? and ?
order by triptime asc, routenumber"; 


$stmt = mysqli_prepare($conn, $query);
 
mysqli_stmt_bind_param($stmt, 'ssss', $service, $tripdate, $starttime, $endtime);

$service=$_POST['service'];
$tripdate=$_POST['tripdate'];
$starttime=$_POST['starttime'];
$endtime =$_POST['endtime'];	

mysqli_stmt_execute($stmt);

# Stores output in variables
mysqli_stmt_bind_result($stmt, $tripdate_r, $triptime_r, $routenumber_r, $drivername_r, $busplate_r, $status_r);

print "<p>";
print "Your current search is based on serivce: ";
print "<b>";
print "$service";
print "</b>";
print ", tripdate: ";
print "<b>";
print "$tripdate";
print "</b>";
print ", start time: ";
print "<b>";
print "$starttime";
print "</b>";
print ", end time: ";
print "<b>"; 
print "$endtime";
print "</b>";
print ".";
print "</p>";

print"<table border ='1'>";
print"<table>";
print"<tr>";
print"<th>Trip Date</th>";
print"<th>Trip Time</th>";
print"<th>Route No.</th>";
print"<th>Driver Name</th>";
print"<th>Bus Plate No.</th>";
print"<th>Status</th>";
print"</tr>";

while (mysqli_stmt_fetch($stmt)) {
		print"<tr>";
		print"<td>";
		print $tripdate_r;
		print"</td>";
		print"<td>";
		print $triptime_r;
		print"</td>";
		print"<td align='center'>";
		print $routenumber_r;
		print"</td>";
		print"<td>";
		print $drivername_r;
		print"</td>";
		print"<td>";
		print $busplate_r;
		print"</td>";
		print"<td>";
		print $status_r;
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


