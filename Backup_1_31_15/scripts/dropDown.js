( function( $ ) {
$( document ).ready(function() {
	$('#cssmenu').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
			menu.set
		}
		else {
			menu.addClass('open');
		}
	});
});
} )( jQuery );
