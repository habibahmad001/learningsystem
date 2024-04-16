@extends('layouts.sitelayout')
<style>
    @media (min-width: 768px){
        .modal-dialog {width: 450px !important;}
    }
</style>
@section('content')
    <div class="main-content inner_pages">

        <div class="newLogin pt-150 pb-150">
            <div class="container">
                <div class="w-100 text-center">
                    <a href="" class="btn" data-toggle="modal" data-target="#myModalLogin">Buy Now login</a>
                </div>

                <div class="modal fade" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content newlogin__from">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick=""><span aria-hidden="true">&times;</span></button>
                            <div class="login__content">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a data-toggle="tab" href="#loginTab">Login</a></li>
                                    <li><a data-toggle="tab" href="#registerTab">Sign up</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="loginTab" class="tab-pane fade in active">
                                        <h3>Login Account</h3>
                                        <form class="mb-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Username/Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group text-right">
                                                <a href="#" class="forgot">Forgot Password</a>
                                            </div>
                                            <div class="form-group mb-0">
                                                <a href="#" class="btn btn-block text-uppercase">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="registerTab" class="tab-pane fade">
                                        <h3>Create an Account</h3>
                                        <form class=" mb-0">
                                            <div class="row row-md-padding">
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" placeholder="First Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Choose Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Email Address">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Confirm Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">I agree all statements in <a href="#">Terms of service</a></label>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <a href="#" class="btn btn-block text-uppercase">Register Now</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    <script>

    </script>
@endsection