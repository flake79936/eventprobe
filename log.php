<?PHP
	require_once("./include/membersite_config.php");
	if(isset($_POST['submitted'])){
		if($fgmembersite->Login()){
			$fgmembersite->RedirectToURL("index.html");
		}
	}
?>

<link href="css/log.css" rel="STYLESHEET" type="text/css"  />
<!-- <script type="text/javascript" src="js/log.js"></script><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->

<div id="logincontainer">
<span></span><a href="" class="logbut show_hide">Login</a> |
 <a href="./reg.php" class="regbut">Register</a>
</div>
<div class="logbar">
<div class="arrow" style="border-bottom-color: #131313;"></div>

	<!-- <form action="login.php" class="loginform" method="post"  accept-charset="UTF-8" enctype="multipart/form-data"> -->
				<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
		<input type="hidden" name="action" value="do_login" />
		<input type="hidden" name="url" value="{$url}" />
		
		
		
		
			<label>Username: </label>
				<input type="text" name="UuserName" title="Enter your Username" id="UuserName"  value="<?php echo $fgmembersite->SafeDisplay('UuserName') ?>" maxlength="50" /><br/>
				<span id="register_UuserName_errorloc" class="error"></span>
<!-- 			<input type="text" name="username" value="" class="logbox"/> -->
			
			<label>Password: </label>
				<input type='password' title="Enter your Password" name='UPswd' id='UPswd' maxlength="50" /><br/>
				<span id='login_UPswd_errorloc' class='error'></span>
<!-- 			<input type="password" name="password" value="" class="logbox"/> -->

		</span>
	<br/>
	<input type='submit' name='Submit' value='Submit' />
		<!-- <input type="submit" class="logbutton" value="Login" tabindex="3" /> -->
		
<!-- 	<a href="#"> <input type="submit" value="Lost Password" name="submit" class="logbutton" /></a><br /> -->
<!-- <label class="smalltext" title="If ticked, your login details will be remembered on this computer, otherwise, you will be logged out as soon as you close your browser."> -->
<!-- <input type="checkbox" value="yes" checked="checked" name="remember" class="checkbox"> Remember?</label> -->
</form>
</div>




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
jQuery.noConflict();
  $(".logbar").hide();
  $(".logbut").addClass("plus").show();
  $('.logbut').toggle(
      function(){
          $(".logbar").slideDown().slideToggle("slow");
          $(this).addClass("plus");
          $(this).removeClass("minus");
      },
      function(){
          $(".logbar").slideUp().slideToggle("slow");
          $(this).addClass("minus");
          $(this).removeClass("plus");
      }
  );
});
</script>


	<!--This script needs to wihtin the file. 
		It is validating the form.-->
	<script type='text/javascript'>
		// <![CDATA[

		var frmvalidator  = new Validator("login");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();

		frmvalidator.addValidation("UuserName", "req", "provide your username");

		frmvalidator.addValidation("UPswd", "req", "Please provide the password");

		// ]]>
	</script>