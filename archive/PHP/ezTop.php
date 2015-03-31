<?PHP
	require_once("./include/membersite_config.php");
	$bool = $fgmembersite->CheckSession();
	$usrname = $fgmembersite->UsrName();
?><head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<div class="logo">
	<a href="./index.php">
		<img src="images/logo.png" onmouseover="this.src='images/logo.jpg'" onmouseout="this.src='images/logo.png'" alt="Logo" />
	</a>
</div>

<div class="search">
	<form class="form-wrap">
		<input class="box" type="text" placeholder="search for events" />
		<input class="image" type="image" src="images/btn_search.png" class="btn-search" />
	</form>
</div>

<div class="profile">
	<?PHP if($bool){ ?>
		<div class="user">
			<img src="images/sample_profile.png" alt="Profile" />
			<?PHP if(!empty($usrname)){ ?>
				<h2> <?= $usrname; ?> </h2>
			<?PHP } ?>
		</div>
	<?PHP } ?>
</div>