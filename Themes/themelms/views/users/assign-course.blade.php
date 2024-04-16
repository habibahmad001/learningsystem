@extends($layout)
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a></li>
                        @if(checkRole(getUserGrade(2)))
                            <li><a href="{{URL_USERS}}">{{ getPhrase('users')}}</a></li>
                            <li class="active">{{isset($title) ? $title : ''}}</li>
                        @else
                            <li class="active">{{$title}}</li>
                        @endif
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="panel panel-custom " ng-controller="users_controller">
                <div class="panel-heading">
                    @if(checkRole(getUserGrade(2)))
                        <div class="pull-right messages-buttons"><a href="{{URL_USERS}}"
                                                                    class="btn  btn-primary button">{{ getPhrase('list')}}</a>
                        </div>
                    @endif

                    <h1>{{ $title }}  </h1>
                </div>

                <div class="panel-body">


                    <h3>{{getPhrase('Assign_courses')}}</h3>
                    <?php
                    $user_record = $record;

                    ?>
                    <div class="row">
                        <div class="form-group col-md-3">

                            <label class="lms_sections">Select Category</label>
                            <select class="form-control lms_categories"
                                    name="lms_categories">
                                <option value="">Select Category</option>

                                @if (count($lms_category)>0)
                                    @foreach($lms_category as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                @endif


                            </select>
                        </div>
                        <input type="hidden" value="{{$user_record->id}}" id="user_id">
                        <div class="form-group col-md-3">

                            <label class="lms_sections">Select Sub Category</label>
                            <select class="form-control lms_sub_categories"
                                    name="lms_sub_categories">
                                <option value="">Select Sub Category</option>

                            </select>
                        </div>
                    </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div id="message">
                                </div>
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

                                <table id="resulted_courses">
                                   <thead>
                                    <tr class="header">
                                        <th>{{getPhrase('title')}}</th>
                                        <th>{{getPhrase('cost')}}</th>
                                        <th>{{getPhrase('discount_price')}}</th>
                                        <th>{{getPhrase('validity')}}</th>
                                        <th>{{getPhrase('action')}}</th>
                                    </tr>
                                   </thead>
                                  <tbody>
                                  @if(count($allcourses)>0)
                                      @foreach($allcourses as $course)
                                          <?php
                                          $detail = $course;
                                          $payment_courses = App\UserCourses::where('user_id',$user_record->id)->where('item_id', $course->id)->get();

                                          ?>
                                          @if ($payment_courses->isEmpty())
                                              <tr>
                                                  <td>{{$detail->title}}</td>
                                                  <td>{{$detail->cost}}</td>
                                                  <td>{{$detail->discount_price}}</td>
                                                  <td>{{$detail->validity}}</td>
                                                  <td class='add'><a href='javascript:;' data-course='{{$detail->id}}' class='label label-primary assign_courses'>Assign</a></td>
                                                  {{--<td class="assign_courses"><a href='javascript:;' data-course='$record->id' class='label label-danger remove_courses'>remove</a></td>--}}
                                              </tr>

                                              @else
                                              <tr>
                                                  <td>{{$detail->title}}</td>
                                                  <td>{{$detail->cost}}</td>
                                                  <td>{{$detail->discount_price}}</td>
                                                  <td>{{$detail->validity}}</td>
                                                  <td class="remove"><a href='javascript:;' data-course='{{$detail->id}}' class='label label-danger remove_courses'>remove</a></td>
                                              </tr>
                                          @endif
                                      @endforeach
                                  @endif

                                  </tbody>
                                </table>

                            </div>
                            <div class="col-md-6">
                                <table id="user_all_courses" class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="header">
                                        <th>{{getPhrase('title')}}</th>
                                        <th>{{getPhrase('cost')}}</th>
                                        <th>{{getPhrase('discount_price')}}</th>
                                        <th>{{getPhrase('validity')}}</th>
                                        <th>{{getPhrase('action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(count($courses)>0)
                                        @foreach($courses as $course)
                                            <?php
                                            $detail = App\LmsSeries::find($course->item_id);

                                            ?>
                                          @if($detail)
                                            <tr>
                                                <td>{{$detail->title}}</td>
                                                <td>{{$detail->cost}}</td>
                                                <td>{{$detail->discount_price}}</td>
                                                <td>{{$detail->validity}}</td>
                                                <td class="remove"><a href='javascript:;' data-course='{{$detail->id}}' class='label label-danger remove_courses'>remove</a></td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    <!-- /#page-wrapper -->
@endsection
@section('footer_scripts')
   <script>
       $(document).on('change','.lms_categories',function (e) {
           e.preventDefault();
           var id = $(this).val();
           var user_id = $('#user_id').val();
           var token = '{{@csrf_token()}}';
           $.ajax({
               type: 'POST',
               url: '{{route('get-sub-category')}}',
               data: {
                   '_token': token,
                   'id' : id,
                   'user_id' : user_id,
               },
               success: function (data) {
                   $('.lms_sub_categories').html(data.html);
                   $('#resulted_courses tbody').html(data.result);
               },
           });
       });
       $(document).on('change','.lms_sub_categories',function (e) {
           e.preventDefault();
           var id = $(this).val();
           var user_id = $('#user_id').val();
           var token = '{{@csrf_token()}}';
           $.ajax({
               type: 'POST',
               url: '{{route('get-course')}}',
               data: {
                   '_token': token,
                   'id' : id,
                   'user_id' : user_id,
               },
               success: function (data) {
                  $('#resulted_courses tbody').html(data);
               },
           });

       });
       $(document).on('click','.assign_courses',function (e) {
           e.preventDefault();
           var course_id = $(this).data('course');
           var user_id = $('#user_id').val();
           var token = '{{@csrf_token()}}';
           var parent = $(this).parent();
           $.ajax({
               type: 'POST',
               url: '{{route('user-assign-course')}}',
               dataType: 'json',
               data: {
                   '_token': token,
                   'course_id' : course_id,
                   'user_id' : user_id,
               },
               success: function (result) {
                   $('#message').html('');
                   if(result.status=='success'){
                       parent.html(result.remove);
                       $('#user_all_courses tbody').html(result.html);
                       $('#message').append(
                           '<div class="alert alert-success alert-dismissable">'+
                           '<button type="button" class="close" data-dismiss="alert">'+
                           '<span aria-hidden="true">&times;</span>'+
                           '<span class="sr-only">Close</span>'+
                           '</button>'+
                           result.message+
                           '</div>'
                       );
                   }else{

                       $('#message').append(
                           '<div class="alert alert-danger alert-dismissable">'+
                           '<button type="button" class="close" data-dismiss="alert">'+
                           '<span aria-hidden="true">&times;</span>'+
                           '<span class="sr-only">Close</span>'+
                           '</button>'+
                           result.message+
                           '</div>'
                       );
                   }
               },
           });

       });
       $(document).on('click','.remove_courses',function (e) {
           e.preventDefault();
           var course_id = $(this).data('course');
           var user_id = $('#user_id').val();
           var token = '{{@csrf_token()}}';
           var parent = $(this).parent();
           $.ajax({
               type: 'POST',
               url: '{{route('user-remove-course')}}',
               data: {
                   '_token': token,
                   'course_id' : course_id,
                   'user_id' : user_id,
               },
               success: function (result) {
                   $('#message').html('');
                   if(result.status=='success'){
                       parent.html(result.assign);
                       $('#user_all_courses tbody').html(result.html);
                       $('#message').append(
                           '<div class="alert alert-success alert-dismissable">'+
                           '<button type="button" class="close" data-dismiss="alert">'+
                           '<span aria-hidden="true">&times;</span>'+
                           '<span class="sr-only">Close</span>'+
                           '</button>'+
                           result.message+
                           '</div>'
                       );
                       parent.hide();
                   }else{

                       $('#message').append(
                           '<div class="alert alert-danger alert-dismissable">'+
                           '<button type="button" class="close" data-dismiss="alert">'+
                           '<span aria-hidden="true">&times;</span>'+
                           '<span class="sr-only">Close</span>'+
                           '</button>'+
                           result.message+
                           '</div>'
                       );
                   }
               },
           });

       });
       function myFunction() {
           var input, filter, table, tr, td, i, txtValue;
           input = document.getElementById("myInput");
           filter = input.value.toUpperCase();
           table = document.getElementById("resulted_courses");
           tr = table.getElementsByTagName("tr");
           for (i = 0; i < tr.length; i++) {
               td = tr[i].getElementsByTagName("td")[0];
               if (td) {
                   txtValue = td.textContent || td.innerText;
                   if (txtValue.toUpperCase().indexOf(filter) > -1) {
                       tr[i].style.display = "";
                   } else {
                       tr[i].style.display = "none";
                   }
               }
           }
       }
   </script>
    <style>
        #myInput {
            background-image: url('{{asset('public/images/searchicon.png')}}');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #resulted_courses {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #resulted_courses th, #resulted_courses td {
            text-align: left;
            padding: 12px;
        }

        #resulted_courses tr {
            border-bottom: 1px solid #ddd;
        }

        #resulted_courses tr.header, #resulted_courses tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    @endsection