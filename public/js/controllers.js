(function (Almin) {
    Almin.controller('PostListCtrl', function PostListCtrl($scope, $http) {
        $http.get('/api/posts').
            success(function (data, status, headers, config) {
                if (data.success) {
                    $scope.posts = data.posts;
                }
            });
    });

    Almin.controller('PostShowCtrl', function PostShowCtrl($scope, $http, $routeParams, $location) {
        $http.get('/api/post/' + $routeParams.id).
            success(function (data, status, headers, config) {
                if (data.success) {
                    $scope.post = data.post;
                } else {
                    //handle error/redirect to list
                    $location.path('/');
                }
            });
    });

    Almin.controller('PostAddCtrl', function PostAddCtrl($scope, $http, $location) {
        $scope.submitPost = function () {
            $http.post('/api/posts', {
                post_title:$scope.post_title,
                post_body:$scope.post_body
            }).success(function (data, status, headers, config) {
                    if (data.success) {
                        $location.path('/');
                    } else {
                        //do something about the error
                    }
                });
        };
    });
})(window.Almin);