<?php
session_start();

if(1 == 1) {

  if(!isset($_SESSION['id'])) {
    $loc = "login.php";
  } else if($_SESSION['id'][0] == 'S') {
    $loc = "student/welcome.php";
  } else if($_SESSION['id'][0] == 'T') {
    $loc = "teacher/welcome-teacher.php";
  } else if($_SESSION['id'][0] == 'A') {
    $loc = "admin/welcome-admin.php";
  }

  header("location: ".$loc);
}
?>




<!-- NG-Practice -->
<!DOCTYPE html>

<html lang="en-us" ng-app="myApp" ng-init="greet='Hello World!'; amount = 10000; roi = 10.5; duration = 10; myArr = [100, 200]; person = { firstName: 'Steve', lastName: 'Jobs'}">

<head>
  
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta charset="UTF-8">

  <title>Practice makes perfect!</title>
  
  <script src="js/angular.js"></script> 
  <script src="js/controller.js"></script>

  <style>
    .redDiv {
      width: 100px;
      height: 100px;
      background-color: red;
      padding: 2px 2px 2px 2px;
    }

    .yellowDiv {
      width: 100px;
      height: 100px;
      background-color: yellow;
      padding: 2px 2px 2px 2px;
    }
  </style>

</head>
<body>
 <!-- Enter Your Name: <input type="text" ng-model="name"><br>
  Hello <label ng-bind="name"></label>
  
  <hr>
  {{true + true - true}} 
  <br>

  Enter a couple of numbers to multiply:
  <input type="text" ng-model="Num1"> x <input type="text" ng-model="Num2"> = <span> {{Num1 * Num2}} </span>
  
  <br>
  <div ng-controller="myController"> {{message}} </div> <br> /-->
<!--  <a href="login.php">Next Page</a> 

  <hr>

  Greetings: {{greet}}
  <br>
  {{ (amount*roi*duration)/100 }}
  <br>
  {{myArr[2]}}
  <br>
  {{person.firstName + " " + person.lastName}} /-->

 <!-- <h1>AngularJS Mouse Events Demo: </h1>
    <div ng-class="{redDiv: enter, yellowDiv: leave}" 
      ng-mouseenter="enter=true; leave=false;"
      ng-mouseleave="leave =true; enter = false;">
      Mouse <span ng-show="enter">Enter </span> <span ng-show="leave">Leave </span>
    </div> -->

<!--  <div ng-controller="myController2">
    Response Data: {{data}} <br>
    Erorr: {{error}}
  </div>

  <script>
    var myApp = angular.module('myApp', []);

    myApp.controller('myController2', function($scope, $http){
       
       var onSuccess = function (data, status, headers, config) {
        $scope.data = data;
       };

       var onError = function (data, status, headers, config) {
        $scope.error = status;
       }

       var promise = $http.get("login.php");

       promise.then(onSuccess, onError); 

    });

  </script> -->

</body>
</html>
<script>
/*
app.controller('SomeController', [ '$http', function($http){
                                    // services and then they are passed as an argument
                                    THIS IS DEPENDENCY INJECTION :O
                                    MULTIPLE services == multiple variables passed

}]);

Angular loads and creates an Injector
Services register with the Injectors at first

The controller tells the Injector what services it needs and it says 'cool'
the Injector then passes the services to the controller as arguments
THIS IS CALLED DEPENDENCY INJECTION

*/
</script>