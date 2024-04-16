@extends(getLayout())
@section('header_scripts')
    <link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}"><i class="mdi mdi-home"></i></a> </li>
                        <li>{{ $title }}</li>
                    </ol>
                </div>
            </div>

            <!-- /.row -->
            <div class="panel panel-custom col-lg-6 col-lg-offset-3 ng-scope">
                <div class="panel-heading">

                    <div class="pull-right messages-buttons">
                        <a href="{{url('/instructoranswer/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
                    </div>
                    <h1>{{ $title }}</h1>
                </div>
                <div class="panel-body packages">
                    <div>
                        @include('admin.message')
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{url('instructoranswer/')}}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                

                <input type="hidden" name="instructor_id" value="{{Auth::user()->id}}" />
                <input type="hidden" name="ans_user_id" value="{{Auth::user()->id}}" />
           
                <div class="row">
                  <div class="col-md-12">
                    <label  for="exampleInputTit1e"> {{ getPhrase('Select') }} {{ getPhrase('Question') }}:<sup class="redstar">*</sup></label>
                    <br>
                    <select name="question_id" required class="form-control col-md-7 col-xs-12 js-example-basic-single">
                      <option value="none" selected disabled hidden> 
                         {{ getPhrase('Select an Option') }}
                      </option>
                      @foreach($questions as $ques)
                        <option value="{{ $ques->id }}">{{ $ques->question}}</option>
                      @endforeach
                    </select>
                  </div>
                  @foreach($questions as $ques)
                  <input type="hidden" name="ques_user_id"  value="{{$ques->user_id}}" />
                  <input type="hidden" name="course_id"  value="{{$ques->course_id}}" />
                  @endforeach
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInput">{{ getPhrase('Answer') }}:<sup class="redstar">*</sup></label>
                    <textarea name="answer" rows="4" class="form-control" placeholder="Please Enter Your Answer"></textarea>
                  </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-6">

                        <label for="exampleInputDetails">Status:</label>
                        <select class="form-control" id="status" name="status"><option value="1">Active</option><option value="0">Inactive</option></select>

                    </div>
                </div>
                <br>
        
                <div class="box-footer">
                  <button type="submit" value="Add Answer" class="btn btn-md col-md-3 btn-primary">+ {{ getPhrase('Save') }}</button>
                </div>

              </form>
          </div></div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection


@section('footer_scripts')
