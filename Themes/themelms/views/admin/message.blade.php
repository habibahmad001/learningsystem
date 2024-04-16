@if (Session::has('success'))
    {{--<div class="text-center animated fadeInDown alert alert-success container" role="alert">--}}
       {{--{{Session::get('success')}}--}}
       @php toastr()->success(Session::get('success'));
       @endphp
    {{--</div>--}}
@endif

@if (Session::has('delete'))
    {{--<div class="text-center animated fadeInDown alert alert-danger container" role="alert">--}}
       {{--{{Session::get('delete')}}--}}
        @php toastr()->error(Session::get('delete'));
        @endphp
    {{--</div>--}}
@endif
