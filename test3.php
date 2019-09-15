<?php
	$a = simplexml_load_file("http://webservices.nextbus.com/service/publicXMLFeed?command=routeConfig&a=mbta&r=39");
	echo $a;
?>