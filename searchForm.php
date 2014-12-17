<!---This PHP file is being used only for those users who are registered in the system.
	-All other users will not be using this Search Form.
	-There will be another form for users whom are not registered to search for events.-->

<?PHP require_once("./include/membersite_config.php"); ?>

<html>
	<head>
		<link />
	</head>

	<body>
		<form id='search' action='result.php' method='GET' accept-charset='UTF-8'>
			<input type='text' name='eventSearch' title="Search" id='eventSearch' value='<?php //echo $fgmembersite->SafeDisplay('eventSearch') ?>' maxlength="50" />
			<span id='search_eventSearch_errorloc' class='error'></span>
			<input id="submitButton" type="submit" name="Submit" value="Search" />
		</form>
	</body>
</html>