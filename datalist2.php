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


		if($table = 'biological'){
			if(!empty($_POST['station_forbiological'])) {
				include("db.php");
				$station = $_POST['station_forbiological'];
				//$stratum = $_POST['biological_stratummax'];
				//$larva = $_POST['biological_larval'];
				//$species = $_POST['biological_species'];
				//$showhide = $_POST['biological_to_hide'];
				$showhide = '';
				$sql = "SELECT * FROM Biological
				WHERE Bstationname IN ('" . implode("','", $station) ."') AND Bhidden = '$showhide'
				;
				";

				if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, $sql);
				$num = mysqli_num_rows($result);

	echo "<form action=\"Hidden_elements.php \" method=\"post\">";
	echo "Find the desired entry ID below:";
	echo	"<div class=\"checkbox\"  name = biological_hide[]>";
					echo "<table class=\"table\" id=\"datatable\">";
					echo "<thead>";
					echo "<tr><th>ID</th><th>Name</th><th>Stratum min</th><th>Stratum max</th><th>Bx</th><th>By</th><th>Larval stage</th><th>Species</th><th>Abundance</th></tr>";
					echo "</thead>";
					echo "<tbody>";
				    while($row = mysqli_fetch_assoc($result)) {
						//echo "<tr><td><input type=\"checkbox\" name =\"biological_hide[]\" value =" .$row['BID'] . "></td>";
				        //echo "<td>" . $row["Bhidden"]."</td>";
				        echo "<td>" . $row["BID"]."</td>";
						$BID=$row["BID"];
				        echo "<td>" . $row["Bstationname"]."</td>";
						$Bstationname=$row["Bstationname"];
				        echo "<td>" . $row["Bstratummin"]."</td>";
						$Bstratummin=$row["Bstratummin"];
				        echo "<td>" . $row["Bstratummax"]."</td>";
						$Bstratummax=$row["Bstratummax"];
				        echo "<td>" . $row["Bx"]."</td>";
						$Bx=$row["Bx"];
				        echo "<td>" . $row["B_y"]."</td>";
						$B_y=$row["B_y"];
				        echo "<td>" . $row["Blarvastage"]."</td>";
						$Blarvastage=$row["Blarvastage"];
				        echo "<td>" . $row["Bspecies"]."</td>";
						$Bspecies=$row["Bspecies"];
				        echo "<td>" . $row["Babundance"]."</td></tr>";
						$Babundance=$row["Babundance"];
						
						
					}
					echo "</tbody>";
					echo "</table>";

				include 'closeDB.php';  //close database connection script
	echo "</div>";

	echo "<input type=\"hidden\" name = \"table\" value = \"biological\">";
	echo "<br>";
	//echo "<input type=\"submit\" name=\"submit\" Value=\"Submit\"/>";
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

<div class="container">

  <div class="text-center">
    <h1>Change a biological entry</h1>
    <br>
	<form action="updatebiological.php" method="post">
            <table class="table-condensed" align="center">
                <thead><tr><th></th></tr></thead>
                <tbody align="right">
                    <tr><td>ID:</td><td><input type="text" Value=<?php echo $BID ?> name="BID"></td></tr>
                    <tr><td>Station Name:</td><td><?php echo $Bstationname ?></td></tr>
                    <tr><td>Minimum stratum:</td><td><input type="text" Value=<?php echo $Bstratummin ?> name="Bstratummin"></td></tr>
                    <tr><td>Maximum stratum:</td><td><input type="text" Value=<?php echo $Bstratummax ?> name="Bstratummax"></td></tr>
                    <tr><td>Bx:</td><td><input type="text" Value=<?php echo $Bx ?> name="Bx"></td></tr>
                    <tr><td>By:</td><td><input type="text" Value=<?php echo $B_y ?> name="B_y"></td></tr>
                    <tr><td>Larval stage:</td><td><input type="text" Value=<?php echo $Blarvastage ?> name="Blarvastage"></td></tr>
                    <tr><td>Species:</td><td><input type="text" Value=<?php echo $Bspecies ?> name="Bspecies"></td></tr>
                    <tr><td>Abundance:</td><td><input type="text" Value=<?php echo $Babundance ?> name="Babundance"></td></tr>
                </tbody>
            </table>
            <input type="submit" name="submit"  Value="Submit"/>
	</form>
  </div>

</div><!-- /.container -->


  </body>
</html>
