<link type="text/css" href="./css/jquery.bbslider.css" rel="stylesheet" media="screen" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/jquery.bbslider.min.js"></script>



<div  style="height: 338px;" class="bbslider-wrapper" id="auto">>
    <div><img src="./banner/96502411.jpg" alt="first image" /></div>
    <div><img src="./banner/131645522.jpg" alt="second image" /></div>
    <div><img src="./banner/138071106.jpg" alt="third image" /></div>
    <div><img src="./banner/143177148.jpg" alt="forth image" /></div>
    <div><img src="./banner/143921954.jpg" alt="fifth image" /></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#auto').bbslider({
        auto: true,
        timer:3000,
        loop:true
    });
});
</script>
<!-- 

<img src="images/banner.jpg" alt="Banner" />
 -->