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

                        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ getPhrase('User') }}</th>
              <th>{{ getPhrase('Course') }}</th>
              <th>{{ getPhrase('CourseChapter') }}</th>
              <th>{{ getPhrase('Assignment') }}</th>
              <th>{{ getPhrase('View') }}</th>
              <th>{{ getPhrase('Delete') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0;?>
            @foreach($assignment as $assign)
              <tr>
                <?php $i++;?>
                <td><?php echo $i;?></td>
                <td>{{$assign->user->fname}}</td>
                <td>{{$assign->courses->title}}</td>
                <td>{{$assign->chapter->chapter_name}}</td>
                <td>{{ $assign->title }}</td>
            
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('assignment/'.$assign->id)}}">{{ getPhrase('View') }}</a>
                </td> 

                <td>
                  <form  method="post" action="{{url('assignment/'.$assign->id)}}" ata-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
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




