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
                        <a href="{{url('/instructor/announcement')}}" class="btn  btn-primary button" >{{ getPhrase('List of Announcements')}}</a>
                    </div>
                    <h1>{{ $title }}</h1>
                </div>
                <div class="panel-body packages">
                    <div>
                        @include('admin.message')
          <div class="form-group">
            <form id="demo-form2" method="post" action="{{ url('instructor/announcement/') }}" data-parsley-validate class="form-horizontal form-label-left" onSubmit="javascript:return validation('');">
                {{ csrf_field() }}
                

                <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />

                <div class="row"> 
                  <div class="col-md-12">
                    <label for="exampleInputSlug">{{ getPhrase('Course') }}<span class="redstar">*</span></label>
                    <select name="course_id"  id="course_id" class="form-control js-example-basic-single" required="">
                      <option value="none" selected disabled hidden> 
                         {{ getPhrase('Select Course for announcement') }}
                      </option>
                      @foreach($course as $cor)
                          <option required value="{{ $cor->id }}">{{ $cor->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row"> 
                  <div class="col-md-12">
                    <select name="user_id" id="user_id" class="form-control hide">
                      <option  value="{{ Auth::user()->id }}">{{ Auth::user()->fname }}</option>
                    </select>
                  </div>
                </div>
                <br>
                
                <div class="row">  
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ getPhrase('Announcement') }}:<sup class="redstar">*</sup></label>
                    <textarea name="announsment"  id="announsment" rows="3" class="form-control" placeholder="Enter announcement detail message here"></textarea>
                  </div>
                </div>
                <br>
                @if($userrole=="instructor")
                    <input type="hidden" name="status" value="2">
                @else
                <div class="row">
                    <div class="col-md-6">

                        <label for="exampleInputDetails">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Approved</option>
                            <option value="0">Not Approved</option>
                        <option value="2">Pending</option></select>
                    </div>
                </div>
                @endif
                <br>
              
                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-3 btn-primary">{{ getPhrase('Submit') }}</button>
                </div>
              </form>
          </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection


@section('footer_scripts')
        <script language="JavaScript">
            function validation(type) {
                $(".error").each(function(){
                    $(this).removeClass('error');
                });

                var errors = [];

                var course_id            = $("#"+type+"course_id").val();
                var user_id              = $("#"+type+"user_id").val();
                var announsment          = $("#"+type+"announsment").val();
                var status               = $("#"+type+"status").val();



                if(course_id == null) {
                    errors.push("#"+type+"course_id");
                }

                if(user_id == '') {
                    errors.push("#"+type+"user_id");
                }

                if(announsment == '') {
                    errors.push("#"+type+"announsment");
                }

                if(status == '') {
                    errors.push("#"+type+"status");
                }

                if(errors.length>0){
                    for(i=0; i < errors.length; i++){
                        $(errors[i]).addClass('error');
                    }
                    return false;
                }

                return true;
            }
        </script>
@stop