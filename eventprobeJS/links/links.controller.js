'use strict'

angular.module('ep.links', [])
	   .directive('links', links);

function links(){
	return {
		restrict: 'E',
		templateUrl: './links/links.view.html'
	};
}