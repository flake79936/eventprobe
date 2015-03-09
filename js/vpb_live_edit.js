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
	$("#detail_d"+details_id).hide();
	$("#detail_e"+details_id).hide();
	$("#detail_f"+details_id).hide();
	$("#detail_g"+details_id).hide();
	$("#detail_h"+details_id).hide();
	$("#detail_i"+details_id).hide();
	$("#detail_j"+details_id).hide();
	$("#detail_k"+details_id).hide();
	$("#detail_l"+details_id).hide();
	$("#detail_m"+details_id).hide();
	
	$("#detail_aa"+details_id).show();
	$("#detail_bb"+details_id).show();
	$("#detail_cc"+details_id).show();
	$("#detail_dd"+details_id).show();
	$("#detail_ee"+details_id).show();
	$("#detail_ff"+details_id).show();
	$("#detail_gg"+details_id).show();
	$("#detail_hh"+details_id).show();
	$("#detail_ii"+details_id).show();
	$("#detail_jj"+details_id).show();
	$("#detail_kk"+details_id).show();
	$("#detail_ll"+details_id).show();
	$("#detail_mm"+details_id).show();

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
		var detail_dd = $("#detail_dd"+details_id).val();
		var detail_ee = $("#detail_ee"+details_id).val();
		var detail_ff = $("#detail_ff"+details_id).val();
		var detail_gg = $("#detail_gg"+details_id).val();
		var detail_hh = $("#detail_hh"+details_id).val();
		var detail_ii = $("#detail_ii"+details_id).val();
		var detail_jj = $("#detail_jj"+details_id).val();
		var detail_kk = $("#detail_kk"+details_id).val();
		var detail_ll = $("#detail_ll"+details_id).val();
		var detail_mm = $("#detail_mm"+details_id).val();
		
		var dataString = 'id=' + details_id + '&Evename=' +  detail_aa + '&Edescription=' + detail_bb + '&EstartDate='+detail_cc + '&EendDate='+detail_dd + '&EtimeStart='+ detail_ee + '&EtimeEnd=' + detail_ff + '&EphoneNumber=' + detail_gg + '&Etype='+detail_hh+ '&Ewebsite=' + detail_ii + '&Ehashtag='+ detail_jj + '&Efacebook=' + detail_kk + '&Etwitter=' + detail_ll + '&Egoogle='+ detail_mm ;
		
		if(detail_aa != ""){
			$.ajax(
			{
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
					$("#detail_d"+details_id).html(detail_dd);
					$("#detail_e"+details_id).html(detail_ee);
					$("#detail_f"+details_id).html(detail_ff);
					$("#detail_g"+details_id).html(detail_gg);
					$("#detail_h"+details_id).html(detail_hh);
					$("#detail_i"+details_id).html(detail_ii);
					$("#detail_j"+details_id).html(detail_jj);
					$("#detail_k"+details_id).html(detail_kk);
					$("#detail_l"+details_id).html(detail_ll);
					$("#detail_m"+details_id).html(detail_mm);
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