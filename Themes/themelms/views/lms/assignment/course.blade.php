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


            <table id="example1" class="table table-bordered table-striped table-responsive">

            <thead>
             
              <tr>
                <th>#</th>
                <th>{{ getPhrase('Course') }}</th>
                <th>{{ getPhrase('View Assignments') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach($courses as $course)
              <?php $i++;?>
              <tr>
                <td><?php echo $i;?></td>
              
                <td>
                  <p><b>{{ getPhrase('course') }}:</b> {{ $course['title'] }}</p>
                 
                </td>
                <td>
                	<a href="{{ route('list.assignment',$course->id) }}" class="btn btn-primary">View Assignment</a>
                </td>


              
                

                @endforeach
             
              </tr>
            </tfoot>
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
