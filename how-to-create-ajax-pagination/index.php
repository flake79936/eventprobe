<?php
$content = '<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
<style type="text/css">
ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px \'Tahoma\'; list-style-type:none; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }
ul.tsc_pagination li:first-child { margin-left:0px; }
ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }
ul.tsc_pagination li a img { border:none; }

ul.tsc_paginationC li a { color:#707070; background:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; border:solid 1px #DCDCDC; padding:6px 9px 6px 9px; }
ul.tsc_paginationC li { padding-bottom:1px; }
ul.tsc_paginationC li a:hover,
ul.tsc_paginationC li a.current { color:#FFFFFF; box-shadow:0px 1px #EDEDED; -moz-box-shadow:0px 1px #EDEDED; -webkit-box-shadow:0px 1px #EDEDED; }
ul.tsc_paginationC li a.In-active { pointer-events: none; cursor: default; }

ul.tsc_paginationC01 li a:hover,
ul.tsc_paginationC01 li a.current { color:#893A00; text-shadow:0px 1px #FFEF42; border-color:#FFA200; background:#FFC800; background:-moz-linear-gradient(top, #FFFFFF 1px, #FFEA01 1px, #FFC800); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #FFEA01), color-stop(1, #FFC800)); }
</style>

	<script type="text/javascript">
		function changePagination(pageId,liId){
			$(".flash").show();
			$(".flash").fadeIn(400).html(\'Loading <img src="image/ajax-loading.gif" />\');
			var dataString = \'pageId=\'+ pageId;
			$.ajax({
			type: "POST",
			url: "loadData.php",
			data: dataString,
			cache: false,
			success: function(result){
			$(".flash").hide();
			$(".link a").removeClass("In-active current") ;
			$("#"+liId+" a").addClass( "In-active current" );
			$("#pageData").html(result);
			}
			});
		}
	</script>';

	include_once('db.php');
	include_once('function.php');
	$query = "SELECT id FROM pagination ORDER BY id DESC;";
	$res = mysql_query($query);
	$count = mysql_num_rows($res);
	
	if($count > 0){
		$paginationCount = getPagination($count);
	}

	$content .= '<div id="pageData"></div>';
	
	if($count > 0){
		$content .= '<ul class="tsc_pagination tsc_paginationC tsc_paginationC01">
		<li class="first link" id="first">
		<a href="javascript:void(0)" onclick="changePagination(\'0\',\'first\')">F i r s t</a>
		</li>';
		
		for($i = 0; $i < $paginationCount; $i++){
			$content .= '<li id="'.$i.'_no" class="link">
			<a  href="javascript:void(0)" onclick="changePagination(\''.$i.'\',\''.$i.'_no\')">' . ($i+1) . '</a>
			</li>';
		}

		$content .= '<li class="last link" id="last">
		<a href="javascript:void(0)" onclick="changePagination(\''.($paginationCount-1).'\',\'last\')">L a s t</a>
		</li>
		<li class="flash"></li>
		</ul>';
	}
	
	$pre = 1;
	$title = "How to create pagination in PHP and MySQL with AJAX";
	$heading = "How to create pagination in PHP and MySQL with AJAX example.";
	include("html.inc");           
?>