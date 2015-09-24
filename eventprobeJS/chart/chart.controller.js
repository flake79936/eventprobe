'use strict'

angular.module('ep.chart', [])
	   .directive('chart', chart);

function chart(){
	return {
		restrict: 'E',
		templateUrl: './chart/chart.view.html'
	};
}