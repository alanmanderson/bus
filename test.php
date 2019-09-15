<?php
function getFileConts($filename){
	$fh = fopen($filename, 'r');
	$theData = fread($fh, filesize($filename));
	fclose($fh);
	#if (!$theData && !strstr($theData, ".copy")){
	#	return getFileConts($filename.".copy");
	#} else {
		return $theData;
	#}
}

function makePreds(){
  $theData = getFileConts("out.log");
	$routes = json_decode($theData, true) or die();
	foreach($routes as $thing){
		foreach($thing as $route => $stops){
			echo "<table><th colspan=\"2\">$route: </th>";
			foreach($stops as $stop){
				foreach($stop as $loc => $times){
					echo "<tr><td>";
					echo "$loc:</td></tr>";
					echo "<tr><td>";
					foreach($times as $time){
						echo "$time, ";
					}
					echo "</td></tr>";
				}
			}
			echo "</table>";
		}
	}
}

function getTrainPreds(){
  $theData = getFileConts("train.log");
	$stops = json_decode($theData, true);
	echo("<table><th>stop</th><th>times(minutes)</th>");
	foreach($stops as $stop => $times){
		echo("<tr><td>$stop</td><td>");
		foreach($times as $time){
			echo "$time, ";
		}
		echo("</td></tr>");
	}
	echo("</table>");
}

function getShuttlePreds(){
	$theData = getFileConts("shuttle.log");
	$stops = json_decode($theData, true) or die();
	echo("<table><th>stop</th><th>times(minutes)</th>");
	foreach($stops as $stop => $times){
		echo("<tr><td>$stop</td><td>");
		foreach($times as $time){
			echo "$time, ";
		}
		echo("</td></tr>");
	}
	echo("</table>");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
		<meta http-equiv="refresh" content="40">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="main.css" />
		<script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.label_over.js"></script>
		<script type="text/javascript">
			function getPredictions(){		
			}
		</script>
    <title>Bus predictions</title>
  </head>
	<body onLoad="getPredictions()">
		<table width="100%"><tr><td>
			<div id="result">
			<?php makePreds();?>
			</div>
		</td>
		<td> 
			<?php getTrainPreds(); ?>
			<?php getShuttlePreds(); ?>
		</td>
		</tr></table>
	</body>
</html>