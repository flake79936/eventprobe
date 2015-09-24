'use strict'

angular.module('ep.myEvents', [])
	   .directive('myEvents', myEvents);

function myEvents(){
	return {
		restrict: 'E',
		templateUrl: './myEvents/myEvents.view.html'
	};
}