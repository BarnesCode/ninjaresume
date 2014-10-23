(function () {

    var app = angular.module('resume', []);
    app.controller('ResumeController', ['$scope', '$http', '$location', function ($scope, $http, $location) {
        var cont = this;
        $scope.navigate = function (path) {
            //alert(path);
            $location.hash(path);
        };
        $http.get('http://barnes.ninja/resume.php').
                  success(function (data) {
                      //alert(data);
                      // here the data from the api is assigned to a variable named users
                      cont.jobs = data.jobs;
                      cont.skills = data.skills;
                      cont.accomplishments = data.accomplishments;
                      cont.jobskills = data.jobskills;
                      cont.reccomendations = data.reccomendations;
                      setTimeout(function () { $("#skills a").tagcloud() }, 10);
                      setTimeout(function () {
                          $('#sidebar a').click(function (e) {
                              e.preventDefault();
                          })
                      }, 10);
                      setTimeout(function () {
                          $('.itemtext').each(function () { $(this).autoTextSize(5, 3000) });
                      }, 20);

                          //setTimeout(function () { $('body').scrollspy('refresh') }, 150);
                      })
                  .error(function () {
                      //alert('error');
                  });
                  }]);
        //app.config(function ($locationProvider) {
        //    $locationProvider.html5Mode(true);
        //})
        //app.directive('tagcloud', function () {
        //    return {
        //        restrict: 'E',
        //        replace: true,
        //        scope: {

        //        },
        //        templateUrl: 'tagcloud.html',
        //        //link: function (scope, element) {
        //        //    printObject(scope.$root.resume);
        //        //}
        //    };
        //});
        app.run(function () {
            $('body').scrollspy('refresh');
        });
    })();

    function printObject(o) {
        var out = '';
        for (var p in o) {
            out += p + ': ' + o[p] + '\n';
        }
        alert(out);
    }
