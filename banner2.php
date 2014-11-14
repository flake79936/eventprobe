<!-- 
<link type="text/css" href="./css/jquery.bbslider.css" rel="stylesheet" media="screen" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/jquery.bbslider.min.js"></script>
 -->

<?PHP 
$height= "528px";
$width= "1536px";
?>

    <link rel="stylesheet" href="./css/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="./css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="./css/slider.css" type="text/css" media="screen" />

    <div id="wrapper">
    
        <!-- The slider wrapper div  -->
        <div class="slider-wrapper theme-default"  height="528px" width="1536px">
            <div id="slider" class="nivoSlider" >
            
                <!--  Images to slide through.  -->

                <img src="./banner/banner.jpg"  alt="" height="528px" width="1536px"  />
<!--                 <a href="http://dev7studios.com"><img src="images/up.jpg" data-thumb="images/up.jpg" alt="" title="This is an example of a caption" /></a> -->
                <img src="./banner/131645522.jpg"  alt="" height="528px" width="1536px" data-transition="slideInLeft" />
                <img src="./banner/138071106.jpg"  alt="" height="528px" width="1536px" data-transition="slideInLeft" />
            </div>
            
            <!--  Captions to show for images  -->
<!--             <div id="htmlcaption" class="nivo-html-caption"> -->
            </div>
        </div>

    </div>
    
    <!--  Load the javascript files  -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    //<!--  Load the slider  --> 
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    
    </script>
<!-- 



<div   class="bbslider-wrapper" id="auto" height="528px" width="1536px" >
    <div><img src="./banner/96502411.jpg" alt="first image" height=<?= $height ?> width=<?= $width ?>/></div>
    <div><img src="./banner/131645522.jpg" alt="second image" height=<?= $height ?> width=<?= $width ?>/></div>
    <div><img src="./banner/138071106.jpg" alt="third image"height=<?= $height ?> width=<?= $width ?> /></div>
    <div><img src="./banner/143177148.jpg" alt="forth image" height=<?= $height ?> width=<?= $width ?>/></div>
    <div><img src="./banner/143921954.jpg" alt="fifth image" height=<?= $height ?> width=<?= $width ?>/></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#auto').bbslider({
        auto: true,
        timer:4000,
        loop:true
    });
});
</script>
 -->
