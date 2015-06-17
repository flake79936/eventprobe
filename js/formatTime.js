/*
This script is based on the javascript code of Roman Feldblum (web.developer@programmer.net)
Original script : http://javascript.internet.com/forms/format-phone-number.html
Original script is revised by Eralper Yilmaz (http://www.eralper.com)
Revised script : http://www.kodyaz.com
Format : "(123) 456-7890"
*/

var zChar = new Array(' ', ':', 'A', 'P', 'M');
var timeLength = 14;
var timeValue1;
var timeValue2;
var cursorPosition;

function parseForTime1(object){
	timeValue1 = ParseChar(object.value, zChar);
}

function parseForTime2(object){
	timeValue2 = ParseChar(object.value, zChar);
}

function spaceBackUP(object, e){
	if(e){
		e = e;
	} else {
		e = window.event; 
	}

	if(e.which){
		var keycode = e.which;
	} else {
		var keycode = e.keyCode;
	}

	parseForTime1(object)

	if(keycode >= 48){
		validateTime(object);
	}
}

function spaceBackDown(object, e) { 
	if(e){ 
		e = e; 
	} else {
		e = window.event; 
	} 
	
	if(e.which){ 
		var keycode = e.which; 
	} else {
		var keycode = e.keyCode; 
	}
	
	parseForTime2(object);
} 

function getCursorPosition(){
	var t1 = timeValue1;
	var t2 = timeValue2;
	var bool = false;
	
	for (i = 0; i < t1.length; i++){
		if (t1.substring(i, 1) != t2.substring(i, 1)) {
			if(!bool){
				cursorPosition = i;
				window.status = cursorPosition;
				bool = true;
			}
		}
	}
}

function validateTime(object){
	var p = timeValue1
	p = p.replace(/[^\d][apm]*/gi,"")

	if (p.length < 2) {
		object.value = p;
		
	} else if(p.length == 2){
		pp = p;
		//d4 = p.indexOf(':');
		d5 = p.indexOf(':');
		
		//if(d4 == -1){
		//	pp = "(" + pp;
		//}
		
		if(d5 == -1){
			pp = pp + ":";
		}
		object.value = pp;
		
	} else if(p.length > 2 && p.length < 4){
		//p   = "(" + p; 
		l30 = p.length;
		p30 = p.substring(0, 2);
		p30 = p30 + ":";

		p31 = p.substring(2, l30);
		pp  = p30 + p31;

		object.value = pp;

	} else if(p.length >= 4){
		//p ="(" + p; 
		l30 = p.length;
		p30 = p.substring(0, 2);
		p30 = p30 + ":"; 

		p31 = p.substring(2, l30);
		pp  = p30 + p31;
		
		//
		l40 = pp.length;
		p40 = pp.substring(0, 5);
		p40 = p40 + " "

		p41 = pp.substring(5, l40);
		ppp = p40 + p41;

		object.value = ppp.substring(0, timeLength);
	}

	getCursorPosition();

	if(cursorPosition >= 0){
		if (cursorPosition == 0){
			cursorPosition = 2;
		} else if (cursorPosition <= 2) {
			cursorPosition = cursorPosition + 1;
		} else if (cursorPosition <= 4) {
			cursorPosition = cursorPosition + 3;
		} else if (cursorPosition == 5) {
			cursorPosition = cursorPosition + 3;
		} else if (cursorPosition == 6) { 
			cursorPosition = cursorPosition + 3; 
		} else if (cursorPosition == 7) { 
			cursorPosition = cursorPosition + 4; 
		} else if (cursorPosition == 8) { 
			cursorPosition = cursorPosition + 4;
			e1 = object.value.indexOf(')');
			e2 = object.value.indexOf('-');
			if (e1 > -1 && e2 > -1){
				if (e2-e1 == 4){
					cursorPosition = cursorPosition - 1;
				}
			}
			
		} else if (cursorPosition == 9) {
			cursorPosition = cursorPosition + 4;
		} else if (cursorPosition < 11) {
			cursorPosition = cursorPosition + 3;
		} else if (cursorPosition == 11) {
			cursorPosition = cursorPosition + 1;
		} else if (cursorPosition == 12) {
			cursorPosition = cursorPosition + 1;
		} else if (cursorPosition >= 13) {
			cursorPosition = cursorPosition;
		}

		var txtRange = object.createTextRange();
		txtRange.moveStart( "character", cursorPosition);
		txtRange.moveEnd( "character", cursorPosition - object.value.length);
		txtRange.select();
	}
}

function ParseChar(sStr, sChar){
	if (sChar.length == null) {
		zChar = new Array(sChar);
	} else zChar = sChar;

	for (i = 0; i < zChar.length; i++){
		sNewStr = "";
		var iStart = 0;
		var iEnd = sStr.indexOf(sChar[i]);

		while (iEnd != -1){
			sNewStr += sStr.substring(iStart, iEnd);
			iStart = iEnd + 1;
			iEnd = sStr.indexOf(sChar[i], iStart);
		}
		
		sNewStr += sStr.substring(sStr.lastIndexOf(sChar[i]) + 1, sStr.length);
		sStr = sNewStr;
	}
	return sNewStr;
}