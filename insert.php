<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Insert station data</title>
    <meta name="description" content="">
    <meta name="author" content="">
  </head>


  <body>

    <?php include_once("header.php");?>
      
    <?php
    $servername = "localhost";
    $username="root";
    $password="LIMS.2017.Uppsala";
    $dbname = "Marine";
    $thetable="Stations";

    $Sname=$_POST['Sname'];
    $Ssequence=$_POST['Ssequence'];
    $Slongitude=$_POST['Slongitude'];
    $Slatitude=$_POST['Slatitude'];

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO $thetable (Sname,Ssequence,Slongitude,Slatitude,Shidden)
    VALUES ('$Sname',$Ssequence,$Slongitude,$Slatitude,0)";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    ?>

    </body>
    
</html>
