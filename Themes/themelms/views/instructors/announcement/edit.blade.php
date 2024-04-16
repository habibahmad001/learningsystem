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
            <form id="demo-form" method="post" action="{{url('instructor/announcement/'.$announs->id)}}" data-parsley-validate class="form-horizontal form-label-left" onSubmit="javascript: return validation('');">
              {{ csrf_field() }}
              {{ method_field('PUT') }}


              <input type="hidden" name="instructor_id" class="form-control" value="{{ Auth::User()->id }}"  />
              
                   
              <div class="row">
                <div class="col-md-9">
                  <label for="exampleInputTit1e">{{ getPhrase('Announsment') }}:<span class="redstar">*</span></label>
                  <textarea name="announsment"  id="announsment" rows="3" class="form-control" placeholder="Enter Question">{{$announs->announsment}}</textarea>
                </div>

                @if($userrole=="instructor")
                  <input type="hidden" name="status" value="{{$announs->status}}">
                @else
                  <div class="col-md-3">

                      <label for="exampleInputDetails">Status:</label>
                      <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option></select>


                  </div>
                @endif
                  {{--<div class="col-md-3">

                    <label for="exampleInputDetails">Status:</label>
                    <select class="form-control" id="status" name="status">
                      <option value="1"  {{ $announs->status==1 ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ $announs->status==0 ? 'selected' : '' }}>Inactive</option></select>
                  </div>--}}

              </div> 
              <br>
                
              <div class="box-footer">
                <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ getPhrase('Save') }}</button>
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

          var announsment          = $("#"+type+"announsment").val();
          var status               = $("#"+type+"status").val();


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
