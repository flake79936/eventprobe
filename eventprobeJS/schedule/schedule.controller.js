'use strict'

angular.module('ep.schedule', [])
.directive('schedule', schedule);

function schedule(){
	return {
		restrict: 'E',
		templateUrl: './schedule/schedule.view.html'
	};
}