'use strict'

angular.module('ep.header', [])
	   .directive('topHeader', topHeader);

function topHeader(){
	return {
		restrict: 'E',
		templateUrl: './header/header.view.html'
	};
}