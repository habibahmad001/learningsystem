@extends('layouts.sitelayout')
@section('header_scripts')
@stop
@section('content')
    <div class="main-content inner_pages">

        <section class="inner__header giftCourse_Banner" style="background-image:url('<?=UPLOADS.'images/instructor_slider_img.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        <h3 class="text-uppercase">Gift this course</h3>
                        <p>For more information, you can fill in the form and we will get back to you at our earliest.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="new__formSection gift__CourseSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <div class="section-title mb-0">
                            <h2 class="title text-uppercase mb-0">Gift <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Course</span></h2>
                            <p>Prep your gift and double-check it looks just right</p>

                            <form id="giftfrm" name="giftfrm" method="post" action="{!! URL::to("/savegift") !!}" data-parsley-validate="" class="new__formStyle gift__form ng-pristine ng-valid" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include('errors.errors')
                                <div class="form-group w-100">
                                    <div class="field">
                                        <input type="text" name="giftfname" id="fname" class="giftfname" required="required" placeholder="Recipient's Name:" value="">
                                        <label for="fname">Recipient's Name:<span>*</span></label>
                                    </div>
                                </div>
                                <div class="form-group removeele">
                                    <div class="field">
                                        <div class="UserDivMsg" id="UserDivMsg">This user is not exist, Please confirm email, Thanks !!</div>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <div class="field">
                                        <input type="email" name="giftemail" id="email" class="giftemail" required="required" onblur="javascript: return ajaxcheckuser();" placeholder="Recipient's Email:" value="">
                                        <label for="email">Recipient's Email:<span>*</span></label>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <div class="field">
                                        <input type="date" name="giftdate" id="giftdate" class="giftdate" placeholder="When do you want to send this gift:" value="">
                                        <label for="giftdate">When do you want to send this gift:</label>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <div class="field">
                                        <textarea name="giftmessage" id="giftmessage" rows="6" class="giftmessage" placeholder="Message" required=""></textarea>
                                        <label for="giftmessage">Your Message:<span>*</span></label>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-center mt-15 w-100">
                                    <button type="button" id="submitform" class="btn btn-primary theme-btn btn-block">Proceed to Checkout</button>
                                </div>
                                <input type="hidden" name="cid" id="cid" value="{!! (isset($slug)) ? $course->id : 0 !!}">
                                <input type="hidden" name="gname" id="gname" value="{!! (isset($slug)) ? $course->title : "" !!}">
                                <input type="hidden" name="gcost" id="gcost" value="{!! (isset($slug)) ? (($course->is_paid == 2 || $course->is_paid == 3) ? $course->discount_price : $course->cost) : "" !!}">
                                <input type="hidden" name="gimage" id="gimage" value="{!! (isset($slug)) ? $course->image : "" !!}">
                                <input type="hidden" name="gslug" id="gslug" value="{!! (isset($slug)) ? $course->slug : "" !!}">
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"><!--'https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/lms/series/widget/' . $course->image-->
                        <div class="gift__courseInfo">
                            <figure><img src="{!! (isset($slug)) ?  ((file_exists(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $course->image)) ? IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $course->image : IMAGE_PATH_UPLOAD_LMS_SERIES . $course->image) : 'https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/lms/series/widget/58-image.jpg' !!}" width="350" height="250"></figure>
                            <a href="{!! URL::to('/course') . "/" . (isset($slug)) ? $course->slug : "" !!}">{!! (isset($slug)) ? $course->title : 'Nannying and Childcare Training' !!}</a>
                            {{--<p>an online course by <strong>{!! (isset($slug)) ? $course->getinstructor($course->user_id)->name : 'Kirill Eremenko' !!}</strong></p>--}}
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                </div>
            </div>
        </section>

    </div>
@stop
@section('footer_scripts')
  <script language="JavaScript">
      $(document).ready(function () {
          loaddata();
          $("#submitform").click(function () {
              preserverdata();

              /********* Call Validation *********/
              if(validate('') === false) {
                  return false;
              }
              /********* Call Validation *********/

              /********* Call Auth *********/
              @if(Auth::check())
                preserverdata();
                $("#giftfrm").submit();
              @else
                $('#LoginModal').modal({show: 'true'});
              @endif
              /********* Call Auth *********/
          });
      });

      function preserverdata() {
          sessionStorage.setItem("fname", "");
          sessionStorage.setItem("email", "");
          sessionStorage.setItem("giftdate", "");
          sessionStorage.setItem("giftmessage", "");
          sessionStorage.setItem("cid", "");
          sessionStorage.setItem("gname", "");
          sessionStorage.setItem("gcost", "");
          sessionStorage.setItem("gimage", "");
          sessionStorage.setItem("gslug", "");

          sessionStorage.setItem("fname", $("#fname").val());
          sessionStorage.setItem("email", $("#email").val());
          sessionStorage.setItem("giftdate", $("#giftdate").val());
          sessionStorage.setItem("giftmessage", $("#giftmessage").val());
          sessionStorage.setItem("cid", $("#cid").val());
          sessionStorage.setItem("gname", $("#gname").val());
          sessionStorage.setItem("gcost", $("#gcost").val());
          sessionStorage.setItem("gimage", $("#gimage").val());
          sessionStorage.setItem("gslug", $("#gslug").val());
      }

      function loaddata() {
          if((sessionStorage.getItem("fname"))) {
              $("#fname").val(sessionStorage.getItem("fname"));
          }

          if((sessionStorage.getItem("email"))) {
              $("#email").val(sessionStorage.getItem("email"));
          }

          if((sessionStorage.getItem("giftdate"))) {
              $("#giftdate").val(sessionStorage.getItem("giftdate"));
          }

          if((sessionStorage.getItem("giftmessage"))) {
              $("#giftmessage").val(sessionStorage.getItem("giftmessage"));
          }

          sessionStorage.setItem("fname", "");
          sessionStorage.setItem("email", "");
          sessionStorage.setItem("giftdate", "");
          sessionStorage.setItem("giftmessage", "");
      }

      function validate(type) {
          $(".error").each(function(){
              $(this).removeClass('error');
          });
          var errors = [];

          var fname          = $("#"+ type +"fname").val();
          var email          = $("#"+ type +"email").val();
          var giftdate          = $("#"+ type +"giftdate").val();
          var giftmessage     = $("#"+ type +"giftmessage").val();


          if(fname == '') {
              errors.push("#"+ type +"fname");
          }

          if(email == '') {
              errors.push("#"+ type +"email");
          }

          if(giftdate == '') {
              errors.push("#"+ type +"giftdate");
          }

          if(giftmessage == '') {
              errors.push("#"+ type +"giftmessage");
          }

          if(errors.length>0){
              for(i=0; i < errors.length; i++){
                  $(errors[i]).addClass('error');
              }
              return false;
          }

          return true;
      }

      function ajaxcheckuser(){

          $.ajax({
              beforeSend: function () {

              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'POST',

              url: '{{url('ajaxcheckuseremail')}}',
              data: {
                  emails : $("#email").val()
              },

              success: function (response) {
                  if(response.status == "success") {
                      $(".removeele").hide(300);
                      $(".resfield").val(1);
                  } else {
                      $(".removeele").show(300);
                      $(".resfield").val(0);
                  }

              },
              complete: function (response) {
                console.log(response);
              }
          });

      }
  </script>

@endsection