/*
This script is based on the javascript code of Roman Feldblum (web.developer@programmer.net)
Original script : http://javascript.internet.com/forms/format-phone-number.html
Original script is revised by Eralper Yilmaz (http://www.eralper.com)
Revised script : http://www.kodyaz.com
Format : "(123) 456-7890"
*/

var zChar = new Array('/');
var lengthOfTime = 10; //03/15/2015; it is the length of the date including the forward slash
var dateValue1;
var dateValue2;
var cursorPosition;

function parseForNumber1(object){
	dateValue1 = parseDate(object.value, zChar);
}

function parseForNumber2(object){
	dateValue2 = parseDate(object.value, zChar);
}

function spaceBackUP(object,e){
	if(e){
		e = e
	} else {
		e = window.event 
	}

	if(e.which){ 
		var keycode = e.which 
	} else {
		var keycode = e.keyCode 
	}
	parseForNumber1(object)

	if(keycode >= 48){
		validateDate(object)
	}
}

function spaceBackDown(object,e) { 
	if(e){ 
		e = e 
	} else {
		e = window.event 
	} 
	
	if(e.which){ 
		var keycode = e.which 
	} else {
		var keycode = e.keyCode 
	}
	parseForNumber2(object)
} 

function GetcursorPosition(){
	var t1 = dateValue1;
	var t2 = dateValue2;
	var bool = false
	
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

function validateDate(object){
	var p = dateValue1
	p = p.replace(/[^\d]*/gi, "")

	if (p.length < 2) {
		object.value = p
	} else if(p.length == 1){
		pp = p;
		d4 = p.indexOf('/');
		//d5 = p.indexOf(')')
		
		if(d4 == -1){
			pp = "0" + pp;
		}
		
		//if(d5==-1){
		//	pp=pp+")";
		//}
		object.value = pp;
		
	} else if(p.length > 1 && p.length < 7){
		//p = "0" + p;
		l30 = p.length;
		p30 = p.substring(0, 4);
		p30 = p30 + "/" 

		p31 = p.substring(4, l30);
		pp = p30 + p31;

		object.value = pp; 

	} else if(p.length >= 7){
		//p ="0" + p; 
		l30 = p.length;
		p30 = p.substring(0, 4);
		p30 = p30 + "/" 

		p31=p.substring(4, l30);
		pp= p30 + p31;

		l40 = pp.length;
		p40 = pp.substring(0, 9);
		p40 = p40 + "-"

		p41 = pp.substring(9, l40);
		ppp = p40 + p41;

		object.value = ppp.substring(0, lengthOfTime);
	}

	GetcursorPosition()

	if(cursorPosition >= 0){
		if (cursorPosition == 0) {
			cursorPosition = 2
		} else if (cursorPosition <= 2) {
			cursorPosition = cursorPosition + 1
		} else if (cursorPosition <= 4) {
			cursorPosition = cursorPosition + 3
		} else if (cursorPosition == 5) {
			cursorPosition = cursorPosition + 3
		} else if (cursorPosition == 6) { 
			cursorPosition = cursorPosition + 3 
		} else if (cursorPosition == 7) { 
			cursorPosition = cursorPosition + 4 
		} else if (cursorPosition == 8) { 
			cursorPosition = cursorPosition + 4
			e1=object.value.indexOf(')')
			e2=object.value.indexOf('-')
			if (e1>-1 && e2>-1){
				if (e2-e1 == 4) {
					cursorPosition = cursorPosition - 1
				}
			}
			
		} else if (cursorPosition == 9) {
			cursorPosition = cursorPosition + 4
		} else if (cursorPosition < 11) {
			cursorPosition = cursorPosition + 3
		} else if (cursorPosition == 11) {
			cursorPosition = cursorPosition + 1
		} else if (cursorPosition == 12) {
			cursorPosition = cursorPosition + 1
		} else if (cursorPosition >= 13) {
			cursorPosition = cursorPosition
		}

		var txtRange = object.createTextRange();
		txtRange.moveStart( "character", cursorPosition);
		txtRange.moveEnd( "character", cursorPosition - object.value.length);
		txtRange.select();
	}
}

function parseDate(sStr, sChar){
	//sChar.length -> 5
	if (sChar.length == null) {
		//new length of zChar is 5, if sChar is null
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