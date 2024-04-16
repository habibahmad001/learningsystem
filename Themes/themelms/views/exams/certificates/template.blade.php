
<!DOCTYPE html>

<html lang="en">



<head>

    {{--<link href="http://localhost/infinity/public/css/bootstrap.min.css" rel="stylesheet">--}}

    <meta charset="UTF-8">

    <title>Certificate For Diana Prince</title>

</head>



<body style="margin: 0; padding: 0;">

<div style="width:800px;  min-height:1000px;   box-sizing:border-box; position:relative;" id='printarea'>
    <?php
    if(env('FILESYSTEM_DRIVER')=='s3'){
        $path = UPLOADS.'settings/'.getSetting('watermark_image','certificate');
    }else{
        $path = public_path('/uploads/settings/'.getSetting('watermark_image','certificate'));
    }

    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
    <div id="overlay2">
        <img src="{{$base64}}" style="position: absolute;left: 0;top: 0;" alt="certificate" width="800"  alt="">

        <!--border: 10px solid #787878;-->

        <div style="padding: 85px 60px 100px 60px;text-align:center;color:#333;line-height:26px;font-family:calibari;position:relative;">





            <div style="text-align: center;padding-bottom: 26px;padding-top: 100px;">
                {!!$content!!}

            </div>


        </div>
    </div>
</div>




<style>
    @page {
        size: A4;
        margin-top:0;
        margin-bottom:0;
        margin-left:0;
        margin-right:0;
        padding: 0;
    }
    body {

        position: relative;
    }
    #overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 800px;
        background-image: url({{$base64}});
        background-position: center top;
        background-repeat: no-repeat;
        z-index: -1;
    }
    #content{
        padding: 3.5cm 0.50cm 5.00cm 0.50cm;
    }
    #postal-address {
        margin: 0cm;
        margin-left: 1.50cm;
        margin-top: 0.00cm;
        margin-bottom: 1.00cm;
        font-size: 10pt;
    }
    #date {
        font-weight: bold;
    }
</style>


</body>


</html>