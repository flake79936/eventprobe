jQuery(document).ready(function($){
  $(".logbar").hide();
  $(".logbut").addClass("plus").show();
  $('.logbut').toggle(
      function(){
          $(".logbar").slideDown().slideToggle("fast");
          $(this).addClass("plus");
          $(this).removeClass("minus");
      },
      function(){
          $(".logbar").slideUp().slideToggle("fast");
          $(this).addClass("minus");
          $(this).removeClass("plus");
      }
  );
});