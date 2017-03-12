<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Compare</title>
        <meta name="description" content="">
        <meta name="author" content="">
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    </head>

<body>

        <?php include_once("header.php");?>

<div class="container">
  
      <div class="text-center">
      <h1>Marine compare stations</h1>
      <p class="lead">Compare</p>
	  </div><!-- /.center -->


	<?php
	if(isset($_POST['submit'])){
	$group1 = $_POST['group1'];
	$group2 = $_POST['group2'];
	$stations = array_merge($group1, $group2);}
	include("db.php");
    ?>

<!-- /. HEADING  -->
      <div class="col-sm-6"><h3>Group 1</h3>
		<div class="col-sm-4"><h4>Physical</h4></div>
		<div class="col-sm-4"><h4>Biological</h4></div></div>

      <div class="col-sm-6"><h3>Group 2</h3>
		<div class="col-sm-4"><h4>Physical</h4></div>
		<div class="col-sm-4"><h4>Biological</h4></div> </div>

	<br><br><br><br><br>


<!-- /. start collapse  -->
<div class="panel-group">

<!-- /. start ENTRY-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse50">Stratum 0-50</a>
        </h4>
      </div>
      <div id="collapse50" class="panel-collapse collapse">


<!-- /. 5 mt  -->
	<div class="row">
		<div class="col-sm-6">
			<div class="col-sm-4">
				   <?php
					   if(!empty($_POST['group1'])) {


						$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group1) ."') AND Pdepth < 5
						;
						";
						   if (mysqli_query($conn, $sql)) {
						   $resultf1_1 = mysqli_query($conn, $sql);
						    while($row = mysqli_fetch_assoc($resultf1_1)) {
						        echo "<br> Depth " . round($row['depth'],2)."";
						        echo "<br> Temperature " . round($row['temp'],2)."";
						        echo "<br> Salinity " . round($row['sal'],2)."";
						        echo "<br> Oxygen " . round($row['oxy'],2)."";
						        echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy1 = $row;
							}
						   } 
						}
        		  ?>
			</div>
			<div class="col-sm-12"> 
			</div>
		</div>


		<div class="col-sm-6">
			<div class="col-sm-4">
				   <?php
					   if(!empty($_POST['group2'])) {


						$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group2) ."') AND Pdepth < 5
						;
						";
						   if (mysqli_query($conn, $sql)) {
						   $resultf1_2 = mysqli_query($conn, $sql);
						    while($row = mysqli_fetch_assoc($resultf1_2)) {
						        echo "<br> Depth " . round($row['depth'],2)."";
						        echo "<br> Temperature " . round($row['temp'],2)."";
						        echo "<br> Salinity " . round($row['sal'],2)."";
						        echo "<br> Oxygen " . round($row['oxy'],2)."";
						        echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy2 = $row;
							}
						   } 
						}
		          ?>
			</div>
			<div class="col-sm-12">
			</div>
		</div>
	</div><!-- /.row 5mt -->



<!-- /. 50  -->

	<div class="row">
		<div class="col-sm-6">
		<!-- /. Group 1  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group1'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group1) ."') AND Pdepth BETWEEN 6 AND 50
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf2_1 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf2_1)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy1 = array_merge_recursive($phy1,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group1'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 

//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 


//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 


// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 50 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 1  -->


		<div class="col-sm-6">
		<!-- /. Group 2  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group2'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group2) ."') AND Pdepth BETWEEN 6 AND 50
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf2_2 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf2_2)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy2 = array_merge_recursive($phy2,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group2'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 

//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 


//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 50 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 2  -->
	</div><!-- /.row -->









      </div><!-- /. collapse50-->
    </div><!-- /. panel defaul 50-->

<!-- /. end ENTRY-->





<!-- /. start ENTRY-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse100">Stratum 50-100</a>
        </h4>
      </div>
      <div id="collapse100" class="panel-collapse collapse">






<!-- /. 100  -->

	<div class="row">
		<div class="col-sm-6">
		<!-- /. Group 1  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group1'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group1) ."') AND Pdepth BETWEEN 51 AND 100
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf3_1 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf3_1)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy1 = array_merge_recursive($phy1,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group1'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 

//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 


//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 100 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 1  -->


		<div class="col-sm-6">
		<!-- /. Group 2  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group2'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group2) ."') AND Pdepth BETWEEN 51 AND 100
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf3_2 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf3_2)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy2 = array_merge_recursive($phy2,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group2'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 

//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 



//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 100 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 2  -->
	</div><!-- /.row -->









      </div><!-- /. collapse100-->
    </div><!-- /. panel defaul 100-->

<!-- /. end ENTRY-->



<!-- /. start ENTRY-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse150">Stratum 100-150</a>
        </h4>
      </div>
      <div id="collapse150" class="panel-collapse collapse">


<!-- /. 150  -->

	<div class="row">
		<div class="col-sm-6">
		<!-- /. Group 1  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group1'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group1) ."') AND Pdepth BETWEEN 101 AND 150
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf4_1 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf4_1)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy1 = array_merge_recursive($phy1,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group1'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 


//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 





//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 150 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 1  -->


		<div class="col-sm-6">
		<!-- /. Group 2  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group2'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group2) ."') AND Pdepth BETWEEN 101 AND 150
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf4_2 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf4_2)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy2 = array_merge_recursive($phy2,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group2'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 



//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 



//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 150 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 2  -->
	</div><!-- /.row -->


      </div><!-- /. collapse150-->
    </div><!-- /. panel defaul 150-->

<!-- /. end ENTRY-->




<!-- /. start ENTRY-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse200">Stratum 150-200</a>
        </h4>
      </div>
      <div id="collapse200" class="panel-collapse collapse">


<!-- /. 200  -->

	<div class="row">
		<div class="col-sm-6">
		<!-- /. Group 1  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group1'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group1) ."') AND Pdepth BETWEEN 151 AND 200
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf5_1 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf5_1)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy1 = array_merge_recursive($phy1,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group1'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 


//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 



//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Bstratummax = 200 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 1  -->


		<div class="col-sm-6">
		<!-- /. Group 2  -->
			<div class="col-sm-4">
			<!-- /. physical  -->
				<?php
				if(!empty($_POST['group2'])) {
					$sql = "SELECT AVG(Pdepth) AS depth, AVG(Ptemperature) AS temp, AVG(Psalinity) AS sal, AVG(Poxygen) AS oxy, AVG(Pfluorescence) AS flu FROM Physical WHERE Pstationname IN ('" . implode("','", $group2) ."') AND Pdepth BETWEEN 151 AND 200
					;
					";
					if (mysqli_query($conn, $sql)) {
						$resultf5_2 = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($resultf5_2)) {
							echo "<br><br>Depth " . round($row['depth'],2)."";
							echo "<br> Temperature " . round($row['temp'],2)."";
							echo "<br> Salinity " . round($row['sal'],2)."";
							echo "<br> Oxygen " . round($row['oxy'],2)."";
							echo "<br> Fluorescence " . round($row['flu'],2)."";
							$phy2 = array_merge_recursive($phy2,$row);
							}
						} 
					}
				?>
			</div>
			<div class="col-sm-8">
			<!-- /. biological  -->
				<?php
// Total
				if(!empty($_POST['group2'])) {
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br>Total (". round($row['sum']).")";
						}
					} 



//	flex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('flex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Flex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('flex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 




//	preflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('preflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Preflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('preflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// posflex
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('posflex')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Posflex (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('posflex') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 

// trans
					$sql = "SELECT sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('trans')
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br><br> Trans (". round($row['sum']).")";
						}
					} 

					$sql = "SELECT Bspecies, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Bstratummax = 200 AND Blarvastage IN ('trans') GROUP BY Bspecies
					;
					";
					if (mysqli_query($conn, $sql)) {
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<br>" . $row['Bspecies']." (" . round($row['sum']).")";
						}
					} 
				}
				?>
			</div><!-- /. biological  -->
		</div><!-- /. Group 2  -->
	</div><!-- /.row -->


      </div><!-- /. collapse200-->
    </div><!-- /. panel defaul 200-->

<!-- /. end ENTRY-->

</div><!-- /. panel grouping-->


</div><!-- /.container -->

<br>  

<?php
if(!empty($_POST['group1'])) {

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$total1 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$total1 = array_merge_recursive($total1,$row);
						}
					} else {echo "sql problem";}


					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Blarvastage IN ('preflex') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$preflex1 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$preflex1 = array_merge_recursive($preflex1,$row);
						}
					} else {echo "sql problem";}

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Blarvastage IN ('flex') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$flex1 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$flex1 = array_merge_recursive($flex1,$row);
						}
					} else {echo "sql problem";}

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Blarvastage IN ('posflex') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$posflex1 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$posflex1 = array_merge_recursive($posflex1,$row);
						}
					} else {echo "sql problem";}

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group1) ."') AND Blarvastage IN ('trans') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$trans1 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$trans1 = array_merge_recursive($trans1,$row);
						}
					} else {echo "sql problem";}



					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$total2 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$total2 = array_merge_recursive($total2,$row);
						}
					} else {echo "sql problem";}


					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Blarvastage IN ('preflex') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$preflex2 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$preflex2 = array_merge_recursive($preflex2,$row);
						}
					} else {echo "sql problem";}

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Blarvastage IN ('flex') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$flex2 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$flex2 = array_merge_recursive($flex2,$row);
						}
					} else {echo "sql problem";}

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Blarvastage IN ('posflex') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$posflex2 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$posflex2 = array_merge_recursive($posflex2,$row);
						}
					} else {echo "sql problem";}

					$sql = "SELECT Bstratummax AS depth, sum(Babundance) AS sum FROM Biological WHERE Bstationname IN ('" . implode("','", $group2) ."') AND Blarvastage IN ('trans') GROUP BY Bstratummax ;";
					if (mysqli_query($conn, $sql)) {
						$trans2 = array();						
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$trans2 = array_merge_recursive($trans2,$row);
						}
					} else {echo "sql problem";}
}

?>


<!-- /.PLOT -->
<div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-6">
  <div align="center" id="myDiv" style="width: 60%; height: 400px;"><!-- Plotly chart will be drawn inside this DIV -->
  <script>
var Depth1 = [<?php echo '"'.implode('","', $phy1['depth']).'"' ?>];
var Depth2 = [<?php echo '"'.implode('","', $phy2['depth']).'"' ?>];
var Temp1 = [<?php echo '"'.implode('","', $phy1['temp']).'"' ?>];
var Temp2 = [<?php echo '"'.implode('","', $phy2['temp']).'"' ?>];
var Sal1 = [<?php echo '"'.implode('","', $phy1['sal']).'"' ?>];
var Sal2 = [<?php echo '"'.implode('","', $phy2['sal']).'"' ?>];
var Oxy1 = [<?php echo '"'.implode('","', $phy1['oxy']).'"' ?>];
var Oxy2 = [<?php echo '"'.implode('","', $phy2['oxy']).'"' ?>];
var Flu1 = [<?php echo '"'.implode('","', $phy1['flu']).'"' ?>];
var Flu2 = [<?php echo '"'.implode('","', $phy2['flu']).'"' ?>];


var Depth3 = [<?php echo '"'.implode('","', $total1['depth']).'"' ?>];
var Depth4 = [<?php echo '"'.implode('","', $total2['depth']).'"' ?>];
var Tot1 = [<?php echo '"'.implode('","', $total1['sum']).'"' ?>];
var Tot2 = [<?php echo '"'.implode('","', $total2['sum']).'"' ?>];


var trace1 = {
  x: Depth1,
  y: Temp1,
  name: 'Temp 1',
  mode: 'lines',
  line: {
    dash: 'solid',
    width: 1,
	color: '#1f77b4'
  }
};

var trace2 = {
  x: Depth2,
  y: Temp2,
  name: 'Temp 2',
  mode: 'lines',
  line: {
    dash: 'dashdot',
    width: 1,
	color: '#1f77b4'
  }
};

var trace3 = {
  x: Depth1,
  y: Sal1,
  name: 'Sal 1',
  yaxis: 'y2',
  mode: 'lines',
  line: {
    dash: 'solid',
    width: 1,
	color: '#ff7f0e'
  }
};

var trace4 = {
  x: Depth2,
  y: Sal2,
  name: 'Sal 2',
  yaxis: 'y2',
  mode: 'lines',
  line: {
    dash: 'dashdot',
    width: 1,
	color: '#ff7f0e'
  }
};

var trace5 = {
  x: Depth1,
  y: Oxy1,
  name: 'Oxy 1',
  yaxis: 'y3',
  mode: 'lines',
  line: {
    dash: 'solid',
    width: 1,
	color: '#d62728'
  }
};

var trace6 = {
  x: Depth2,
  y: Oxy2,
  name: 'Oxy 2',
  yaxis: 'y3',
  mode: 'lines',
  line: {
    dash: 'dashdot',
    width: 1,
	color: '#d62728'
  }
};

var trace7 = {
  x: Depth1,
  y: Flu1,
  name: 'Flu 1',
  yaxis: 'y4',
  mode: 'lines',
  line: {
    dash: 'solid',
    width: 1,
	color: '#9467bd'
  }
};

var trace8 = {
  x: Depth2,
  y: Flu2,
  name: 'Flu 2',
  yaxis: 'y4',
  mode: 'lines',
  line: {
    dash: 'dashdot',
    width: 1,
	color: '#9467bd'
  }

};

var trace9 = {
  x: Depth3,
  y: Tot1,
  name: 'Total larvae 1',
  yaxis: 'y5',
  mode: 'markers',
    marker:{symbol: 'cross',
			color:'black'}
};

var trace10 = {
  x: Depth4,
  y: Tot2,
  name: 'Total larvae 2',
  yaxis: 'y5',
  mode: 'markers',
  marker:{symbol: 'star',
			color:'black'}

};


var data = [trace1, trace2, trace3, trace4, trace5, trace6, trace7, trace8, trace9, trace10];

var layout = {
  title: 'Group 1 vs Group 2',
  width: 900,
  xaxis: {domain: [0.2, 0.8],
			range : [0,201],
			zeroline : false,
			title:'Depth'},
  yaxis: {
    title: 'Temperature',
    titlefont: {color: '#1f77b4'},
    tickfont: {color: '#1f77b4'}
  },
  yaxis2: {
    title: 'Salinity',
    titlefont: {color: '#ff7f0e'},
    tickfont: {color: '#ff7f0e'},
    anchor: 'free',
    overlaying: 'y',
    side: 'left',
    position: 0.1
  },
  yaxis3: {
    title: 'Oxygen',
    titlefont: {color: '#d62728'},
    tickfont: {color: '#d62728'},
    anchor: 'x',
    overlaying: 'y',
    side: 'right'
  },
  yaxis4: {
    title: 'Fluorescence',
    titlefont: {color: '#9467bd'},
    tickfont: {color: '#9467bd'},
    anchor: 'free',
    overlaying: 'y',
    side: 'right',
    position: 0.9
  },
  yaxis5: {
    title: 'Abundance of larvae',
    anchor: 'free',
    overlaying: 'y',
    side: 'left',
    position: 0
  }


};



Plotly.newPlot('myDiv', data,layout);


  </script>
	</div> <!-- plotly-->


	</div><!--column for ploytly -->

   <div id="map" class="col-sm-4" style="left:10%; width:25%;height:400px;"></div>


</div><!-- row -->


    <script>
var g1 = [<?php echo '"'.implode('","', $group1).'"' ?>];
var g2 = [<?php echo '"'.implode('","', $group2).'"' ?>];





var tma = {
    label : "1",
    mmarker  : "http://maps.google.com/mapfiles/ms/micons/green.png"
};

var tmb = {
    label : "2",
    mmarker  : "http://maps.google.com/mapfiles/ms/micons/red.png"
};

var tmc = {
    mmarker  : "https://maps.gstatic.com/intl/en_ALL/mapfiles/markers2/measle.png"
};


var customLabel = new Object();


   for (i = 0; i < g1.length; i++) { 
customLabel[g1[i]] = tma;
		}

   for (i = 0; i < g1.length; i++) { 
customLabel[g2[i]] = tmb;
		}



        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(29, -113),
          zoom: 7
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('call_maps_compare.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var Name = markerElem.getAttribute('Name');
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
			  var icon = customLabel[Name] || tmc;
              var marker = new google.maps.Marker({
                map: map,
                position: point,
			    icon: icon.mmarker,
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





	<?php
	include 'closeDB.php';
	?>





  </body>
</html>
