'use strict'

angular.module('ep.social', [])
	   .directive('social', social);

function social(){
	return {
		restrict: 'E',
		templateUrl: './social/social.view.html'
	};
}