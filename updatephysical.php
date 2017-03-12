<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Entries flagged to be shown or multiple data-actions-box=\"true\"</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

        <?php include_once("header.php");?>

		
		
<div class="container">
  
  <div class="text-center">
    <h1>Marine</h1>
    <p class="lead">Confirmation of changed values</p>
  </div>
</div>

<div class="container">

	<?php
	
	
$PID=$_POST['PID'];
//$Pstationname=$_POST['Pstationname'];
$Pdepth=$_POST['Pdepth'];
$Ptemperature=$_POST['Ptemperature'];
$Psalinity=$_POST['Psalinity'];
$Poxygen=$_POST['Poxygen'];
$Pfluorescence=$_POST['Pfluorescence'];
	
$servername = "localhost";
$username="root";

$password="LIMS.2017.Uppsala";
$dbname = "Marine";
$thetable="Physical";
	
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	
	$sql = "UPDATE $thetable 
	SET Pdepth=$Pdepth,Ptemperature=$Ptemperature,Psalinity=$Psalinity,Poxygen=$Poxygen,Pfluorescence=$Pfluorescence  
	WHERE PID=$PID";

if (mysqli_query($conn, $sql)) {
    echo "Entry changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

	

	?>


  
</div><!-- /.container -->


  </body>
</html>