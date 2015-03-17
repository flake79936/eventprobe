<script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>

$(document).ready(function() {
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true,
			heightStyle: "content",
			active: false,
		});
		
		$( "#accordion2" ).accordion({
			collapsible: true,
			heightStyle: "content",
			active: false,
		});
	});  
});