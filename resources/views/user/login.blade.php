<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!-- ================== BEGIN core-css ================== -->
    <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet"/>
    <!-- ================== END core-css ================== -->

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


<!-- BEGIN login -->
    <div class="login ">
        <div class="row">
        <!-- BEGIN card -->
        <div class="col-md-6 col-lg-4">
            <div class="card p-2">
                <!-- BEGIN card-body -->
                <div class="card-body ">
                    <!-- BEGIN login-content -->
                    <div class="login-content">
                        <form action="{{route('login')}}" method="POST" name="login_form">
                            @csrf
                            <div>
                                @if($setting != Null)
                                    <h1 class="text-center text-theme"
                                        style=" font-family: Apple">{{ $setting->title ?? "" }}</h1>
                                @endif
                                <h1 class="text-center">Sign In</h1>
                                <div class="text-white text-opacity-50 text-center mb-4">
                                    For your protection, please verify your identity.
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address <span class="required"> *</span></label>
                                    <input type="email" class="form-control form-control-lg bg-white bg-opacity-5"
                                           id="email"
                                           name="email" value="" placeholder="example@gmail.com"/>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex">
                                        <label class="form-label">Password <span class="required"> *</span></label>
                                        <a href="{{ route('password.request') }}"
                                           class="ms-auto text-white text-decoration-none text-opacity-50">Forgot
                                            password?</a>
                                    </div>
                                    <input type="password" class="form-control form-control-lg bg-white bg-opacity-5"
                                           value=""
                                           id="password" name="password" placeholder="Password"/>
                                </div>
                                {{--                    <div class="mb-3">--}}
                                {{--                        <div class="form-check">--}}
                                {{--                            <input class="form-check-input" type="checkbox" value="" id="customCheck1"/>--}}
                                {{--                            <label class="form-check-label" for="customCheck1">Remember me</label>--}}
                                {{--                        </div>--}}
                                {{--                    </div>--}}
                            </div>
                            <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Sign In
                            </button>
                        </form>
                    </div>
                    <!-- END login-content -->
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
        <!-- END Card -->
        <div class="col-md-6 col-lg-8 m-auto p-4">
            <div class="text-center mb-4">
                <img src="{{asset("assets/images/fullLogo-isl.png")}}" alt="Innovative Station Limited" style="width:400px">
            </div>
            <h1 class="text-center">Develop Your Business By Developing Your Management With Us.</h1>
        </div>
        </div>
    </div>
    <!-- END login -->

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
                                   style="background-image: url(assets/img/cover/cover-thumb-1.jpg);"
                                   data-theme-cover-class="" data-toggle="theme-cover-selector" data-bs-toggle="tooltip"
                                   data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url(assets/img/cover/cover-thumb-2.jpg);"
                                   data-theme-cover-class="bg-cover-2" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 2">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url(assets/img/cover/cover-thumb-3.jpg);"
                                   data-theme-cover-class="bg-cover-3" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 3">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url(assets/img/cover/cover-thumb-4.jpg);"
                                   data-theme-cover-class="bg-cover-4" data-toggle="theme-cover-selector"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                                   data-bs-title="Cover 4">&nbsp;</a>
                            </div>
                            <div class="app-theme-cover-item">
                                <a href="javascript:;" class="app-theme-cover-link"
                                   style="background-image: url(assets/img/cover/cover-thumb-5.jpg);"
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

</body>
</html>
