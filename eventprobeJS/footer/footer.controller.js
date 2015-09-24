/// <reference path="../typings/angularjs/angular.d.ts"/>
'use strict'

angular.module('ep.footer', [])
	   .directive('footer', footer);
	   
function footer(){
	return {
		restrict: 'E',
		templateUrl: './footer/footer.view.php'
	};
}