<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<!---This PHP file is being used only for those users who are registered in the system.
	-All other users will not be using this Search Form.
	-There will be another form for users whom are not registered to search for events.-->

<div class="box">
	<form id='search' action='getEvent.php' method='GET' accept-charset='UTF-8'>
		<input type='text' name='q' title="Search Event" id='eventSearch' maxlength="50" placeholder="Type to search all events"/>
		<input id="submitButton" type="submit" name="Submit" placeholder="Search" />
	</form>
</div>