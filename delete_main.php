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
	</div>



<p class="lead">Data to hide or show. Originally, all entires have flag = 0, which means they are shown. Entries hidden have flag = 1.<br></p>
	<b>Station data</b><br>
		<br>
<ul>Hiding or showing a station. Any station that changes its visibility flag value from visible to unvisible (0 to 1) or from unvisible to visible (1 to 0), will also be hidden from physical and biological tables. 
<li>Choose the stations</li>
<li>Choose the action to do</li>
<li>Click submit</li>
<li>In the next page: check the boxes of the entires you would like to change</li>
<li>Click submit</li>
</ul>
<br>
	<form action="deletebiological.php" method="post">
		Choose station:
		<select class="selectpicker" multiple data-actions-box="true" name = station_list[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT Sname from Stations");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option selected name =\"station_list[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		<br>
		<br>
		Hide or show: <select class="selectpicker"  name = "station_to_hide">
						<option selected name ="station_to_hide" value ="0"> HIDE</option>
						<option name ="station_to_hide" value ="1"> SHOW</option>
		</select>
						<input type="hidden" name = "table" value = "station">
		<br>
		<input type="submit" name="submit" Value="Submit"/>
		</form>

<br>
<br>

	<b>Physical data</b>
<br>
<ul>Hiding or showing an entry from physical data. This form will only affect the visibility of physical variables. 
<li>Choose the stations</li>
<li>Choose the depths you want to change</li>
<li>Choose the action to do</li>
<li>Click submit</li>
<li>In the next page: check the boxes of the entires you would like to change</li>
<li>Click submit</li>
</ul>
<br>
	<form action="deletebiological.php" method="post">
		Choose station: <select class="selectpicker" multiple data-actions-box="true"  name = station_forphysical[] id="station">
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT(Pstationname) AS Pstationname FROM Physical ORDER BY Pstationname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Pstationname']); 
					print "<option selected name =\"station_forphysical[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		<br>
		<br>

	Filter by depth:<select class="selectpicker" multiple data-actions-box="true" name = depth_physical[] id="depth">
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Pdepth FROM Physical ORDER BY Pdepth");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Pdepth']); 
					print "<option selected name =\"depth_physical[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		<br>
		<br>
		Hide or show:  <select class="selectpicker"  name = "physical_to_hide">
						<option selected name ="physical_to_hide" value ="0"> HIDE</option>
						<option name ="physical_to_hide" value ="1"> SHOW</option>
		</select>
						<input type="hidden" name = "table" value = "physical">
		<br>
		<input type="submit" name="submit"  Value="Submit"/>
		</form>

<br>
<br>
	<b>Biological variables:</b> 
<br>			
<br>
<ul>Hiding or showing an entry from biological data. This form will only affect the visibility of biological variables.
<li>Choose the stations</li>
<li>Choose the stratum, larval stage and species you want to change</li>
<li>Choose the action to do</li>
<li>Click submit</li>
<li>In the next page: check the boxes of the entires you would like to change</li>
<li>Click submit</li>
</ul>
<br>
	<form action="deletebiological.php" method="post">
		Choose station: <select class="selectpicker" multiple data-actions-box="true" name = station_forbiological[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bstationname FROM Biological ORDER BY Bstationname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Bstationname']); 
					print "<option selected name =\"station_forbiological[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>



		<br>
		<br>
		Filter by stratum: <select class="selectpicker" multiple data-actions-box="true" name = biological_stratummax[]> Biological variables
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bstratummax FROM Biological ORDER BY Bstratummax");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Bstratummax']); 
					print "<option selected name =\"biological_stratummax[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>

		Filter by larval stage: <select class="selectpicker" multiple data-actions-box="true" name = biological_larval[]> Biological variables
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Blarvastage FROM Biological ORDER BY Blarvastage");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Blarvastage']); 
					print "<option selected name =\"biological_larval[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		
		Filter by species: <select class="selectpicker" multiple data-actions-box="true" name = biological_species[]> Biological variables
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bspecies FROM Biological ORDER BY Bspecies");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Bspecies']); 
					print "<option  selected name =\"biological_species[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		<br>
		<br>
		Hide or show: <select class="selectpicker"  name = "biological_to_hide">
						<option selected name ="biological_to_hide" value ="0"> HIDE</option>
						<option name ="biological_to_hide" value ="1"> SHOW</option>
		</select>

		<br>
		<input type="hidden" name = "table" value = "biological">
		<input type="submit" name="submit"  Value="Submit"/>
		</form>


</div><!-- /.container -->


  </body>
</html>
