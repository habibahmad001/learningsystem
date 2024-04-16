
<script src="{{JS}}angular.js"></script>
<script src="{{JS}}angular-messages.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<script>
var app = angular.module('academia', ['ngMessages']).constant("CSRF_TOKEN", '<?= csrf_token() ?>');
app.controller('studentLmsController', function($scope, $http) {

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

jQuery(document).ready(function() {

    jQuery("#stars_rating").rating({clearCaption: 'No stars yet'});




});
jQuery( document ).ready(function() {
    // markThisLessonAsCompleted{id}
    //  const Swal = require('sweetalert2')
    $('.notifylearner').click(function () {
        var allowed=0;
        var attempts=$(this).data("attempts");
        var exam_type=$(this).data("exam_type");
        var allowed=$(this).data("allowed");

        if(exam_type=="Other Exam"){ exam_type='Mock' };
        // if(exam_type=="Final"){ allowed=1 } else { allowed=3 };
        var url=$(this).data("url");
        var retakeurl=$(this).data("retakeurl");

        console.log(attempts+allowed);
        if((exam_type=="Final" && attempts==1 && allowed==1) ||(exam_type=="Final" && attempts>allowed) ||(exam_type=="Mock" && attempts>=3)){
            Swal.fire({
                icon: 'error',
                title: 'Attention...',
                text: 'Your '+exam_type+' Exam Attempts are over!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Pay {{getSetting('currency_code','site_settings')}}5 to Take Again',
                footer: '<a href="{{url("contact_us")}}" target="_blank">Learn more about this?</a>'
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href =retakeurl;
                }
            })
        }else{
            Swal.fire({
                icon: 'info',
                title: 'Attention Please...',
                text: exam_type+' Exams Attempts are allowed '+allowed+' You have done '+attempts+' attempt(s)',
                confirmButtonText: 'Ok Proceed',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                footer: '<a href="{{url("contact_us")}}" target="_blank">Learn more about this?</a>'
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = url;
                }
            })
        }

    });

    /*
    $('.notifylearner').click(function () {
        var allowed = 0;
        var attempts = $(this).data("attempts");
        var exam_type = $(this).data("exam_type");
        if (exam_type == "Other Exam") {
            exam_type = 'Mock'
        }
        ;
        if (exam_type == "Final") {
            allowed = 1
        } else {
            allowed = 3
        }
        ;
        var url = $(this).data("url");
        var retakeurl = $(this).data("retakeurl");
        console.log(url);
        if ((exam_type == "Final" && attempts == 1) || (exam_type == "Mock" && attempts >= 3)) {
            Swal.fire({
                icon: 'error',
                title: 'Attention...',
                text: 'Your ' + exam_type + ' Exam Attempts are over!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Pay {{getSetting('currency_code','site_settings')}}5 to Take Again',
                footer: '<a href="{{url("contact_us")}}" target="_blank">Learn more about this?</a>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = retakeurl;
                    }
                })
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Attention Please...',
                    text: exam_type + ' Exams Attempts are allowed ' + allowed + ' You have done ' + attempts + ' attempt(s)',
                    confirmButtonText: 'Ok Proceed',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    footer: '<a href="{{url("contact_us")}}" target="_blank">Learn more about this?</a>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            }
        });*/
});


</script>