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
    <p class="lead">List of corresponding entries.</p>
  </div>
</div>

<div class="container">

	<?php		
		if(isset($_POST['submit'])){
		$table = $_POST['table'];
		//$table = 'station';

		if($table = 'physical'){
			if(!empty($_POST['station_forphysical'])) {
				include("db.php");
				$station = $_POST['station_forphysical'];
				$sql = "SELECT * FROM Physical
				WHERE Pstationname IN ('" . implode("','", $station) ."') 
				;
				";

				if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);

	echo "<form action=\"Hidden_elements.php \" method=\"post\">";
	echo "Find the desired entry ID below:";
	echo	"<div class=\"checkbox\"  name = physical_hide[]>";
					echo "<table class=\"table\" id=\"datatable\">";
					echo "<thead>";
					echo "<tr><th>ID</th><th>Name</th><th>Depth</th><th>Temperature</th><th>Salinity</th><th>Oxygen</th><th>Fluorescence</th></tr>";
					echo "</thead>";
					echo "<tbody>";
				    while($row = mysqli_fetch_assoc($result)) {

				        echo "<td>" . $row["PID"]."</td>";
						$pid=$row["PID"];
				        echo "<td>" . $row["Pstationname"]."</td>";
						$pstationname=$row["Pstationname"];
				        echo "<td>" . $row["Pdepth"]."</td>";
						$pdepth=$row["Pdepth"];
				        echo "<td>" . $row["Ptemperature"]."</td>";
						$ptemperature=$row["Ptemperature"];
				        echo "<td>" . $row["Psalinity"]."</td>";
						$psalinity=$row["Psalinity"];
				        echo "<td>" . $row["Poxygen"]."</td>";
						$poxygen=$row["Poxygen"];
				        echo "<td>" . $row["Pfluorescence"]."</td></tr>";
						$pfluorescence=$row["Pfluorescence"];
					}
					echo "</tbody>";
					echo "</table>";

				include 'closeDB.php';  //close database connection script
	echo "</div>";

	echo "<input type=\"hidden\" name = \"table\" value = \"physical\">";
	//echo "<input type=\"hidden\" name = \"todo\" value = '$showhide'>";
	echo "<br>";
	echo "</form>";


	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}

}
						else{
					echo "<b>No stations selected.</b> </p>";
		}
		}
	?>


</div><!-- /.container -->

<div class="container">

  <div class="text-center">
    <h1>Change a physical entry</h1>
    <br>
	<form action="updatephysical.php" method="post">
                <table class="table-condensed" align="center">
                <thead><tr><th></th></tr></thead>
                <tbody align="right">
                    <tr><td>ID:</td><td><input type="text" Value=<?php echo $pid ?> name="PID"></td></tr>
					<tr><td>Station Name:</td><td><?php echo $pstationname ?></td></tr>
                    <tr><td>Depth:</td><td><input type="text" Value=<?php echo $pdepth ?> name="Pdepth"></td></tr>
                    <tr><td>Temperature:</td><td><input type="text" Value=<?php echo $ptemperature ?> name="Ptemperature"></td></tr>
                    <tr><td>Salinity:</td><td><input type="text" Value=<?php echo $psalinity ?> name="Psalinity"></td></tr>
                    <tr><td>Oxygen:</td><td><input type="text" Value=<?php echo $poxygen ?> name="Poxygen"></td></tr>
                    <tr><td>Fluorescence:</td><td><input type="text" Value=<?php echo $pfluorescence ?> name="Pfluorescence"></td></tr>
                </tbody>
            </table>
            <input type="submit" name="submit"  Value="Submit"/>
	</form>
  </div>

</div><!-- /.container -->


  </body>
</html>
