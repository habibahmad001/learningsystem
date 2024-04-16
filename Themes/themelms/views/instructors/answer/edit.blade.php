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
                    <!-- /.box-header -->

                        <div class="form-group">
            <form action="{{url('instructoranswer/'.$answer->id)}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <label class="hide" for="exampleInputSlug">{{ getPhrase('Select Course') }}</label>
                  <input value="{{ $answer->course_id }}" autofocus name="course_id" type="text" class="form-control hide" >


                  <div class="row">
                    <div class="col-md-12">
                      <label for="exampleInput"> {{ getPhrase('Answer') }}:<sup class="redstar">*</sup></label>
                      <textarea name="answer" rows="4" class="form-control" placeholder="Please Enter Your Answer">{{ $answer->answer }}</textarea>
                    </div>
                  </div>
                



                <div class="row">
                    <div class="col-md-12">

                        <label for="exampleInputDetails">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1"  {{ $answer->status==1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $answer->status==0 ? 'selected' : '' }}>Inactive</option></select>

                    </div>
                </div>

                <br>
                
                <div class="box-footer">
                  <button value="" type="submit"  class="btn btn-md col-md-2 btn-primary">{{ getPhrase('Save') }}</button>
                </div>

            </form>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
@endsection


@section('footer_scripts')


@stop
