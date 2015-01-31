<?php
include("dbconnect.php");

require_once("./include/membersite_config.php");

	$usrname = $fgmembersite->UsrName();
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta charset="utf-8">
  
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="demo-header"></div>
    <div class="container">    
		<div style="text-align:center;width:100%;font-size:24px;margin-bottom:20px;color: #2875BB;">Click on the underlined words to edit them</div>
                <div class="row">
                    <table class= "table table-striped table-bordered table-hover">
                        <thead>
                            <tr>

                                <th colspan="1" rowspan="1" style="width: 180px;" tabindex="0">Event Name</th>

                                <th colspan="1" rowspan="1" style="width: 220px;" tabindex="0">Address</th>

                                <th colspan="1" rowspan="1" style="width: 288px;" tabindex="0">ZIP</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        
                        $sql = "SELECT * FROM Events  ORDER BY EstartDate";
// 						$result = mysqli_query($con, $sql);
//                         
//                         while($row = mysqli_fetch_array($result))
//                         
//                         
						$result = mysqli_query($con, $sql);
						$i=0;
						while($row = mysqli_fetch_array($result))
						{
							if($i%2==0) $class = 'even'; else $class = 'odd';
							
							echo'<tr class="'.$class.'">

                                <td><span class= "xedit" Eid="'.$row['Eid'].'">'.$row['Evename'].'</span></td>

                                <td>'.$row['Eaddress'].'</td>

                                <td>'.$row['Ezip'].'</td>
                            </tr>';							
						}
						?>
                        </tbody>
                    </table>
        </div>
		<!-- 
<footer>
            <a  href="http://www.jqueryajaxphp.com/dynamically-animate-jquery-knob">Tutorial: Live table edit using jQuery, AJAX and PHP (Twitter Bootstrap) </a>
		</footer>
 -->
		<script src="assets/js/jquery.min.js"></script> 
		<script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-editable.js" type="text/javascript"></script> 
<script type="text/javascript">
jQuery(document).ready(function() {  
        $.fn.editable.defaults.mode = 'popup';
        $('.xedit').editable();		
		$(document).on('click','.editable-submit',function(){
			var x = $(this).closest('td').children('span').attr('Eid');
			var y = $('.input-sm').val();
			var z = $(this).closest('td').children('span');
			$.ajax({
				url: "process.php?iEd="+x+"&data="+y,
				type: 'GET',
				success: function(s){
					if(s == 'status'){
					$(z).html(y);}
					if(s == 'error') {
					alert('Error Processing your Request!');}
				},
				error: function(e){
					alert('Error Processing your Request!!');
				}
			});
		});
});
</script>
    </div>
</body>
</html>