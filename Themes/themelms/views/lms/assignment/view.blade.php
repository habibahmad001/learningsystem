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
            <div class="panel panel-custom">
                <div class="panel-heading">

                    <div class="pull-right messages-buttons">
                        {{--<a href="{{url('/instructorquestion/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>--}}
                    </div>
                    <h1>{{ $title }}</h1>
                </div>
                <div class="panel-body packages">
                    <div>
                        @include('admin.message')


                        <div class="view-instructor">
                    <div class="instructor-detail">
                    	<ul>
                    		<li>
                          @if($assign->user->user_img != null || $assign->user->user_img !='')
                            <img src="{{ asset('images/user_img/'.$assign->user->user_img) }}" class="img-circle"/></li>
                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-circle" alt="User Image">
                          @endif
                    		<li>{{ getPhrase('User') }}: {{ $assign->user->fname }} {{ $assign->user->lname }}</li>
                    		<li>{{ getPhrase('Course') }}: {{ $assign->courses->title }}</li>
                        <li>{{ getPhrase('CourseChapter') }}: {{ $assign->chapter->chapter_name }}</li>
                    		<li>{{ getPhrase('AssignmentTitle') }}: {{ $assign->title }}</li>
                    		<li>{{ getPhrase('Assignment') }}: <a href="{{ asset('files/assignment/'.$assign->assignment) }}" download="{{$assign->assignment}}">{{ getPhrase('Download') }} <i class="fa fa-download"></i></a></li>

                    	</ul>
                    </div>
          		</div>


              <form action="{{route('assignment.update',$assign->id)}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <input type="hidden" value="{{ $assign->user_id }}" name="user_id" class="form-control">

                  <input type="hidden" value="{{ $assign->course_id }}" name="course_id" class="form-control">

                  <div class="row">
                    <div class="col-md-6">
                      <label for="exampleInputTit1e">{{ getPhrase('ReviewAssignment') }}:</label>
                      <br>
                      <li class="tg-list-item">              
                          <input class="tgl tgl-skewed" id="assign_accept" type="checkbox" name="type" {{ $assign->type == 1 ? 'checked' : '' }} >
                          <label class="tgl-btn" data-tg-off="Unchecked" data-tg-on="Checked" for="assign_accept"></label>
                      </li>
                    </div>
                  </div>
                  <br>

                  <div class="row" style="{{ $assign['type'] == '1' ? '' : 'display:none' }}" id="sec1_one">
                    <div class="col-md-12">
                      <label for="exampleInputDetails">Give scores to assignment (1 to 10):</label>
                      <input min="1" max="10" class="form-control" name="rating" type="number" id="rating" value="{{ $assign->rating }}" placeholder="Enter Duration in months">
                    </div>
                  </div>
                  <br>


                  <button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ getPhrase('Save') }}</button>

              </form>

                        <!-- /.row -->
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection


@section('footer_scripts')

    <script>
        (function($) {
            "use strict";

            $(function(){

                $('#assign_accept').change(function(){
                    if($('#assign_accept').is(':checked')){
                        $('#sec1_one').show('fast');
                        $('#sec_one').hide('fast');
                    }else{
                        $('#sec1_one').hide('fast');
                        $('#sec_one').show('fast');
                    }

                });

            });
        })(jQuery);
    </script>



@stop


