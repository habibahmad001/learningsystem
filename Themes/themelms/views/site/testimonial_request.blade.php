@extends('layouts.sitelayout')

@section('content')
    <div class="main-content inner_pages">

        <section class="inner-header divider layer-overlay overlay-theme-colored-9 pt-60 pb-60">
            <div class="container">
                <div class="section-content position-relative">
                    <h2 class="text-theme-colored2 font-36">{{ ucfirst($title) }}</h2>
                    <ol class="breadcrumb text-left mt-10 white">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active">{{ ucfirst($title) }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="testimonial__Section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-1 col-sm-12"></div>
                    <div class="col-lg-8 col-md-10 col-sm-12 ml-auto mr-auto">
                        <div class="section-title text-center">
                            <h2 class="title text-uppercase">Testimonial <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Request</span></h2>
                            <p>Sed ut perspiciatis unde omnis iste natus errosit voluptatem accusantium doloremque laudantium totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        </div>

                        <form class="new__formStyle testimonial__request">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <div class="field">
                                        <input type="text" name="f-name" id="f-name" placeholder="Jane Appleseed">
                                        <label for="f-name">Full Name <span>*</span></label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6">
                                    <div class="field">
                                        <input type="text" name="l-name" id="l-name" placeholder="Appleseed">
                                        <label for="l-name">Last name <span>*</span></label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="field">
                                        <input type="email" name="email" id="email" placeholder="Email Address">
                                        <label for="email">Email Address <span>*</span></label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="field">
                                        <input type="tel" name="contact" id="contact" placeholder="Contact no.">
                                        <label for="contact">Contact no.</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="field">
                                        <select name="course" id="course">
                                            <option>Course Completed</option>
                                            <option value=""></option>
                                        </select>
                                        <label for="course">Course</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 rating__mark text-center">
                                    <label class="lable_r" >Rate Our Service <span>*</span></label>
                                    <div class="rating" style="width:85%">
                                        <input id="rating-5" type="radio" name="rating" value="5" checked/><label for="rating-5"><i class="far fa-star"></i><small>Very Satisfied</small></label>
                                        <input id="rating-4" type="radio" name="rating" value="4"/><label for="rating-4"><i class="far fa-star"></i><small>Satisfied</small></label>
                                        <input id="rating-3" type="radio" name="rating" value="3"/><label for="rating-3"><i class="far fa-star"></i><small>Neutral</small></label>
                                        <input id="rating-2" type="radio" name="rating" value="2"/><label for="rating-2"><i class="far fa-star"></i><small>Dissatisfied</small></label>
                                        <input id="rating-1" type="radio" name="rating" value="1"/><label for="rating-1"><i class="far fa-star"></i><small>Very Dissatisfied</small></label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="input_fileBox"></div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="field">
                                        <textarea name="testimonial" id="testimonial" placeholder="Your Testimonial"></textarea>
                                        <label for="testimonial">Testimonial</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">
                                    <p>I understand my testimonial as outlined above or in the video recorded of me and made on behalf of <span>Next Learn Academy</span> may be used in connection with publicising and promoting their products and services. I authorize <span>Next Learn Academy</span> to use my name, brief biographical information, Image submitted and the Testimonial as defined on this form or by me in this video.</p>
                                </div>

                                <div class="form-group text-center col-md-12">
                                    <a href="#" class="btn btn-primary theme-btn btn-block text-uppercase">Submit</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
        @stop
        @section('footer_scripts')
            <script>
                $(function () {

                });
            </script>
@endsection