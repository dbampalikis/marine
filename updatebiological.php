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
	
	
$BID=$_POST['BID'];
//$Bstationname=$_POST['Bstationname'];
$Bstratummin=$_POST['Bstratummin'];
$Bstratummax=$_POST['Bstratummax'];
$Bx=$_POST['Bx'];
$B_y=$_POST['B_y'];
$Blarvastage=$_POST['Blarvastage'];
$Bspecies=$_POST['Bspecies'];
$Babundance=$_POST['Babundance'];


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
	
	$sql = "UPDATE $thetable 
	SET Bstratummin=$Bstratummin,Bstratummax=$Bstratummax,Bx=$Bx,B_y=$B_y,Blarvastage='$Blarvastage',Bspecies='$Bspecies',Babundance=$Babundance   
	WHERE BID=$BID";
	
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