<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hide-show</title>
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
		if(isset($_POST['submit'])){
		$table = $_POST['table'];
		if($table = 'station'){
			if(!empty($_POST['station_hide'])) {
				include("db.php");
				$id = $_POST['station_hide'];
				$showhide = $_POST['todo'];

				$sql = "UPDATE Stations
				SET Shidden = 1-'$showhide'
				WHERE Sname IN ('" . implode("','", $id) ."') 
				;
				";

				if (mysqli_query($conn, $sql)) {
			    echo "<br> <br> Hidden values changed for Station";


				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

				$sql = "UPDATE Physical
				SET Phidden = 1-'$showhide'
				WHERE Pstationname IN ('" . implode("','", $id) ."') 
				;
				";

				if (mysqli_query($conn, $sql)) {
			    echo "<br> <br> Hidden values changed for Physical";


				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

				$sql = "UPDATE Biological
				SET Bhidden = 1-'$showhide'
				WHERE Bstationname IN ('" . implode("','", $id) ."') 
				;
				";

				if (mysqli_query($conn, $sql)) {
			    echo "<br> <br> Hidden values changed for Biological";

				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

			}
				else{
					echo "<br><br><b>No stations selected to modify Stations table and/or Physical and/or Biological.</b> </p>";
				}
}


		if($table = 'physical'){
			if(!empty($_POST['physical_hide'])) {
				include("db.php");
				$id = $_POST['physical_hide'];
				$showhide = $_POST['todo'];

				$sql = "UPDATE Physical
				SET Phidden = 1-'$showhide'
				WHERE PID IN ('" . implode("','", $id) ."') 
				;
				";

				if (mysqli_query($conn, $sql)) {
			    echo "<br> Hidden values changed for Physical";


				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
				else{
					echo "<br><br><b>No stations selected to modify only Physical.</b> </p>";
				}
}

		if($table = 'biological'){
			if(!empty($_POST['biological_hide'])) {
				include("db.php");
				$id = $_POST['biological_hide'];
				$showhide = $_POST['todo'];

				$sql = "UPDATE Biological
				SET Bhidden = 1-'$showhide'
				WHERE BID IN ('" . implode("','", $id) ."') 
				;
				";

				if (mysqli_query($conn, $sql)) {
			    echo "<br> Hidden values changed for Biological";


				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
				else{
					echo "<br><br><b>No stations selected to modify only Biological.</b> </p>";
				}
}

}
	?>


  
</div><!-- /.container -->


  </body>
</html>
