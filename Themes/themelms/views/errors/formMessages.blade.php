@if (Session::has('flash_message') && (Session::get('flash_message.title')!="Ooops...!") )
    <script type="text/javascript">
        Swal.fire(  "{{{ Session::get('flash_message.title') }}}",
            "{{{ Session::get('flash_message.text') }}}",
             "{{{ Session::get('flash_message.type') }}}"

        );
    </script>
@endif

{{--@if (Session::has('flash_overlay'))--}}
    {{--<script type="text/javascript">--}}
        {{--swal({--}}
            {{--title: "{{{ Session::get('flash_overlay.title') }}}",--}}
            {{--text: "{{{ Session::get('flash_overlay.text') }}}",--}}
            {{--type: "{{{ Session::get('flash_overlay.type') }}}",--}}
            {{--confirmButtonText: "Ok"--}}
        {{--});--}}
    {{--</script>--}}
{{--@endif--}}