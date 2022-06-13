<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar" >
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" style="overflow-y: scroll;z-index: 999" >
        <!-- BEGIN menu -->
        <div class="menu text-theme" style="">
            <div class="menu-header">Navigation</div>
            @if(session()->has('permissionTitle'))
                @foreach(\App\Helpers\Helper::menuList() as $menu)
                    @if(array_intersect(array($menu['permission']) , Session::get('permissionTitle')) ==   array($menu['permission']))

                        <x-menu-item sideIcon="{{$menu['sideIcon']}}"
                                     title="{{$menu['title']}}" link="{{$menu['link']}}"
                                     permission="{{$menu['permission']}}"
                                     hasSub="{{$menu['hasSub']}}" :subMenu="$menu['subMenu']">
                        </x-menu-item>
                    @endif
                @endforeach
            @else
                <div class="alert alert-danger">
                    <x-alert type="danger" message="Session Timed Out! Please Logout & sign in again"></x-alert>
                </div>

            @endif
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<!-- END #sidebar -->

<!-- BEGIN mobile-sidebar-backdrop -->
<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app"
        data-toggle-class="app-sidebar-mobile-toggled"></button>
<!-- END mobile-sidebar-backdrop -->

{{----}}
