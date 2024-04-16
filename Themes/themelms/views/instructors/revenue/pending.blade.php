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

          <div class="pull-right messages-buttons hide">
            <a href="{{url('/instructor/announcement/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
          </div>
          <h1>{{ $title }}</h1>
        </div>
        <div class="panel-body packages">
          <div>
            @include('admin.message')
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">

        <thead>
         
          <th>#</th>
          <th>{{ getPhrase('User') }}</th>
          <th>{{ getPhrase('Course') }}</th>
          <th>{{ getPhrase('TransactionId') }}</th>
          <th>{{ getPhrase('TotalAmount') }}</th>
          <th>{{ getPhrase('Delete') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @foreach($payout as $pay)
        <tr>
          <?php $i++;?>
          <td><?php echo $i;?></td>
            <td>{{$pay->user->first_name}}</td>
            <td>{{$pay->courses->title}}</td>
            <td>{{$pay->order->order_id}}</td>
            <td><i class="fa {{$pay->currency_icon}}"></i>{{$pay->instructor_revenue}}</td> 
          

          <td><form  method="post" action="{{url('instructoranswer/'.$pay->id)}}
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
    </div>
    <!-- /.container-fluid -->
  </div>

@endsection


@section('footer_scripts')


@stop