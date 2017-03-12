<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Corresponding entries</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

        <?php include_once("header.php");?>

<div class="container">
  
  <div class="text-center">
    <h1>Marine</h1>
    <p class="lead">List of corresponding stations.</p>
  </div>
</div>

<div class="container">

	<?php		
		if(isset($_POST['submit'])){
		$table = $_POST['table'];
		//$table = 'station';
		if($table = 'station'){
			if(!empty($_POST['station_list'])) {
				include("db.php");
				$name = $_POST['station_list'];
				//$showhide = $_POST['station_to_hide'];
				$showhide = '';
				print($showhide);
				$sql = "SELECT * FROM Stations
				WHERE Sname IN ('" . implode("','", $name) ."') AND Shidden = '$showhide'
				;
				";

				if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);

	//echo "<form action=\"Hidden_elements.php \" method=\"post\">";
	echo "Find the desired station ID below:";
	echo	"<div class=\"checkbox\"  name = station_hide[]>";
					echo "<table class=\"table\" id=\"datatable\">";
					echo "<thead>";
					echo "<tr><th>ID</th><th>Name</th><th>Sequence</th><th>Longitude</th><th>Latitude</th></tr>";
					echo "</thead>";
					echo "<tbody>";
				    while($row = mysqli_fetch_assoc($result)) {

				        echo "<td>" . $row["SID"]."</td>";
						$stationid=$row["SID"];
				        echo "<td>" . $row["Sname"]."</td>";
						$stationname=$row["Sname"];
				        echo "<td>" . $row["Ssequence"]."</td>";
						$stationsequence=$row["Ssequence"];
				        echo "<td>" . $row["Slongitude"]."</td>";
						$stationlongitude=$row["Slongitude"];
				        echo "<td>" . $row["Slatitude"]."</td></tr>";
						$stationlatitude=$row["Slatitude"];
					}
					echo "</tbody>";
					echo "</table>";

				include 'closeDB.php';  //close database connection script
	echo "</div>";




	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
}





	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	








}

				else{
					echo "<b>No stations selected.</b> </p>";
				}


		
	?>


</div><!-- /.container -->

<div class="container">

  <div class="text-center">
    <h1>Change Station data</h1>
    <br>
	<form action="updatestation.php" method="post">
            <table class="table-condensed" align="center">
                <thead><tr><th></th></tr></thead>
                <tbody align="right">
                    <tr><td>Station ID:</td><td><input type="text" Value=<?php echo $stationid ?> name="SID"></td></tr>
                    <tr><td>Station Name:</td><td><input type="text" Value=<?php echo $stationname ?> name="Sname"></td></tr>
                    <tr><td>Station Sequence:</td><td><input type="text" Value=<?php echo $stationsequence ?> name="Ssequence"></td></tr>
                    <tr><td>Station Longitude:</td><td><input type="text" Value=<?php echo $stationlongitude ?> name="Slongitude"></td></tr>
                    <tr><td>Station Latitude:</td><td><input type="text" Value=<?php echo $stationlatitude ?> name="Slatitude"></td></tr>
                </tbody>
            </table>
            <input type="submit" name="submit"  Value="Submit"/>
	</form>
  </div>

</div><!-- /.container -->


  </body>
</html>
