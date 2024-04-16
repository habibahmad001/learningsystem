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
            <a href="{{url('/instructoranswer/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
          </div>
          <h1>{{ $title }}</h1>
        </div>
        <div class="panel-body packages">
          <div class="table-responsive">
            @include('admin.message')


            <table id="example1" class="table table-bordered table-striped">

        <thead>
         
          <th>#</th>
          <th>{{getPhrase('Answer') }}</th>
          <th>{{ getPhrase('Question') }}</th>
          <th>{{ getPhrase('Course') }}</th>
          <th>{{ getPhrase('Status') }}</th>
          <th>{{ getPhrase('Edit') }}</th>
          <th>{{ getPhrase('Delete') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @foreach($answers as $ans)
        <tr>
          <?php $i++;?>
          <td><?php echo $i;?></td>
            <td>{{$ans->answer}}</td>
            <td>{{$ans->question->question}}</td>
            <td>{{$ans->courses->title}}</td> 
          <td>
              @if($ans->status==1)
               {{ getPhrase('Active') }}
              @else
               {{ getPhrase('Deactive') }}
              @endif                      
          </td>
          
          <td>
            <a class="btn btn-primary btn-sm" href="{{url('instructoranswer/'.$ans->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>

          <td><form  method="post" action="{{url('instructoranswer/'.$ans->id)}}
              "data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
        
        </tfoot>
      </table>
          </div>

        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>

@endsection


@section('footer_scripts')


@stop