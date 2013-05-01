(function(window, angular){
    "use strict";
    var Almin = angular.module('Almin', []).
        config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'postList.html',
                controller: "PostListCtrl"
            }).
            when('/post/:id', {
                templateUrl: 'postShow.html',
                controller: "PostShowCtrl"
            }).
            when('/posts/add', {
                templateUrl: 'postAdd.html',
                controller: "PostAddCtrl"
            }).
            when('/post/:id/edit', {
                templateUrl: 'postEdit.html',
                controller: "PostEditCtrl"
            });
        $locationProvider.html5Mode(true);
    }]);
    window.Almin = Almin;

})(window,window.angular);