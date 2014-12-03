<?PHP
echo"<script language=\"javascript\" type=\"text/javascript\"> 
<!--  
//Browser Support Code 
function ajaxFunction(body){ 
    var ajaxRequest;  // The variable that makes Ajax possible! 
     
    try{ 
        // Opera 8.0+, Firefox, Safari 
        ajaxRequest = new XMLHttpRequest(); 
    } catch (e){ 
        // Internet Explorer Browsers 
        try{ 
            ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\"); 
        } catch (e) { 
            try{ 
                ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\"); 
            } catch (e){ 
                // Something went wrong 
                alert(\"Your browser broke!\"); 
                return false; 
            } 
        } 
    } 
    // Create a function that will receive data sent from the server 
    ajaxRequest.onreadystatechange = function(){ 
        if(ajaxRequest.readyState == 4){ 
            var ajaxDisplay = document.getElementById('ajaxdata'); 
            ajaxDisplay.innerHTML = ajaxRequest.responseText; 
        } 
    } 
     
    ajaxRequest.open(\"GET\", \"fursona_pro.php?action=item&body=\" + body, true); 
    ajaxRequest.send(null);  
} 

//--> 
</script>"; 
echo"<table width='600' cellpadding='1' cellspacing='1' bgcolor='$border2'><tr bgcolor='$colour2'><td><center>Fursona Creation</center></td></tr> 
<tr bgcolor='$colour3'><td> 

<table width='600' cellpadding='0' cellspacing='0'><tr><td width='150' valign='top'> 

<div id='ajaxdata'>imagehere</div></td><td valign='top'> 
Commands<br><br><br> 
<input type='submit' onClick='ajaxFunction(\"male\")' value='Male'>  
<input type='submit' onClick='ajaxFunction(\"female\")' value='Female'></td></tr></table></td></tr></table>";
?>