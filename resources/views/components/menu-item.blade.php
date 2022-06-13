<div>
    <div id="sidebarMenu" >
            @if($hasSub == '')
                <div class="menu-item {{$hasSub ? 'has-sub' : ''}} {{URL::current() == $link || Request::segments(1)[0] == explode("/", $link)[3] || in_array(URL::current(), Arr::flatten($subMenu)) || in_array(Request::segments()[0].'.index', Arr::flatten($subMenu)) ? 'active' : ''}}">
            @else
                <div class="menu-item {{$hasSub ? 'has-sub' : ''}} {{URL::current() == $link || in_array(URL::current(), Arr::flatten($subMenu)) || in_array(Request::segments()[0].'.index', Arr::flatten($subMenu)) == true ? 'active' : ''}}">
            @endif
            <a href="{{$link}}" class="menu-link">
                            <span class="menu-icon">
                                <i class="{{$sideIcon}}"></i>
                            </span>
                <span class="menu-text">{{$title}}</span>
                @if($hasSub)
                    <span class="menu-caret"><b class="caret"></b></span>
                @endif
            </a>
            @if($hasSub)
                <div class="menu-submenu">
                    @foreach($subMenu as $menu)
                    @if(array_intersect(array($menu['permission']),Session::get('permissionTitle')) == array($menu['permission']))
                            <div class="menu-item {{ (Str::contains($menu['link'].'/', Request::segments(1)[0].'/')) == true   ? 'active' : ''}}">
{{--                            <div class="menu-item {{ \Illuminate\Support\Facades\URL::current() . '/' == $menu['link'].'/'  ? 'active' : ''}}">--}}
                                <a href="{{ url($menu['link'])}}" class="menu-link">
                                    <span class="menu-text">{{$menu['title']}}</span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>



