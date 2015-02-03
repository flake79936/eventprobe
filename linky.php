<html>
  <head>
	<script type="text/javascript" src="jquery-1.3.1.js"></script>
	<script type="text/javascript" src="jquery.form.js"></script>
	
	<script>
	    $(document).ready(function(){
		  $('a').bind('click',function(event){
			event.preventDefault();
		    $.get(this.href,{},function(response){ 
		 	   $('#response').html(response)
		    })	
		 })
		});
	</script>
  </head>
<body>

  <li><a href="response.html"/>Response</a>
	
	<div id="response"></div>
	
</body>