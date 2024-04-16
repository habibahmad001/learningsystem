<div class="topheadBar">
    <div class="container text-center">
        <h5>Welcome Back{!! (Auth::check()) ?  ", (". Auth::user()->first_name . " ". Auth::user()->last_name .")" : ""!!}</h5>
    </div>
</div>