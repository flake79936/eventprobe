<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Refresh Page itself</title>
		<script type="text/javascript" src="jquery.js"></script>
		<script>
			$(document).ready(function(){
				var callAjax = function(){
					$.ajax({
						method:'GET',
						url:'random.php',
						success:function(data){
							$("#sample").html(data);
						}
					});
				}
				setInterval(callAjax, 2000); //2 secs
			});
			
			
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	
	<body>
		<?php
			print "Below number changes in 2 seconds interval, View-Source of this page to see the usuage of jquery for content refresh.<div id='sample'>100 </div>";
		?>
	</body>
</html>