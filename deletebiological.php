<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Select</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

        <?php include_once("header.php");?>

<div class="container">
  
  <div class="text-center">
    <h1>Marine</h1>
    <p class="lead">Entries to show or hide.</p>
  </div>

<ul>
<li>Check the boxes of the entires you would like to change </li>
<li>Click submit</li>
</ul>


	<?php
		if(isset($_POST['submit'])){
		$table = $_POST['table'];
		if($table = 'station'){
			if(!empty($_POST['station_list'])) {
				include("db.php");
				$name = $_POST['station_list'];
				$showhide = $_POST['station_to_hide'];
				$sql = "SELECT * FROM Stations
				WHERE Sname IN ('" . implode("','", $name) ."') AND Shidden = '$showhide'
				;
				";

				if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);

	echo "<form action=\"Hidden_elements.php \" method=\"post\">";
	echo	"<div class=\"checkbox\"  name = station_hide[]>";
					echo "<table class=\"table\" id=\"datatable\">";
					echo "<thead>";
					echo "<tr><th>Hide</th><th>Hidden</th><th>ID</th><th>Name</th><th>Sequence</th><th>Longitude</th><th>Latitude</th></tr>";
					echo "</thead>";
					echo "<tbody>";
				    while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td><input type=\"checkbox\" name =\"station_hide[]\" value =" .$row['Sname'] . "></td>";
				        echo "<td>" . $row["Shidden"]."</td>";
				        echo "<td>" . $row["SID"]."</td>";
				        echo "<td>" . $row["Sname"]."</td>";
				        echo "<td>" . $row["Ssequence"]."</td>";
				        echo "<td>" . $row["Slongitude"]."</td>";
				        echo "<td>" . $row["Slatitude"]."</td></tr>";
					}
					echo "</tbody>";
					echo "</table>";

				include 'closeDB.php';  //close database connection script
	echo "</div>";

	echo "<input type=\"hidden\" name = \"table\" value = \"station\">";
	echo "<input type=\"hidden\" name = \"todo\" value = '$showhide'>";
	echo "<br>";
	echo "<input type=\"submit\" name=\"submit\" Value=\"Submit\"/>";
	echo "</form>";


	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
}



		if($table = 'physical'){
			if(!empty($_POST['station_forphysical'])) {
				include("db.php");
				$station = $_POST['station_forphysical'];
				$depth = $_POST['depth_physical'];
				$showhide = $_POST['physical_to_hide'];
				$sql = "SELECT * FROM Physical
				WHERE Pstationname IN ('" . implode("','", $station) ."') AND Pdepth IN ('" . implode("','", $depth) ."') AND Phidden = '$showhide'
				;
				";

				if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);

	echo "<form action=\"Hidden_elements.php \" method=\"post\">";
	echo "Choose ID to change hidden value:";
	echo	"<div class=\"checkbox\"  name = physical_hide[]>";
					echo "<table class=\"table\" id=\"datatable\">";
					echo "<thead>";
					echo "<tr><th>Hide</th><th>Hidden</th><th>ID</th><th>Name</th><th>Depth</th><th>Temperature</th><th>Salinity</th><th>Oxygen</th><th>Fluorescence</th></tr>";
					echo "</thead>";
					echo "<tbody>";
				    while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td><input type=\"checkbox\" name =\"physical_hide[]\" value =" .$row['PID'] . "></td>";
				        echo "<td>" . $row["Phidden"]."</td>";
				        echo "<td>" . $row["PID"]."</td>";
				        echo "<td>" . $row["Pstationname"]."</td>";
				        echo "<td>" . $row["Pdepth"]."</td>";
				        echo "<td>" . $row["Ptemperature"]."</td>";
				        echo "<td>" . $row["Psalinity"]."</td>";
				        echo "<td>" . $row["Poxygen"]."</td>";
				        echo "<td>" . $row["Pfluorescence"]."</td></tr>";
					}
					echo "</tbody>";
					echo "</table>";

				include 'closeDB.php';  //close database connection script
	echo "</div>";

	echo "<input type=\"hidden\" name = \"table\" value = \"physical\">";
	echo "<input type=\"hidden\" name = \"todo\" value = '$showhide'>";
	echo "<br>";
	echo "<input type=\"submit\" name=\"submit\" Value=\"Submit\"/>";
	echo "</form>";


	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}

}





		if($table = 'biological'){
			if(!empty($_POST['station_forbiological'])) {
				include("db.php");
				$station = $_POST['station_forbiological'];
				$stratum = $_POST['biological_stratummax'];
				$larva = $_POST['biological_larval'];
				$species = $_POST['biological_species'];
				$showhide = $_POST['biological_to_hide'];
				$sql = "SELECT * FROM Biological
				WHERE Bstationname IN ('" . implode("','", $station) ."') AND Bstratummax IN ('" . implode("','", $stratum) ."') AND Blarvastage IN ('" . implode("','", $larva) ."') AND Bspecies IN ('" . implode("','", $species) ."') AND Bhidden = '$showhide'
				;
				";

				if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);

	echo "<form action=\"Hidden_elements.php \" method=\"post\">";
	echo "Choose ID to change hidden value:";
	echo	"<div class=\"checkbox\"  name = biological_hide[]>";
					echo "<table class=\"table\" id=\"datatable\">";
					echo "<thead>";
					echo "<tr><th>Hide</th><th>Hidden</th><th>ID</th><th>Name</th><th>Stratum min</th><th>Stratum max</th><th>Bx</th><th>By</th><th>Larval stage</th><th>Species</th><th>Abundance</th></tr>";
					echo "</thead>";
					echo "<tbody>";
				    while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td><input type=\"checkbox\" name =\"biological_hide[]\" value =" .$row['BID'] . "></td>";
				        echo "<td>" . $row["Bhidden"]."</td>";
				        echo "<td>" . $row["BID"]."</td>";
				        echo "<td>" . $row["Bstationname"]."</td>";
				        echo "<td>" . $row["Bstratummin"]."</td>";
				        echo "<td>" . $row["Bstratummax"]."</td>";
				        echo "<td>" . $row["Bx"]."</td>";
				        echo "<td>" . $row["B_y"]."</td>";
				        echo "<td>" . $row["Blarvastage"]."</td>";
				        echo "<td>" . $row["Bspecies"]."</td>";
				        echo "<td>" . $row["Babundance"]."</td></tr>";
					}
					echo "</tbody>";
					echo "</table>";

				include 'closeDB.php';  //close database connection script
	echo "</div>";

	echo "<input type=\"hidden\" name = \"table\" value = \"biological\">";
	echo "<input type=\"hidden\" name = \"todo\" value = '$showhide'>";
	echo "<br>";
	echo "<input type=\"submit\" name=\"submit\" Value=\"Submit\"/>";
	echo "</form>";


	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}

}






}

				else{
					echo "<b>No stations selected.</b> </p>";
				}

	?>


  
</div><!-- /.container -->


  </body>
</html>
