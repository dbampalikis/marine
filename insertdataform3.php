<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insert data</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>


  <body>

    <?php include_once("header.php");?>
	
<div class="container">
  
  <div class="text-center">
    <h1>New Station data</h1>
    <br>
	<form action="insert.php" method="post">
                <table class="table-condensed" align="center">
                    <thead><tr><th></th></tr></thead>
                    <tbody align="right"><tr><td>Station Name:</td><td><input type="text" name="Sname"></td></tr>
                    <tr><td>Station Sequence:</td><td><input type="text" name="Ssequence"></td></tr>
                    <tr><td>Station Longitude:</td><td><input type="text" name="Slongitude"></td></tr>
                    <tr><td>Station Latitude:</td><td><input type="text" name="Slatitude"></td></tr></tbody>
                </table>
                <input type="submit" name="submit"  Value="Submit"/>
            </form>
  </div>
  
</div><!-- /.container -->

<div class="container">
  
  <div class="text-center">
    <h1>New Biological data</h1>
    <br>
	<form action="insert2.php" method="post">
            Choose station:  <select class="selectpicker" multiple data-actions-box="false" name = station_forbiological[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Sname FROM Stations ORDER BY Sname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option deselected name =\"station_forbiological[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
                    </select><br>
            <table class="table-condensed" align="center">
                <thead><tr><th></th></tr></thead>
                <tbody align="right">
                    <tr><td>Biological stratum min:</td><td><input type="text" name="Bstratummin"></td></tr>
                    <tr><td>Biological stratum max:</td><td><input type="text" name="Bstratummax"></td></tr>
                    <tr><td>Bx:</td><td><input type="text" name="Bx"></td></tr>
                    <tr><td>By:</td><td><input type="text" name="B_y"></td></tr>
                    <tr><td>Biological larva stage:</td><td><input type="text" name="Blarvastage"></td></tr>
                    <tr><td>Biological species:</td><td><input type="text" name="Bspecies"></td></tr>
                    <tr><td>Biological abundance:</td><td><input type="text" name="Babundance"></td></tr>
                </tbody>
            </table>
            <input type="submit" name="submit"  Value="Submit"/>
	</form>
  </div>
  
</div><!-- /.container -->

<div class="container">
  
  <div class="text-center">
    <h1>New Physical data</h1>
    <br>
	<form action="insert3.php" method="post">
            Choose station:  <select class="selectpicker" multiple data-actions-box="false"  name = station_forphysical[] id="station">
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Sname FROM Stations ORDER BY Sname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option deselected name =\"station_forphysical[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		<br>
                <table class="table-condensed" align="center">
                <thead><tr><th></th></tr></thead>
                <tbody align="right">
                    <tr><td>Physical depth:</td><td><input type="text" name="Pdepth"></td></tr>
                    <tr><td>Physical temperature:</td><td><input type="text" name="Ptemperature"></td></tr>
                    <tr><td>Physical salinity:</td><td><input type="text" name="Psalinity"></td></tr>
                    <tr><td>Physical oxygen:</td><td><input type="text" name="Poxygen"></td></tr>
                    <tr><td>Physical fluorescence:</td><td><input type="text" name="Pfluorescence"></td></tr>
                </tbody>
            </table>
            <input type="submit" name="submit"  Value="Submit"/>
	</form>
  </div>
  
</div><!-- /.container -->

  </body>
</html>
