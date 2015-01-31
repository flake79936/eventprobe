<script>
function updatePic(str){
	var xmlhttp;
	if (str == ""){
		document.getElementById("myDiv").innerHTML = " please select a picture to upload.";
		return;
	}
	
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET", "update.php?Eflyer="+str, true);
	xmlhttp.send();
}
</script>

<div class="dashboard">
	<div class="user-profile">
		<div class="update-image">
			<!--image upload-->
			<form action="">
				<h5>Update Image</h5>
				<input type="file" name="Eflyer" id="Eflyer" title="512 kB max" value="<?php echo $fgmembersite->SafeDisplay('Eflyer') ?>" alt="Image-upload"/>
				<br/><br/>
				<input type="submit" onclick="updatePic(this.value)" value="Update Picture"/>
			</form>
		</div>
		<div id="myDiv"></div>
		<!--<img id="" src="images/profile-img.jpg" alt="Profiles">-->
	</div>
</div>