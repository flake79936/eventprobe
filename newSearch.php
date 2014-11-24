	<?PHP
	require_once("./include/membersite_config.php");
	//assuming the user is registered
	if(!$fgmembersite->CheckLogin()){
		$fgmembersite->RedirectToURL("index.php");
		exit;
	}
	
	if(isset($_POST["submitted"])){
		$result = $fgmembersite->searchEvent();
// 		header("Location: result.php?result=$result");
	}
?>
	
				<form id='search' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='POST' accept-charset='UTF-8'>
						<input type='hidden' name='submitted' id='submitted' value='1'/>
						
						<div>
							<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
						</div>
						
						<div class='container'>

							<input type='text' name='eventSearch' title="Search" id='eventSearch' value='<?php echo $fgmembersite->SafeDisplay('eventSearch') ?>' maxlength="50" /><br/>
							<span id='search_eventSearch_errorloc' class='error'></span>
						</div>
						
						<input id="submitButton" type="submit" name="Submit" value="Search" />
				</form>
				
				
					<!--This script needs to wihtin the file. 
		It is validating the form.-->
	<script type="text/javascript">
		// <![CDATA[
		var frmvalidator = new Validator("search");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("eventSearch", "req", "Search Field is Empty!");
		// ]]>
	</script>