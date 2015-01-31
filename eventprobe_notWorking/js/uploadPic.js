<img id="uploadPreview" style="width: 100px; height: 100px;" />
<input id="uploadImage" type="file" name="myPhoto" onchange="PreviewImage();" />
<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

</script>