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
        <!-- /.box-header -->

          <div class="form-group">
            <form id="demo-form" method="post" action="{{url('instructorquestion/'.$que->id)}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}


              <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />
              <div class="row">
                <div class="col-md-12">
              <select name="course_id" class="form-control col-md-7 col-xs-12 display-none">
               @foreach($courses as $cou)
               <option class="display-none" value="{{ $cou->id }}" {{$que->courses->id == $cou->id  ? 'selected' : ''}}>{{ $cou->title}}</option>
               @endforeach
              </select>

              <select name="user_id" class="form-control col-md-7 col-xs-12 hide">
                @foreach($user as $cu)
                  <option class="display-none" value="{{ $cu->id }}" {{$que->courses->id == $cu->id  ? 'selected' : ''}}>{{ $cu->fname}}</option>
                @endforeach
              </select>
                </div>
              </div>

                  <div class="row">
                    <div class="col-md-12">
                  <label for="exampleInputTit1e">Question:<span class="redstar">*</span></label>
                  <textarea name="question" rows="3" class="form-control" placeholder="Enter Your quetion">{{$que->question}}</textarea>
                </div>
                  </div>
                    <div class="row">
                      <div class="col-md-12">

                    <label for="exampleInputDetails">Status:</label>
                    <select class="form-control" id="status" name="status">
                      <option value="1"  {{ $que->status==1 ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ $que->status==0 ? 'selected' : '' }}>Inactive</option></select>
                      </div>

                </div>
              <div class="row">
                <div class="col-md-12">
                
              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary mt-30">Save</button>
              </div>
                </div>
              </div>
            </form>
          </div>

        <!-- /.box-body -->
          </div>

        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>

@endsection


@section('footer_scripts')


@stop
