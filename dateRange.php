
<html lang="en">



  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="./css/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ 
    showOn: "button",
      buttonImage: "./images/calendar.png",
      buttonImageOnly: true,
      minDate: 0,
       maxDate: "+1M +10D" });
  });
  </script>

 <?PHP  ?>   
<input type="text" id="datepicker" readonly="readonly">
 <?PHP ?>
 

</html>