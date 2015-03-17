<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<html>
	<head>
		<script>
			function showHint(str) {
				if (str.length == 0) { 
					document.getElementById("txtHint").innerHTML = "";
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
					//xmlhttp.open("GET", "gethint.php?q=" + str, true);
					xmlhttp.open("GET", "getEvent.php?q=" + str, true);
					xmlhttp.send();
				}
			}
		</script>
	</head>
	
	<body>
		<p><b>Start typing a name in the input field below:</b></p>
		<form> 
			First name: <input type="text" onkeyup="showHint(this.value)">
		</form>
		<p>Suggestions: <span id="txtHint"></span></p>
	</body>
</html>