$(".edit_tr").live('click',function()
{
var ID=$(this).attr('Eid');

$("#one_"+ID).hide();
$("#two_"+ID).hide();
$("#three_"+ID).hide();
$("#four_"+ID).hide();//New record
$("#five_"+ID).hide();//New record
$("#six_"+ID).hide();//New record
$("#seven_"+ID).hide();//New record

$("#one_input_"+ID).show();
$("#two_input_"+ID).show();
$("#three_input_"+ID).show();
$("#four_input_"+ID).show();//New record
$("#five_input_"+ID).show();//New record
$("#six_input_"+ID).show();//New record
$("#seven_input_"+ID).show();//New record
}).live('change',function(e)
{
var ID=$(this).attr('id');

var one_val=$("#one_input_"+ID).val();
var two_val=$("#two_input_"+ID).val();
var three_val=$("#three_input_"+ID).val();
var four_val=$("#four_input_"+ID).val();//New record
var four_val=$("#five_input_"+ID).val();//New record
var four_val=$("#six_input_"+ID).val();//New record
var four_val=$("#seven_input_"+ID).val();//New record

var dataString = 'Eid='+ ID +'&Evename='+one_val+'&Edescription='+two_val+'&Ewebsite='+
three_val+'&Ehashtag='+four_val+'&Efacebook='+five_val+'&Etwitter='+six_val+'&Egoogle='+seven_val;

if(one_val.length>0&& two_val.length>0 && three_val.length>0 && four_val.length>0)
{
$.ajax({
type: "POST",
url: "live_edit_ajax.php",
data: dataString,
cache: false,
success: function(e)
{
$("#one_"+ID).html(one_val);
$("#two_"+ID).html(two_val);
$("#three_"+ID).html(three_val);
$("#four_"+ID).html(four_val);//New record
$("#five_"+ID).html(four_val);//New record
$("#six_"+ID).html(four_val);//New record
$("#seven_"+ID).html(four_val);//New record
e.stopImmediatePropagation();
}
});
}
else
{
alert('Enter something.');
}
});