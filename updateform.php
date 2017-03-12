<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update data</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

        <?php include_once("header.php");?>

<div class="container">  
	<div class="text-center">
		<h1>Marine</h1>
		<p class="lead">Choose data to update</p>
	</div>
	<b>Station data</b>
<br>

	<form action="stationlist.php" method="post">
		Choose station:
		<select class="selectpicker" multiple data-actions-box="false" name = station_list[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT Sname from Stations");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option deselected name =\"station_list[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
			<input type="hidden" name = "table" value = "station">
		</select>
		<br>
		
		<input type="submit" name="submit" Value="Submit"/>
		</form>

<br>
<br>

	<b>Physical data</b>
<br>
	<br>
	<form action="datalist.php" method="post">
		Choose station: <select class="selectpicker" multiple data-actions-box="false"  name = station_forphysical[] id="station">
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT(Pstationname) AS Pstationname FROM Physical ORDER BY Pstationname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Pstationname']); 
					print "<option deselected name =\"station_forphysical[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
			<input type="hidden" name = "table" value = "physical">
		</select>


		<br>
		<input type="submit" name="submit"  Value="Submit"/>
		</form>

<br>
<br>
	<b>Biological variables:</b> 
<br>			
	<br>
	<form action="datalist2.php" method="post">
		Choose station: <select class="selectpicker" multiple data-actions-box="false" name = station_forbiological[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bstationname FROM Biological ORDER BY Bstationname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Bstationname']); 
					print "<option deselected name =\"station_forbiological[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
			<input type="hidden" name = "table" value = "biological">
		</select>

		
		<br>
		<input type="submit" name="submit"  Value="Submit"/>
		</form>

</div><!-- /.container -->


  </body>
</html>
