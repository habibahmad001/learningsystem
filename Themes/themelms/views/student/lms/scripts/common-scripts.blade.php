
<script>
    function generatepdf(id,qid) {

        $.ajax({
            beforeSend: function () {
                $(this).prop('disabled', true);
                if(qid==0) {
                    $('.generatebtn').hide();
                }
                $('#genloader').show();

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            data: {id:id, qid:qid},
            url: '{{url('result/generate-free-certificate')}}',
            success: function (response) {
                console.log(response.html);
                if(qid!=0) {
                    $('#pdfviewer .modal-body').html(response.html);
                }else{
                    $('#pdfgenerated').html(response.html);
                }
            },
            complete: function (response) {
                console.log(response);
                $('#genloader').hide();
                $('#pdfgenerated').show();
                if(qid!=0) {
                    $('#pdfviewer').modal('show');
                    $(this).prop('disabled', false);
                }
            }
        });
    }

    function regeneratepdf(certid) {

        $.ajax({
            beforeSend: function () {
                $(this).prop('disabled', true);

                $('#pdfviewer').modal('show');

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            data: {certid:certid},
            url: '{{url('result/regenerate-certificate')}}',
            success: function (response) {
                console.log(response.html);

                $('#pdfviewer .modal-body').html(response.html);

            },
            complete: function (response) {
                console.log(response);
                $('#genloader').hide();
                //$('#pdfviewer').modal('show');
                $(this).prop('disabled', false);

            }
        });
    }

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
                footer: '<a href="{{url("contact-us")}}" target="_blank">Learn more about this?</a>'
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
                    footer: '<a href="{{url("contact-us")}}" target="_blank">Learn more about this?</a>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            }
        });*/
});


</script>