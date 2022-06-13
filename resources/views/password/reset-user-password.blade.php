<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- ================== BEGIN core-css ================== -->
    <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet"/>
    <!-- ================== END core-css ================== -->

    <!-- ================== BEGIN page-css ================== -->
    <link href="{{asset('assets/plugins/tag-it/css/jquery.tagit.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}"
          rel="stylesheet"/>
    <link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/bootstrap-slider/dist/css/bootstrap-slider.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/blueimp-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/summernote/dist/summernote-lite.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet"/>
</head>

<body class='pace-top'>


<!-- BEGIN #app -->
<div id="app" class="app app-full-height app-without-header">
    @if(session('success'))
        <x-alert type="success" message="{{session('success')}}"></x-alert>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" message="{{$error}}"></x-alert>
    @endforeach
@endif
<!-- BEGIN register -->
    <div class="register">
        <!-- BEGIN register-content -->
        <div class="register-content">
            <form action="{{route('password.email')}}" method="POST" name="register_form">
                @csrf
                <h1 class="text-center">Reset Password</h1>
                <p class="text-white text-opacity-50 text-center">Are you sure you want to reset your password ? If yes than proceed.</p>
                <div class="mb-3">
                    <label class="form-label">Email Address <span class="required"> *</span></label>
                    <input type="email" class="form-control"
                           placeholder="username@address.com" id="email"
                           name="email" value="{{ Auth::user()->email }}" readonly/>
                </div>
                <div class="mt-4 ">
                    <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100">Submit</button>
                </div>
            </form>
        </div>
        <!-- END register-content -->
    </div>
    <!-- END register -->

    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
    <!-- END btn-scroll-top -->
    <!-- BEGIN theme-panel -->
    <div class="app-theme-panel">
        <div class="app-theme-panel-container">
            <a href="javascript:;" data-toggle="theme-panel-expand" class="app-theme-toggle-btn"><i
                    class="bi bi-sliders"></i></a>
            <div class="app-theme-panel-content">
                <div class="small fw-bold text-white mb-1">Theme Color</div>
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body p-2">
                        <!-- BEGIN theme-list -->
                        <div class="app-theme-list">
                            <div class="app-theme-list-item"><a href="javascript:;" class="app-theme-list-link bg-pink"
                                                                data-theme-class="theme-pink"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Pink">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;" class="app-theme-list-link bg-red"
                                                                data-theme-class="theme-red"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Red">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;"
                                                                class="app-theme-list-link bg-warning"
                                                                data-theme-class="theme-warning"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Orange">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;"
                                                                class="app-theme-list-link bg-yellow"
                                                                data-theme-class="theme-yellow"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Yellow">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;" class="app-theme-list-link bg-lime"
                                                                data-theme-class="theme-lime"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Lime">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;" class="app-theme-list-link bg-green"
                                                                data-theme-class="theme-green"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Green">&nbsp;</a></div>
                            <div class="app-theme-list-item active"><a href="javascript:;"
                                                                       class="app-theme-list-link bg-teal"
                                                                       data-theme-class="" data-toggle="theme-selector"
                                                                       data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                       data-bs-container="body" data-bs-title="Default">&nbsp;</a>
                            </div>
                            <div class="app-theme-list-item"><a href="javascript:;" class="app-theme-list-link bg-info"
                                                                data-theme-class="theme-info"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Cyan">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;"
                                                                class="app-theme-list-link bg-primary"
                                                                data-theme-class="theme-primary"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Blue">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;"
                                                                class="app-theme-list-link bg-purple"
                                                                data-theme-class="theme-purple"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Purple">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;"
                                                                class="app-theme-list-link bg-indigo"
                                                                data-theme-class="theme-indigo"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Indigo">&nbsp;</a></div>
                            <div class="app-theme-list-item"><a href="javascript:;"
                                                                class="app-theme-list-link bg-gray-100"
                                                                data-theme-class="theme-gray-200"
                                                                data-toggle="theme-selector" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-container="body"
                                                                data-bs-title="Gray">&nbsp;</a></div>
                        </div>
                        <!-- END theme-list -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>

                <div class="small fw-bold text-white mb-1">Theme Cover</div>
                <div class="card">
                    <!-- BEGIN card-body -->
                    <div class="card-body p-2">
                        <!-- BEGIN theme-cover -->
                        <div class="app-theme-cover">
                            <div class="app-theme-cover-item active">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url({{asset('assets/img/cover/cover-thumb-1.jpg')}});"
                                   data-theme-cover-class="" data-toggle="theme-cover-selector" data-bs-toggle="tooltip"
                                   data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url({{asset('assets/img/cover/cover-thumb-2.jpg')}});"
                                   data-theme-cover-class="bg-cover-2" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 2">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url({{asset('assets/img/cover/cover-thumb-3.jpg')}});"
                                   data-theme-cover-class="bg-cover-3" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 3">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url({{asset('assets/img/cover/cover-thumb-4.jpg')}});"
                                   data-theme-cover-class="bg-cover-4" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 4">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url({{asset('assets/img/cover/cover-thumb-5.jpg')}});"
                                   data-theme-cover-class="bg-cover-5" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 5">&nbsp;</a>
                            </div>
                        </div>
                        <!-- END theme-cover -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
            </div>
        </div>
    </div>
    <!-- END theme-panel -->
</div>
<!-- END #app -->


<!-- ================== BEGIN core-js ================== -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<!-- ================== END core-js ================== -->

<!-- ================== BEGIN page-js ================== -->
<script src="{{asset('assets/plugins/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-slider/dist/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-3-typeahead/bootstrap3-typeahead.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js')}}"></script>
<script src="{{asset('assets/plugins/tag-it/js/tag-it.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-tmpl/js/tmpl.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-load-image/js/load-image.all.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/dist/summernote-lite.min.js')}}"></script>
<script src="{{asset('assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js')}}"></script>
<script src="{{asset('assets/plugins/select-picker/dist/picker.min.js')}}"></script>
<script src="{{asset('assets/plugins/highlight.js/highlight.min.js')}}"></script>
<script src="{{asset('assets/js/demo/highlightjs.demo.js')}}"></script>
<script src="{{asset('assets/js/demo/form-plugins.demo.js')}}"></script>
<!-- ================== END page-js ================== -->
<script>
    $('#ex-search').picker({search: true});
</script>
</body>

</html>

