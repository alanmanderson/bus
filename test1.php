<?php

?>
<html>
<body>

<script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.myForm.time.value = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "http://webservices.nextbus.com/service/publicXMLFeed?command=predictionsForMultiStops&a=mbta&stops=1|1_010003v0_1|75&stops=1|1_010004v0_0|98&stops=1|1_010003v0_1|2167&stops=1|1_010003v0_1|75&stops=1|1_010003v0_1|2167&stops=1|1_010004v0_0|98&stops=747|747_7470001v0_1|2231&stops=747|747_7470001v0_1|11771&stops=747|747_7470001v0_1|22173&stops=747|747_7470002v0_0|21772&stops=747|747_7470002v0_0|21773&stops=78|78_780008v0_0|20761&stops=78|78_780005v0_0|2358&stops=78|78_780007v0_1|2326&stops=78|78_780004v0_1|2326&stops=76|76_760011v0_0|141&stops=76|76_760011v0_0|2358&stops=76|76_760010v0_1|2326&stops=76|76_760004v0_1|2326", false);
	alert("test");
	ajaxRequest.send(null); 
}

//-->
</script>



<form name='myForm'>
Name: <input type='text' onChange="ajaxFunction();" name='username' /> <br />
Time: <input type='text' name='time' />
</form>
</body>
</html>
