<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View</title>
        <meta name="description" content="">
        <meta name="author" content="">
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
		width: 50%
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>



    </head>


    <body>

    <?php include_once("header.php");?>
      
    <div class="container">

            <div class="text-center">
                    <h1>Marine</h1>
                    
            </div>
<p class="lead">  </p><br>
Select type of data you would like to see. It is possible to download it after clicking on submit. The available stations showed here are only visible if they have a hidden value = 0, this value is set by the admin in the Admin - Select option from the main menu.<br><br>

<div class="row">
      <div class="col-sm-6">



	<b>Station data</b>
		<br>
<ul>
<li>Choose the stations</li>
<li>Click submit</li>
<li>In the next page: if you would like to download the data: click download</li>
</ul>
<br>

    <br>
	<form action="displayselectedbiological.php" method="post">
		Choose station:
		<select class="selectpicker" multiple data-actions-box="true" name = station_list[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT Sname from Stations WHERE Shidden = 0 order by Sname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Sname']); 
					print "<option selected name =\"station_list[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
			<input type="hidden" name = table value = "station">
		<br>
		<input type="submit" name="submit" Value="Submit"/>
		</form>

    <br>
    <br>

	<b>Physical data</b>
    <br>
<ul>
<li>Choose the stations</li>
<li>Choose the depths</li>
<li>Click submit</li>
<li>In the next page: if you would like to download the data: click download</li>
</ul>
<br>

	<form action="displayselectedbiological.php" method="post">
		Choose station: <select class="selectpicker" multiple data-actions-box="true"  name = station_forphysical[] id="station">
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT(Pstationname) AS Pstationname FROM Physical 
										INNER JOIN Stations ON Pstationname = Sname 
										WHERE Shidden = 0 AND Phidden = 0 
										ORDER BY Pstationname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Pstationname']); 
					print "<option selected name =\"station_forphysical[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>


	<br>Filter by depth:<select class="selectpicker" multiple data-actions-box="true" name = depth_physical[] id="depth">
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Pdepth FROM Physical
										INNER JOIN Stations ON Pstationname = Sname 
										WHERE Shidden = 0 AND Phidden = 0 
										ORDER BY Pdepth");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Pdepth']); 
					print "<option selected name =\"depth_physical[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
			<input type="hidden" name = table value = "physical">
		<br>
		<input type="submit" name="submit"  Value="Submit"/>
		</form>

    <br>
    <br>
	<b>Biological variables:</b> 
    <br>			
<ul>
<li>Choose the stations</li>
<li>Choose the stratum, larval stage and species</li>
<li>Click submit</li>
<li>In the next page: if you would like to download the data: click download</li>
</ul>
	<form action="displayselectedbiological.php" method="post">
		Choose station: <select class="selectpicker" multiple data-actions-box="true" name = station_forbiological[]>
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bstationname FROM Biological 
										INNER JOIN Stations ON Bstationname = Sname
										WHERE Bhidden = 0 AND Shidden = 0
										ORDER BY Bstationname");
				while($row = $result->fetch_assoc()) {
					$station = htmlentities($row['Bstationname']); 
					print "<option selected name =\"station_forbiological[] \" value = \"" . $station . "\">" . $station . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>


		<br>Filter by stratum: <select class="selectpicker" multiple data-actions-box="true" name = biological_stratummax[]> Biological variables
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bstratummax FROM Biological
										INNER JOIN Stations ON Bstationname = Sname
										WHERE Bhidden = 0 AND Shidden = 0
										ORDER BY Bstratummax");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Bstratummax']); 
					print "<option selected name =\"biological_stratummax[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>

		<br>Filter by larval stage: <select class="selectpicker" multiple data-actions-box="true" name = biological_larval[]> Biological variables
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Blarvastage FROM Biological 
										INNER JOIN Stations ON Bstationname = Sname
										WHERE Bhidden = 0 AND Shidden = 0
										ORDER BY Blarvastage");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Blarvastage']); 
					print "<option selected name =\"biological_larval[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
		
		<br>Filter by species: <select class="selectpicker" multiple data-actions-box="true" name = biological_species[]> Biological variables
			<?php 
				include 'db.php'; //establish database connection script
				$result = $conn->query("SELECT DISTINCT Bspecies FROM Biological 
										INNER JOIN Stations ON Bstationname = Sname
										WHERE Bhidden = 0 AND Shidden = 0
										ORDER BY Bspecies");
				while($row = $result->fetch_assoc()) {
					$physical = htmlentities($row['Bspecies']); 
					print "<option  selected name =\"biological_species[] \" value = \"" . $physical . "\">" . $physical . "</option>"; 
				} 
				include 'closeDB.php';  //close database connection script
			?>
		</select>
			<input type="hidden" name = table value = "biological">
		<br>
		<input type="submit" name="submit"  Value="Submit"/>
		</form>



</div><!-- /.col 6 -->

   <div id="map" class="col-sm-6" style="width:50%;height:600px;"></div>

</div><!-- /.row -->



    <script>
        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(26, -106),
          zoom: 5
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('call_maps_download.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var Name = 'Station: ' + markerElem.getAttribute('Name');
              var SID = 'ID: ' + markerElem.getAttribute('SID');
              var Sequence = 'Sequence: ' + markerElem.getAttribute('Sequence');
//              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = Name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = Sequence
              infowincontent.appendChild(text);
//              infowincontent.appendChild(document.createElement('br'));
//              var text = document.createElement('text');
//              text.textContent = Sequence
//              infowincontent.appendChild(text);

//              var icon = customLabel[type] || {};
              var icon = {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyOQwiYAJYm13tmVKHzRJxyQa-BOMIt_o &callback=initMap">
    </script>


    </div><!-- /.container -->

    </body>
</html>
