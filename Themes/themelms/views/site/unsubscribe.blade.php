@extends('layouts.sitelayout')
@section('content')
    <div class="main-content inner_pages">

        <section class="thankyou_section pt-60 pb-60">
            <div class="container text-center">
                <img src="<?=UPLOADS?>images/thanksyou.png" class="">
                <h4>{{ (isset($msg)) ? $msg : "You are unsubscribe successfully!" }}</h4>
                <br />

                <p>If you have any further questions, feel free to contact us through <a href="mailto:info@nextlearnacademy.com">info@nextlearnacademy.com</a>
                    or use instant chat on our website for quick support. or else you can contact our hotline:<a href="tel:+442081269090">+44 208 126 9090</a>
                    Our support lines are available <u>Monday-Friday</u> between the hours of <u>8.00 – 17.00</u> in UK time.</p>

                <a href="{{url('/my-courses')}}" class="btn btn-primary">My Courses</a>

                <div class="text-center links-social">
                    <span>Follow us</span>
                    <a href="https://www.facebook.com/nextlearnacademy" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/NextLearnUK" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/nextlearnacademy/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/nextlearnacademy" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                </div>

            </div>
        </section>


    </div>
@stop
@section('footer_scripts')
    <script>

    </script>
@endsection