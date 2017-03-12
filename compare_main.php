<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Compare</title>
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

        <?php include_once("header.php");?>

        <?php 
				include 'db.php'; //establish database connection script

?>


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

<br><br>
</div><!-- /.center -->
</div><!-- /.container -->

   <div id="map" class="text-center" style="left: 25%; width:50%;height:400px;"></div>


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



  </body>
</html>
