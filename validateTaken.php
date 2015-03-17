<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->

<!DOCTYPE html>
<html>
	<head>
		<title>How to check live username availability with jQuery & PHP | PGPGang.com</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#username').keyup(function(){
					var username = $(this).val(); // Get username textbox using $(this)
					var Result = $('#result'); // Get ID of the result DIV where we display the results
					if(username.length > 2) { // if greater than 2 (minimum 3)
						Result.html('Loading...'); // you can use loading animation here
						var dataPass = 'action=availability&username='+username;
						$.ajax({ // Send the username val to available.php
							type : 'POST',
							data : dataPass,
							url  : 'available.php',
							success: function(responseText){ // Get the result
								if(responseText == 0){
									Result.html('<span class="success">Available</span>');
								} else if(responseText > 0){
									Result.html('<span class="error">Taken</span>');
								} else {
									alert('Problem with sql query');
								}
							}
						});
					} else {
						Result.html('Enter atleast 3 characters');
					}
					
					if(username.length == 0){
						Result.html('');
					}
				});
			});
		</script>
		
		<style type="text/css">
			.success{ color: green; }
			.error{ color: red; }
			.content{ width:900px; margin:0 auto; }
			#username{ width:500px; border:solid 1px #000; padding:10px; font-size:14px; }
		</style>
	</head>
	
	<body>
		<div class="content">
			<table>
				<tr>
					<td>&nbsp; &nbsp; Ex: 
						<b><i>huzoorbux, phpgang or ravi</i></b><br /> 
						<input type="text" placeholder="Username" name="username" id="username" />
					</td>
					<td>
						<div class="result" id="result"></div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>