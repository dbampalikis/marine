<?php

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server
include 'db.php';


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM Stations where Shidden = 0";
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}


header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = mysqli_fetch_assoc($result)){
	//Add to XML document node
	$node = $dom->createElement("marker");
	$newnode = $parnode->appendChild($node);
	$newnode->setAttribute("SID",$row['SID']);
	$newnode->setAttribute("Name",$row['Sname']);
	$newnode->setAttribute("lat",$row['Slatitude']);
	$newnode->setAttribute("lng",$row['Slongitude']);
	$newnode->setAttribute("Sequence",$row['Ssequence']);
}

echo $dom->saveXML();

include 'closeDB.php'; 

?>
