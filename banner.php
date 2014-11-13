<link type="text/css" href="./css/jquery.bbslider.css" rel="stylesheet" media="screen" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/jquery.bbslider.min.js"></script>

<?PHP 
$height= "528px";
$width= "1536px"?>


<div   class="bbslider-wrapper" id="auto" height="528px" width="1536px" >
    <div><img src="./banner/96502411.jpg" alt="first image" height=<?= $height ?> width=<?= $width ?>/></div>
    <div><img src="./banner/banner.jpg" alt="second image" height=<?= $height ?> width=<?= $width ?>/></div>
    <div><img src="./banner/138071106.jpg" alt="third image"height=<?= $height ?> width=<?= $width ?> /></div>
    <div><img src="./banner/banner.jpg" alt="forth image" height=<?= $height ?> width=<?= $width ?>/></div>
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
