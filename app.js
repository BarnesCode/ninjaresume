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
                      cont.bob = data.bob;
                  })
                  .error(function () {
                      //alert('error');
                  });
    }]);
    app.run(function () {
        $('body').scrollspy('refresh');
    });
})();
