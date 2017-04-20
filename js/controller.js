(function (){
	var myApp = angular.module("myApp", []);

	myApp.controller("myController", function($scope) {
		$scope.message = "Hello Angular World!";
	});

	var gem = {
		name: 'Dodecahedron',
		price: 2.95,
		description: '. . .'
	};

})();