<?php
//imran paid account generated key
$key='AIzaSyDtTy7NSY6OxRqoAT0n68TWgyXLTSJduiY';
//$key='';
if($course_type=='paid'){
?>
<div class="row">
    <h2 class="text-center">Your certificate is regenerated successfully</h2>
    <div class="text-center mb-15">
        <a href="{{$certificate_file}}" target="_blank" class="btn btn-success  mr-10" > Download</a>
        <a href="{{$certificate_file}}" target="_blank" class="btn btn-primary mr-10"> Full Preview Certificate</a></div>

</div>
<div class="text-center mb-15">
    <object data="{{$certificate_file}}" type="application/pdf"  style="width:800px; height:650px;">
        <iframe src="https://docs.google.com/gview?key={{$key}}&url={{$certificate_file}}&embedded=true" style="width:800px; height:650px;" frameborder="0"></iframe>
    </object>


            {{--<iframe src="https://docs.google.com/gview?key={{$key}}&url={{$certificate_file}}&embedded=true" style="width:800px; height:650px;" frameborder="0"></iframe>--}}
</div>
<?php }else {
?>
<div class="row">
    <div class="text-center mb-15">
<h2 class="text-center">Your certificate is generated successfully and will be posted at your mailing address</h2>
    </div>
</div>

<?php
}?>

