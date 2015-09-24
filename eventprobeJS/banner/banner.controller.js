'use strict'

angular.module('ep.banner', [])
	   .directive('banr', banr);

function banr(){
	return {
		restrict: 'E',
		templateUrl: './banner/banner.view.html'
	};
}