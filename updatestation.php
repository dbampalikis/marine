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
	
$SID=$_POST['SID'];
$Sname=$_POST['Sname'];
$Ssequence=$_POST['Ssequence'];
$Slongitude=$_POST['Slongitude'];
$Slatitude=$_POST['Slatitude'];
	
$servername = "localhost";
$username="root";

$password="LIMS.2017.Uppsala";
$dbname = "Marine";
$thetable="Biological";
	
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	
	$sql = "UPDATE Stations 
	SET Sname='$Sname', Ssequence=$Ssequence,Slongitude=$Slongitude,Slatitude=$Slatitude  
	WHERE SID=$SID";

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
