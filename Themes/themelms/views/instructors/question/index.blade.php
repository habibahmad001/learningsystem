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
            <a href="{{url('/instructorquestion/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
          </div>
          <h1>{{ $title }}</h1>
        </div>
        <div class="panel-body packages">
          <div>
          @include('admin.message')


            <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Course</th>
            <th>Question</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($questions as $que)
            <tr>
              <td>{{$que->courses->title}}</td>
              <td>{{$que->question}}</td> 
              <td>
                <form action="{{ route('ansr.quick',$que->id) }}" method="POST">
                  {{ csrf_field() }}
                  <button type="Submit" class="btn btn-xs {{ $que->status ==1 ? 'btn-success' : 'btn-danger' }}">
                    @if($que->status ==1)
                    Active
                    @else
                    Deactive
                    @endif
                  </button>
                </form>
              </td>
              <td>
                <a class="btn btn-success btn-sm" href="{{url('instructorquestion/'.$que->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>
              <td>
                <form  method="post" action="{{url('instructorquestion/'.$que->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                </form>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>

  <!-- /.row -->
          </div>

        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>

@endsection


@section('footer_scripts')


@stop
