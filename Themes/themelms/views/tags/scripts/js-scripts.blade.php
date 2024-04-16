
<script src="{{JS}}angular.js"></script>
<script src="{{JS}}angular-messages.js"></script>

<script>
var app = angular.module('academia', ['ngMessages']).constant("CSRF_TOKEN", '<?= csrf_token() ?>');
app.controller('angLmsController', function($scope, $http) {

    $scope.initAngData = function(data) {
        if(data=='')
        {
            $scope.series = '';
            $scope.content_type = '';
            return;
        }
var cont="";
        console.log(data);
         cont = JSON.parse(data);
         console.log(cont);
        console.log("hello");
        $scope.content_type    = data.content_type;
    }




});
 
</script>