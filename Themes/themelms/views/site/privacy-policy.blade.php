@extends('layouts.sitelayout')

@section('header_scripts')
@toastr_css

<style>
    .layer-overlay::before {
        background: linear-gradient(to right, #063248, #156e9b) !important;
    }

    .text-theme-colored2 {
        color: rgb(81, 172, 55) !important;
    }

    .text-colored2 {
        color: rgb(81, 172, 55) !important;
    }

    .text-uppercasetext-theme-colored {
        font-size: 25px !important;
        font-weight: 800 !important;
    }

    .inner-header h2 {
        font-weight: 800 !important;
    }

    .inner-header h2,
    #policies h2,
    .card-header h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 2;
    }

    .inner-header h2 {
        color: #fff !important;
    }

    #policies p,
    .card-block {
        color: #555;
        font-weight: 400;
        font-family: 'Poppins', sans-serif;
        line-height: 2;

    }

    .card-privacy {
        -moz-box-direction: normal;
        -moz-box-orient: vertical;
        background-color: #fff;
        border-radius: 0.5rem;
        display: flex;
        flex-direction: column;
        position: relative;
        margin-bottom: 1px;
        border: none;
        padding-bottom: 20px;

    }

    .card-header:first-child {
        border-radius: 0;
    }

    .card-header {
        background-color: #f7f7f9;
        margin-bottom: 0;
        padding: 20px 1.25rem;
        border: none;
        text-align: left;

    }

    .card-header i {
        float: right;
        font-size: 30px;
        width: 1%;
        margin-top: 8px;
        margin-right: 10px;
        color: #146a97;
    }

    .card-header a {
        width: 97%;
        float: left;
        color: #565656;
    }

    .card-header p {
        margin: 0;
    }

    .card-header h3 {
        margin: 0 0 0px;
        font-size: 17px;
        font-weight: 600;
        color: #333;
    }

    .card-block {
        -moz-box-flex: 1;
        flex: 1 1 auto;
        padding: 20px;
        color: #333;
        box-shadow: inset 0px 4px 5px rgba(0, 0, 0, 0.1);
        border-top: 1px soild rgb(70, 70, 70);
        border-radius: 0;
        text-align: left;
    }
    
    .card-block h3{
        font-size:16px;
    }

    @media screen and (max-width: 767px) and (min-width: 320px) {
        .card-header a {
        width: 80%;
    }
    .card-header i {
        font-size: 20px;
    }
    
    }

    @media screen and (max-width: 1024px) and (min-width: 768px) {}
</style>

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


    <!--=========== Start T&C Banner ===========-->

    <section id="policies">
        <div class="container pt-50 pb-50">
            <div class="row">
                <div class="col-md-12">

                    <p>Thank you for choosing one of the leading online learning platform for UK learners. The team at
                        Next Learn Academy (“Next Learn Academy” “Company” “We” “Us” “Our”) are aware of the fact that you value
                        the
                        privacy of your information that we collect from you and how it is collected, shared and used.
                        We
                        recommend you to read this page thoroughly which describes about the best practices that we use
                        to
                        collect, use and in some situations share it with relevant parties as mentioned here about your
                        personal
                        information.</p>
                    <p>We have created this policy in compliance with EU General Data Protection Regulation and the
                        privacy
                        policies that govern with UK laws in general.</p>
                    <p>This privacy policy is applicable when you visit our website through web or mobile browsers and
                        also when
                        purchasing our products online.</p>

                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="headingOne">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>What Data Do We Get From You? </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>Data collected through online forms
                                    </p>
                                    <p>We collect all the data that you provide us through the contact us form in the
                                        Contact Us page. These information are those that are mentioned in the form
                                        fields
                                        only. We will also collect the same information when you contact us through
                                        phone or
                                        email and store securely in our Database file system. In the meanwhile along
                                        with
                                        the form data we also collect information about your device and what part of the
                                        pages that you most frequently interact with.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="headingTwo">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>Account Data
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>In order for you to enroll in a course you must create a user account. When
                                        creating
                                        your user account your personal information will be collected such as first
                                        name,
                                        last name, email address, username and password.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="headingtwo2">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>Course Data
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingtwo2"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>when you enroll in a course in addition to your personal data we also collect the
                                        course related data such as the name of the course/s that you have enrolled in,
                                        date
                                        you have enrolled, Instructors for your course, whether you have paid the
                                        tuition
                                        fees and your address information (refer to the below)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="heading3">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>Payment Data
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="heading3"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>Your card details will be sent to the payment gateway from our website through
                                        which
                                        you will be able to make a secure payment. This data will not be stored by our
                                        website as we solely send it to the payment gateway through secure means.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="heading4">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>Testimonials, Blogs and Forums
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="heading4"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>If you are one of our happy customers we may keep a testimonial about you with
                                        your
                                        personal experience with us. Your names (First and Last) and the place or the
                                        country that you are from will be published. If you would like to share your
                                        personal experience with us with more details to educate our prospects about our
                                        services and products you include such details in our blog. In such
                                        circumstances we
                                        have the right to edit some information before we publish them.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="heading5">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>Automated Data
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapse5" class="collapse" role="tabpanel" aria-labelledby="heading5"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>When you visit certain pages such as the courses pages we may automatically
                                        collect
                                        certain information such as :
                                    </p>
                                    <h3>System Data
                                    </h3>
                                    <p>These type of data include some of the technical data such as your device’s IP
                                        address, device type, Operating System, browser type, browser language, and
                                        other
                                        system data.
                                    </p>
                                    <h3>Usage Data
                                    </h3>
                                    <p>Usage data include the interactions with some of the pages that you have visited
                                        such
                                        as the course pages. In these pages we may collect certain information such as
                                        pages
                                        visited, features used, your search queries, click data, date and time.
                                    </p>
                                    <h3>Geographic Data (Approximate)
                                    </h3>
                                    <p>We may also collect approximate geographical information such as country, city,
                                        and
                                        geographic coordinates, calculated based on your IP address.
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="heading6">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>How We Get Data About You
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapse6" class="collapse" role="tabpanel" aria-labelledby="heading6"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>We get data from you when you fill a form on the contact page or enquire about a
                                        course through phone or email. When you fill other forms other than the form in
                                        the
                                        contact page, we can get your information as well. As an example the form on
                                        your
                                        account registration page. In addition, with the use of cookies also we collect
                                        your
                                        data. Please refer to the below section on our cookie policy.
                                    </p>
                                    <p>In order to serve you better we also use Google analytics to collect statistics
                                        which
                                        is stated below.
                                    </p>
                                    <p>Next Learn Academy use the following types of cookies:
                                    </p>
                                    <p><strong>Preferences</strong>: These are the type of cookies that remember data
                                        about
                                        your browser and preferred settings that affect the appearance and behaviuor of
                                        the
                                        site such as your language of preference.
                                    </p>
                                    <p><strong>Security</strong>: These are cookies that enables you to login in and
                                        access
                                        our services such as when purchasing an online course. They protect against
                                        fraudulent logins and helps us detect any unauthorized logins that may course a
                                        malicious act on your account.
                                    </p>
                                    <p><strong>Functional</strong>: These are the cookies that stores the functional
                                        level
                                        information such as the volume level of a video when you play it.
                                    </p>
                                    <p><strong>Session State</strong>: These are the cookies that enables to check the
                                        browsing experience, remember your login details, and enable processing of your
                                        course purchases. These are fundamentally required for the services that we
                                        offer
                                        you to function correctly. However if you choose to disable them these services
                                        will
                                        not work correctly.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="heading7">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>The use of Analytics
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapse7" class="collapse" role="tabpanel" aria-labelledby="heading7"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>As recommended by Search Engine Markets we may require specific statistics such
                                        as:
                                    </p>
                                    <p>From which browsers our visitors have viewed the site
                                    </p>
                                    <p>How long they were actually browsing the website.
                                    </p>
                                    <p>The type of Operating System of the device that they visited our website.
                                    </p>
                                    <p>From which devices (mobiles, desktop, iPads and etc.) that they have visited our
                                        website
                                    </p>
                                    <p>Which keywords have generated more traffic to the website.
                                    </p>
                                    <p>This list is quite endless and is not limited to the above. We use all such data
                                        in
                                        order to better serve you next time you visit our website. We may also use them
                                        to
                                        fix any technical and User Ineterface issues that a visitor may across when
                                        viewing
                                        our website.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-privacy">
                            <div class="card-header" role="tab" id="heading8">
                                <div class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse8"
                                        aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <h3>Online Advertising
                                        </h3>
                                        </p>
                                    </a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div id="collapse8" class="collapse" role="tabpanel" aria-labelledby="heading8"
                                aria-expanded="false" style="">
                                <div class="card-block">
                                    <p>Since we are advertising in online platforms such as Facebook advertising we may
                                        use
                                        some of your data such as the things that we know about you. These includes your
                                        data usage, System Data (detailed above) and other elements of your data such as
                                        tracking data. As with the analytics these data are collected to serve you
                                        better.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>

    @stop

    @section('footer_scripts')
    @toastr_js
    @toastr_render

    @stop