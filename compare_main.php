<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Compare</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

        <?php include_once("header.php");?>

<div class="container">  
	<div class="text-center">
		<h1>Compare</h1>
		<p class="lead">** Compare two stations or two groups of stations **</p>

<form action="compare_groups.php" method="post">
  <div class="row">
    <div class="col-sm-6">
      <h3>Group 1</h3>
		<select class="selectpicker" multiple data-actions-box="true" name = group1[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT Sname from Stations WHERE Shidden = 0 order by Sname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option  name =\"group1[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
			?>
		</select>
    </div>
    <div class="col-sm-6">
      <h3>Group 2</h3>
		<select class="selectpicker" multiple data-actions-box="true" name = group2[]>
			<?php 
				$result = $conn->query("SELECT Sname from Stations WHERE Shidden = 0 order by Sname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option  name =\"group2[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
    </div>

  </div><!-- /.row -->
<br>
<input type="submit" name="submit"  Value="Submit"/>
</form>


</div><!-- /.center -->
</div><!-- /.container -->


  </body>
</html>
