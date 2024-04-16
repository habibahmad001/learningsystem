@extends('layouts.sitelayout')

@section('header_scripts')
    @toastr_css
@stop
@section('content')

 <!--Start Page Banner -->
    <div class="main-content">
    <section class="inner-header divider layer-overlay overlay-theme-colored-9">
        <div class="container pt-50 pb-50">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-theme-colored2 font-36">{{ ucfirst($title) }}</h2>
                        <ol class="breadcrumb text-left mt-10 white">
                            <li><a href="{{url('/')}}">Home</a></li>
                            {{--<li><a href="#">Pages</a></li>--}}
                            <li class="active">{{ ucfirst($title) }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- End Page Banner -->
 
<!-- ======= About Us Section ======= -->
    <section id="about" class="about" style="background-image: unset !important;">
      <div class="container pt-80 pt-sm-40">
        <div class="row no-gutters align-items-center">
          <div class="col-md-6 d-flex flex-column justify-content-center about-content">
            <div class="section-title">
              <h2 class="text-uppercasetext-theme-colored mt-0 mb-0 mt-sm-30">Welcome to <span class="text-colored2">Next Learn Academy</span></h2>
              <h4 style="margin-top: 0px;">Provide world class educational service since 2012</h4>
            </div>
            <p>Next Learn Academy is helping individuals reach their goals and pursue their dreams by giving the opportunity to learn online and earn certifications as powerful proof of their new competencies. With access to online learning resources and instructions, you can choose a course that suits your schedule and enjoy the flexibility and convenience you need to learn and advance. We are committed to personal and professional development of our students and we constantly aim to support them gain skills and transform their lives in meaningful ways.</p>
          </div>
          <div class="col-md-6 video-box">
              <div class="preview-video-box homeVideo d-none">
                  <img class="img-fullwidth" src="<?=UPLOADS?>images/about/Who We Are1.jpg" alt="About Us">
                  <a href="javascript:void(0)" id="video1"><i class="fas fa-play-circle"></i></a>
              </div>
              <div class="preview-video-box homeVideo">
                  <img class="img-fullwidth" src="<?=UPLOADS?>images/about/Who We Are1.jpg" alt="About Us">
                  <a href="#"  data-toggle="modal" data-target="#mainVideoModal"><i class="fas fa-play-circle"></i></a>
              </div>
          </div>
        </div>
      </div>
    </section>
<!-- End About Us Section -->

        <!-- Video Modal -->
        <div class="modal fade" id="mainVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <video width="100%" height="400" preload="<?=UPLOADS?>images/about/Who We Are1.jpg" src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" type="video/mp4" controls></video>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Video Modal -->

        <!-- Video Modal -->
        <div id="vidBox" class="d-none">
            <div id="videCont">
                <video autoplayid="demo" loop controls>
                    <source src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" type="video/webm">
                    <source src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" type="video/mp4">
                </video>
            </div>
        </div>

        {{--<div class="modal fade" id="mainVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <video autoplayid="demo" width="100%" height="400" loop controls>
                            <source src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" type="video/webm">
                            <source src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/videos/nla_video.m4v" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- End Video Modal -->




        <!-- Start Section Who we are -->
        <section class="who-we-are">
            <div class="container">
                <div class="section-content">
                    <div class="row align-items-center">
                        
                        <div class="col-md-6 col-sm-push-6">
                            <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">Who <span class="text-colored2">We Are</span></h2>
                            <p>Next Learn Academy knows that learning doesn't begin and end in the classroom. Education is an ongoing process throughout our lives. That's why we offer courses covering a variety of subject areas, accessible anywhere in the world. We keep our training affordable without losing out on quality, with all materials designed and delivered by industry experts. Through this we aim to help people achieve their personal and professional development, with UK and internationally-recognised accreditation as proof of their new skills and knowledge</p>
                        </div>
                        <div class="col-md-6 col-sm-pull-6">
                            <img class="img-fullwidth" src="<?=UPLOADS?>images/about/Who We Are.jpg" alt="Who we are" style="box-shadow: 10px 10px 67px -24px rgba(191,191,191,1);">
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- End Section Who we are -->

<!-- Start Section why choose Us -->
        <section class="why-choose-us">
            <div class="container">
                <div class="section-content">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">Why Choose <span class="text-colored2">Next Learn Academy</span></h2>
                            <p><i class="fas fa-check-circle"></i>Lifetime Access</p>
                            <p><i class="fas fa-check-circle"></i>High-quality e-learning study materials</p>
                            <p><i class="fas fa-check-circle"></i>The UK and globally recognised accredited qualification</p>
                            <p><i class="fas fa-check-circle"></i>Self-paced, no fixed schedules</p>
                            <p><i class="fas fa-check-circle"></i>24/7 customer support through email</p>
                            <p><i class="fas fa-check-circle"></i>Available to students anywhere in the world</p>
                            <p><i class="fas fa-check-circle"></i>No hidden fee</p>
                            <p><i class="fas fa-check-circle"></i>Study in a user-friendly, advanced online learning platform</p>
                        </div>
                        <div class="col-md-6">
                            <img class="img-fullwidth" src="<?=UPLOADS?>images/about/why chooseus.jpg" alt="why choose Us" style="box-shadow: 10px 10px 67px -24px rgba(191,191,191,1);">
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- End Section why choose Us -->

<!-- Start Section mission -->
        <section class="mission">
            <div class="container pb-80">
                <div class="section-content">
                    <div class="row align-items-center">
                        
                        <div class="col-md-6 col-sm-push-6">
                            <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">Our <span class="text-colored2">Mission</span></h2>
                            <p>Courses from Next Learn Academy cover everything from software expertise to business administration to the creative arts. By offering a comprehensive catalogue to choose from, we help our users get the most out of their membership. Courses are offered at a competitive rate and our membership packages allow you to access a number of different classes for one low price. With no formal deadlines or teaching schedule, you can learn in your own time with lifetime access.</p>
                        </div>
                        <div class="col-md-6 col-sm-pull-6">
                            <img class="img-fullwidth hidden-ms" src="<?=UPLOADS?>images/about/mission.jpg" alt="mission" style="box-shadow: 10px 10px 67px -24px rgba(191,191,191,1);">
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- End Section mission -->
</div>
<!-- end main-content -->
@stop
@section('footer_scripts')
    @toastr_js
    @toastr_render
    <script type="text/javascript">
        $(function () {
            $('#vidBox').VideoPopUp({
                backgroundColor: "#17212a",
                pausevideo:true,
                opener: "video1",
                maxweight: "340",
                idvideo: "v1"
            });
        });
    </script>
    <script>
        // $('#closer_videopopup').on('click', function () {
        //     $("video").each(function(){
        //         $(this).get(0).pause();
        //     });
        // })
    </script>
@stop