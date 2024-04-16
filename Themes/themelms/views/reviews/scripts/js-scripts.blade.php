
<script src="{{JS}}angular.js"></script>
<script src="{{JS}}angular-messages.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<style>
    .select2-container .select2-selection--single {
        height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        background-color: #f7f7f74f;
        line-height: 40px;
    }
</style>
<script>
var app = angular.module('academia', ['ngMessages']).constant("CSRF_TOKEN", '<?= csrf_token() ?>');
app.controller('angLmsController', function($scope, $http) {

    $scope.initAngData = function(data) {
        // console.log(courses);
        // console.log(courses);
        //  console.log(users);
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

jQuery(document).ready(function() {
    jQuery('.reviewdate').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-300d',
        showOnFocus:true,
        todayHighlight:true,
        autoclose:true
    });

    jQuery('#course_id').select2();
    jQuery('#user_id').select2();


});



</script>