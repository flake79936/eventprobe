/*********================================*****************
* Live Informatin Editting System 
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
*********=================================*****************/

//This function hides the default information when clicked on it shows the editable information
function vasplus_live_edit_area(details_id)
{
	$(".vasplus_live_edit_area").css("background-color","#FFF");
	$("#detail_a"+details_id).hide();
	$("#detail_b"+details_id).hide();
	$("#detail_c"+details_id).hide();
	$("#detail_aa"+details_id).show();
	$("#detail_bb"+details_id).show();
	$("#detail_cc"+details_id).show();
	$("#Eid"+details_id).css("background-color","#F6F6F6");
	
}

//This function hides the editable information when press the Enter Key on your computer keyboard and shows the editted and saved info
$(document).bind('keydown', function(vpb_event)
{
	//Press the enter key to hide the edit boxes
	if(vpb_event.keyCode == 13 && vpb_event.shiftKey == 0)
	  {
		$(".vasplus_hidden_boxes").hide();
		$(".vasplus_live_content").show();
		$(".vasplus_live_edit_area").css("background-color","#FFF");
	  }
});

//This function is responsible for saving all changes made to information or contents
$(document).ready(function()
{
	$(".vasplus_live_edit_area").bind('change', function()
	{
		var details_id =  $(this).attr('id').replace('id','');	
		var detail_aa = $("#detail_aa"+details_id).val();
		var detail_bb = $("#detail_bb"+details_id).val();
		var detail_cc = $("#detail_cc"+details_id).val();
		
		var dataString = 'id=' + details_id + '&Evename=' + detail_aa + '&Ewebsite='+detail_bb + '&Efacebook='+detail_cc;
		
		if(detail_aa != "" && detail_bb != "" && detail_cc != "")
		{
			$.ajax({
				type: "POST",
				url: "save_changes.php",
				data: dataString,
				cache: false,
				beforeSend: function()
				{
					$("#detail_a"+details_id).html('<img src="load.gif" />');
				},
				success: function() 
				{
					$("#detail_a"+details_id).html(detail_aa);
					$("#detail_b"+details_id).html(detail_bb);
					$("#detail_c"+details_id).html(detail_cc);
				}
			});
		}
		else
		{
			alert('That field can not be completely empty. Please enter some content. Thanks...');
			return false;
		}
	});
});