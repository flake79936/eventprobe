<?PHP
require_once("./include/membersite_config.php"); 
$bool = $fgmembersite->CheckSession();
 
if(isset($_POST['hSubmitted'])){
if($fgmembersite->Login()){
$fgmembersite->RedirectToURL("./index.php");
}
}
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./css/bootstrap.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!--'Login' Scripts and Styles-->
<meta charset="utf-8"/>
<title>Eventprobe</title>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" media="all" href=""/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

<!--STYLE-->
<!-- <link rel="stylesheet" type="text/css" href="./css/login.css" /> -->

<!--FAVICON-->
<link rel="shortcut icon" href="favicon.ico"  />

<!--Other Scripts-->
<script type="text/javascript" src="./scripts/gen_validatorv31.js"></script>



<link rel="stylesheet" href="./css/bootstrap.min.css">

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">      
      <div class="nav-collapse">
        <ul class="nav">

          <!-- here comes the important part -->
 
           <li class="dropdown" id="menu1">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
               Login
                <b class="caret"></b>
             </a>
             <div class="dropdown-menu">
<!--                <form style="margin: 0px" accept-charset="UTF-8" action="/sessions" method="post"> -->
               <form style="margin: 0px" id="login" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">

				<div class="login">


					   		<div style="margin:0;padding:0;display:inline">
						    	<input name="utf8" type="hidden" value="&#x2713;" />
					   			<input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" />
					   		</div>
						 <fieldset class='textbox' style="padding:10px">
						 	  <input style="margin-top: 8px" name="UuserName" type="text" placeholder="Username" id="UuserName"  />
						   		<br>
						   	  <input style="margin-top: 8px" type="password" name='UPswd' placeholder="Passsword" id='UPswd' />
				   
                   </div>
                   
                   <input class="btn-primary" input id="submitButton" type="submit" name="Submit" value="Login" />
                   <br>
                   <a style="margin-top: 8px" href="https://www.facebook.com/dialog/oauth?client_id=861882643830735&amp;redirect_uri=http://www.eventprobe.com/?fbTrue=true">
					<img src="./images/login-button.png" alt="Sign in with Facebook"></a>
                 </fieldset>
               </form>
             </div>
           </li>
 
        </ul>
      </div>
    </div>
  </div>
</div>

<!--This script needs to wihtin the file. 
	It is validating the form.-->
<script type='text/javascript'>
	// <![CDATA[
	var frmvalidator  = new Validator("login");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("UuserName", "req", "Provide Your Username");

	frmvalidator.addValidation("UPswd", "req", "Provide Your Password");

	// ]]>
</script>

<script src="./js/jquery-1.11.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script language="javascript">
    $('.dropdown-toggle').dropdown();
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
      });
</script>