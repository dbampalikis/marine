<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Insert biological data</title>
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
    $thetable="Biological";

    //$Bstationname=$_POST['Bstationname'];
    $Bstationname=$_POST['station_forbiological'];
    $Bstratummin=$_POST['Bstratummin'];
    $Bstratummax=$_POST['Bstratummax'];
    $Bx=$_POST['Bx'];
    $B_y=$_POST['B_y'];
    $Blarvastage=$_POST['Blarvastage'];
    $Bspecies=$_POST['Bspecies'];
    $Babundance=$_POST['Babundance'];


    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO $thetable (Bstationname,Bstratummin,Bstratummax,Bx,B_y,Blarvastage,Bspecies,Babundance,Bhidden)
    VALUES ('$Bstationname[0]',$Bstratummin,$Bstratummax,$Bx,$B_y,'$Blarvastage','$Bspecies',$Babundance,0)";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    ?>
      
    </body>
    
</html>
