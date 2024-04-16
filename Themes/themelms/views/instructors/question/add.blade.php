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
                        <a href="{{url('/instructorquestion/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
                    </div>
                    <h1>{{ $title }}</h1>
                </div>
                <div class="panel-body packages">
                    <div>
                        @include('admin.message')
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{ route('instructorquestion.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                

                <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />

                <div class="row"> 
                  <div class="col-md-12">
                    <label for="exampleInputSlug">Course <span class="redstar">*</span></label>
                    <select name="course_id" class="form-control js-example-basic-single">
                      <option value="none" selected disabled hidden> 
                        Select an Option 
                      </option>
                      @foreach($course as $cor)
                          <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row"> 
                  <div class="col-md-12">
                    <select name="user_id" class="form-control hide">
                      <option  value="{{ Auth::user()->id }}">{{ Auth::user()->fname }}</option>
                    </select>
                  </div>
                </div>
                <br>
                
                <div class="row">  
                  <div class="col-md-12">
                    <label for="exampleInputDetails">Question:<sup class="redstar">*</sup></label>
                    <textarea name="question" rows="3" class="form-control" placeholder="Enter Your quetion"></textarea>
                  </div>
                </div>
                <br>
                
                <div class="row">
                  <div class="col-md-12">

                    <label for="exampleInputDetails">Status:</label>
                      <select class="form-control" id="status" name="status"><option value="1">Active</option><option value="0">Inactive</option></select>

                  </div>
                </div>
                <br>
              
                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-3 btn-primary">Submit</button>
                </div>
              </form>
          </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection


@section('footer_scripts')
