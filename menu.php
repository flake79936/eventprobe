<?PHP require_once("./include/membersite_config.php"); 
	  $bool = $fgmembersite->CheckLogin();
	  echo $bool . " Here is the value!";
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./css/bootstrap.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<div class="dropdown clearfix">
	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-expanded="true">
		User Account
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
		<?PHP 
				echo $bool . " Value Bool";
				if($bool){ ?>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href='./EventCreation.php'>
						<span>Create Event</span>
					</a>
				</li>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href='./logout.php'>
						<span>logout</span>
					</a>
				</li>
		<?PHP } else { ?>
				<li role="presentation"><?PHP include './login.php'; ?></li>
		<?PHP } ?>
	</ul>
</div>