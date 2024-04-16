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
            <a href="{{url('/instructor/announcement/create')}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
          </div>
          <h1>{{ $title }}</h1>
        </div>
        <div class="panel-body packages">
          <div class="table-responsive">
            @include('admin.message')

            <table id="example1" class="table table-bordered table-striped">

              <thead>
                <th>#</th>
                <th>{{ getPhrase('Announcement') }}</th>
                @if($userrole=="admin" || $userrole=="owner")
                <th>{{ getPhrase('Instructor') }}</th>
                @endif
                <th>{{ getPhrase('Course') }}</th>
                <th>{{ getPhrase('Status') }}</th>
                <th>{{ getPhrase('Edit') }}</th>
                <th>{{ getPhrase('Delete') }}</th>
              </tr>
              </thead>
              <tbody>
              @if(count($announs) > 0)
              <?php $i=0;?>
                @foreach($announs as $announ)
                  <tr>
                  <?php $i++;
//                  dd($announ->courses);
                  ?>
                  <td><?php echo $i;?></td>
                    <td>{{$announ->announsment}}</td>
                    <td>{{$announ->user->name}}</td>
                    <td>{{($announ->courses==null)?'':$announ->courses->title}}</td>
                  <td>
                    <?php
                      $rec = '';
                      if($announ->status==2)
                          $rec = '<span class="label label-warning">Pending</span>';
                      elseif($announ->status==1)
                          $rec = '<span class="label label-success">Approved</span>';
                      elseif($announ->status==0)
                          $rec = '<span class="label label-danger">Not Approved</span>';

                      echo $rec;
                      ?>

                  </td>

                  <td>
                    <a class="btn btn-primary btn-sm" href="{{url('instructor/announcement/'.$announ->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                  </td>

                  <td><form  method="post" action="{{url('instructor/announcement/'.$announ->id)}}
                      "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="6"><br /><center><b style="color: red; font-size: 14px;">No record found!!!</b></center></td>
                </tr>
              @endif
       
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