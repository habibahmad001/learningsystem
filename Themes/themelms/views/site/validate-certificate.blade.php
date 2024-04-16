@extends('layouts.sitelayout')
@section('content')
    <style>
        .modal-body {
            display: grid;
        }

        .form-group label {
            position: relative;
            cursor: pointer;
        }

        .list-item .form-group {
            margin-bottom: 0px;
            display: inline;
        }
        #pdfviewer .modal-body {
            padding: 0;
        }
        #pdfviewer button.close{
            position: fixed;
            margin: 1% 0 0 96%;
            background: #0a0000;
            padding: 4px 8px;
            border-radius: 50%;
            color: white;
            z-index: 9999999;
        }

        #pdfviewer .modal-dialog-centered{
            top:2%;
            transform: translate(0, 5%) !important;
            -ms-transform: translate(0, 5%) !important; /* IE 9 */
            -webkit-transform: translate(0, 5%) !important; /* Safari and Chrome */
        }

        #pdfviewer .modal-dialog{
            width: 950px;
        }
        .modal-body .form-group {

            margin-right: 5px;
        }

        .modal-body form .form-group {
            margin-right: 10px;
        }

    </style>

    <div class="main-content inner_pages">

        <!--=====Start Page Banner=====-->
        <section class="inner-header divider layer-overlay overlay-theme-colored-9 pt-50 pb-50">
            <div class="container">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 >Verify your printed certificate</h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="{{url('/')}}">Home</a></li>
                                {{--<li><a href="#">Pages</a></li>--}}
                                <li class="active">Verify Certificate</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====End Page Banner=====-->


        <section class="contact new__pgfrmstyle pt-50 pb-50"  id="validationrow">
            <div class="container">
                <div class="section-title text-center">
                    <p class="text-danger">Note : Please note that this verification is available for the certificates Accredited by CPD only.</p>
                    <h2 class="title text-uppercase">Validate <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Certificate</span></h2>
                    <p>Kindly enter certificate code & student name below to verify certificate</p>
                </div>
                @if(isset($valid) && $valid=='success')
                <div class="row msg__sucs" style="display:block;">
                    <div class="col-lg-3 col-md-3"></div>
                    <div class="col-lg-6 col-md-6">
                        <div class="alert alert-success pb-50" role="alert">
                            <h4 class="alert-heading text-center">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                <br/>
                                Your requested certificate is valid and verified.
                            </h4>
                            <br/>
                            <div class="text-center">
                                <h5 class="pb-20">You can View or Download Certificate soft copy in PDF format</h5>
                                <a href="javascript:void(0)" onclick="viewCertificate('{{$certificate_code}}')" class="$item->idbtn btn-lg btn-success">View Certificate</a>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-3"></div>
                </div>
                @endif
                @if(isset($valid) && $valid=='failed')
                    <div class="row msg__sucs" style="display:block;">
                        <div class="col-lg-3 col-md-3"></div>
                        <div class="col-lg-6 col-md-6">
                            <div class="alert alert-danger pb-50" role="alert">
                                <h4 class="alert-heading text-center">
                                    <i class="fas fa-times-circle" aria-hidden="true"></i>
                                    <br/>
                                    Invalid Certificate <br/> Make sure your entered correct Certificate Code and Candidate Name
                                </h4>

                                <div class="form-group mb-0 text-center mt-20 ">
                                    <a href="{{url('/validate-certificate')}}" class="btn btn-warning theme-btn  " id="">Try Again</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-3">

                        </div>
                    </div>
                    @endif
    @if(!isset($valid))
    <div class="row">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">
            <div class="prc_wrap" style="min-height:auto;">
                @include('errors.errors')
                <form class="new__formStyle" method="post" action="{{url('/postValidationCertificate')}}">
                    <div class="form-group">
                        {{ csrf_field() }}

                        <div class="field">
                            <input type="text" name="user_name" id="user_name" class="form-control" required  placeholder="Candidate Name"  />
                            <label for="user_name">Candidate Name <span>*</span></label>
                        </div>
                        <small>Enter the name of the candidate as it is on the certificate</small>
                    </div>

                    <div class="form-group">
                        <div class="field">
                            <input type="text" name="certificate_code" required id="certificate_code" class="form-control"  placeholder="Certificate Code"  />
                            <label for="certificate_code">Certificate Code <span>*</span></label>
                        </div>
                        <small>Enter the certificate number above. You will find it on the bottom left of your certificate. Type it with the dashes.</small>
                    </div>

                    <div class="form-group mb-0">
                        <input type="submit" class="btn btn-primary theme-btn btn-block" value="Verify Now">
                        {{--<a class="btn btn-primary theme-btn btn-block" id=""><span>Verify Now</span></a>--}}
                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-3"></div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">

            <div class="w-100 mt-30 mb-30">
                <div class="panel-group" id="help-accordion-1">
                    <div class="panel panel-default panel-help">
                        <a href="#opret-32" data-toggle="collapse" data-parent="#help-accordion-1">
                            <div class="panel-heading"><h2>Do you want to verify your e-certificate?</h2></div>
                        </a>
                        <div id="opret-32" class="collapse">
                            <div class="panel-body inner_from">
                                <p>Wait! Why not celebrate your great achievement with a professionally printed certificate? Printed certificate enables you to,</p>
                                <ul>
                                    <li><i class="fas fa-check-square"></i>proudly present your qualification at an interview</li>
                                    <li><i class="fas fa-check-square"></i>verify your certificate at any time</li>
                                    <li><i class="fas fa-check-square"></i>get a detailed transcript of what you’ve learned</li>
                                </ul>
                                <small>(this doesn’t come with e-certificate) <a href="#">order your printed certificate now!</a></small>

                                <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/sample_crt.jpg">
                                <small class="text-center">(Here's a sample of our printed certificate)</small>



                                    <div class="form-group mb-0">
                                        <a href="#validationrow" class="btn btn-primary theme-btn btn-block" id="">Verify Now</a>
                                    </div>



                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-3"></div>
    </div>

</div>
</section>

</div>
<div class="modal fade" id="pdfviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="modal-body">

    </div>
</div>
</div>
</div>
@stop
@section('footer_scripts')
<script>
function viewCertificate(certificate_id) {

$.ajax({
    beforeSend: function () {
        $(this).prop('disabled', true);
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    },
    type: 'POST',
    data: { certificate_code: certificate_id},
    url: '{{url('result/view-pdf-certificate')}}',
    success: function (response) {
        //console.log(response.html);
        $('#pdfviewer .modal-body').html(response.html);
        $('#pdfviewer').modal('show');
        $(this).prop('disabled', false);
    }
});
}</script>
@endsection