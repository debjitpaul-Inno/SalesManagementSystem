<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    {{--    @foreach(\App\Helpers\Helper::menuList() as $menu)--}}
    <title>POS</title>
    {{--    @endforeach--}}



    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @if(\App\Helpers\Helper::favicon() != null)
        @if(\App\Helpers\Helper::favicon()['favicon'] != null)
            <link rel="shortcut icon" type="image/jpg/png/svg/jpeg" href="{{asset("storage/favicons/".\App\Helpers\Helper::favicon()['favicon'])}}"/>
        @else
            <link rel="shortcut icon" type="image/jpg/png/svg/jpeg" href="{{asset("assets/images/favicon-isl.png")}}"/>
        @endif
    @else
        <link rel="shortcut icon" type="image/jpg/png/svg/jpeg" href="{{asset("assets/images/favicon-isl.png")}}"/>
    @endif
    {{--    <link href="{{asset('assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />--}}

<!-- ================== BEGIN SELECT-PICKER-css ================== -->
    <link href="{{asset('assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />
    <!-- ================== END SELECT-PICKER-css ================== -->

    <!-- ================== BEGIN page-css ================== -->
    <link href="{{asset('assets/plugins/tag-it/css/jquery.tagit.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
    {{--    <link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />--}}
    <link href="{{asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap-slider/dist/css/bootstrap-slider.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/blueimp-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/summernote/dist/summernote-lite.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jvectormap-next/jquery-jvectormap.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
    <link href="{{asset('assets/css/animatedCircle.css')}}" rel="stylesheet" />
    <!-- ================== END page-css ================== -->

    <!-- ================== BEGIN datatables-css ================== -->
    <link href="{{asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet" />
    <!-- ================== END datatables-css ================== -->



    <!-- ================== BEGIN core-css ================== -->
    <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

</head>
<body>
<!-- BEGIN #app -->
<div id="app" class="app ">
@include('layouts.navbar')
@include('layouts.sidebar')
@yield('content')

@include('layouts.theme')
@include('layouts.footer')

