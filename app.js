(function () {

    var app = angular.module('resume', []);
    app.controller('ResumeController', ['$scope', '$http', function ($scope, $http) {
        var cont = this;
        $http.get('http://barnes.ninja/resume.php').
                  success(function (data) {
                      //alert(data);
                      // here the data from the api is assigned to a variable named users
                      cont.jobs = data.jobs;
                      cont.skills = data.skills;
                      cont.accomplishments = data.accomplishments;
                      cont.jobskills = data.jobskills;
                      setTimeout(function () { $("#skills a").tagcloud() }, 10);
                      //setTimeout(function () { $('body').scrollspy('refresh'); }, 10);
                  })
                  .error(function () {
                      //alert('error');
                  });
    }]);
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
