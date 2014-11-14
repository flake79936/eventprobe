<?PHP require_once("./include/membersite_config.php"); ?>

<link rel="stylesheet" href="./css/dropDownMenu.css" type="text/css" media="screen">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<div class="example">
    <div class="menu">
        <span>
            <ul id="nav">
                <li><a href="#"><img onmouseout="this.src='./images/btn_arrow_right.png';" onmouseover="this.src='./images/btn_arrow_down_black.png';" src="./images/btn_arrow_right.png" alt="Dropdown" /></a>
                    <div class="subs">
                        <div class="wrp1">
                            <ul>
								<li>
									<?PHP //if(!$fgmembersite->CheckLogin()){ ?>
									<ul>
										<?PHP include './login.php'; ?>
									</ul>
									<?PHP //} elseif($fgmembersite->CheckLogin()){?>
									<ul>
										<li><a href='./EventCreation.php'><span>Create Event</span></a>
										<li><a href='./logout.php'><span>logout</span></a>
									</ul>
									<?PHP //}?>
								</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="#">Resources</a>
                    <div class="subs">
                        <div class="wrp2">
                            <ul>
                                <li><h3>Submenu #4</h3>
                                    <ul>
                                        <li><a href="#">Link 1</a></li>
                                        <li><a href="#">Link 2</a></li>
                                        <li><a href="#">Link 3</a></li>
                                        <li><a href="#">Link 4</a></li>
                                        <li><a href="#">Link 5</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </span>
    </div>
</div>
	

<script type="text/javascript">
jQuery(window).load(function() {
    $("#nav > li > a").click(function (e) { // binding onclick
        if ($(this).parent().hasClass('selected')) {
            $("#nav .selected div div").slideUp(100); // hiding popups
            $("#nav .selected").removeClass("selected");
        } else {
            $("#nav .selected div div").slideUp(100); // hiding popups
            $("#nav .selected").removeClass("selected");

            if ($(this).next(".subs").length) {
                $(this).parent().addClass("selected"); // display popup
                $(this).next(".subs").children().slideDown(200);
            }
        }
        e.stopPropagation();
    }); 

    $("body").click(function () { // binding onclick to body
        $("#nav .selected div div").slideUp(100); // hiding popups
        $("#nav .selected").removeClass("selected");
    }); 
});
</script>